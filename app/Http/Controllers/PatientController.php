<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\TindakanIntervensi;
use App\Models\Penduduk;

class PatientController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.patient-login');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $penduduk = $user->penduduk;

        if (!$penduduk) {
            return redirect()->route('login')->with('error', 'Data penduduk tidak ditemukan.');
        }

        // Get intervention history for this patient
        $intervensiHistory = TindakanIntervensi::where('pasien_id', $penduduk->id)
            ->with(['penyakit', 'rencanaLanjutan'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Prepare patient data summary for AI prompt
        $clinicalSummary = $this->getClinicalSummary($penduduk);
        $interventionSummary = $this->getInterventionSummary($intervensiHistory);

        $prompt = "Berdasarkan data pasien berikut, generate tepat 3 tips kesehatan harian yang dipersonalisasi dalam bahasa Indonesia. Tips harus relevan dengan riwayat intervensi dan data klinis pasien. Kembalikan HANYA JSON array tanpa teks tambahan, dengan struktur: [{'title': 'Judul tips', 'description': 'Deskripsi singkat tips (1-2 kalimat)'}]. Data klinis: {$clinicalSummary}. Riwayat intervensi: {$interventionSummary}.";

        $healthTips = $this->generateHealthTips($prompt);

        return view('patient.dashboard', compact('penduduk', 'intervensiHistory', 'healthTips'));
    }

    private function getClinicalSummary($penduduk)
    {
        $summary = [];
        if ($penduduk->diagnosis_utama) $summary[] = "Diagnosis utama: {$penduduk->diagnosis_utama}";
        if ($penduduk->diagnosis_penyerta) $summary[] = "Diagnosis penyerta: {$penduduk->diagnosis_penyerta}";
        if ($penduduk->data_klinis_ringkas) $summary[] = "Ringkasan klinis: {$penduduk->data_klinis_ringkas}";
        if ($penduduk->hasil_pemeriksaan_terakhir) $summary[] = "Hasil pemeriksaan terakhir: {$penduduk->hasil_pemeriksaan_terakhir}";
        return implode('. ', $summary) ?: 'Tidak ada data klinis tersedia.';
    }

    private function getInterventionSummary($intervensiHistory)
    {
        if ($intervensiHistory->isEmpty()) {
            return 'Belum ada riwayat intervensi.';
        }

        $summaries = [];
        foreach ($intervensiHistory->take(3) as $intervensi) {  // Take recent 3
            $penyakit = $intervensi->penyakit ? $intervensi->penyakit->name : 'Tidak diketahui';
            $deskripsi = $intervensi->deskripsi_intervensi;
            $summaries[] = "{$penyakit}: {$deskripsi}";
        }
        return implode('. ', $summaries);
    }

     private function generateHealthTips($prompt, $patientName = 'Pasien')
    {
        try {
            // Debug: Log the configuration
            Log::info('OpenAI Config Check:', [
                'api_key_exists' => !empty(env('OPENAI_API_KEY')),
                'api_key_prefix' => substr(env('OPENAI_API_KEY'), 0, 10) . '...',
                'url' => config('services.openai.url'),
                'model' => config('services.openai.model')
            ]);

            // Check if API key is configured
            if (empty(env('OPENAI_API_KEY'))) {
                Log::warning('OpenAI API key is not configured');
                return $this->getFallbackTips($patientName);
            }

            // Clear cache config in case of changes
            \Illuminate\Support\Facades\Artisan::call('config:cache');

            $requestData = [
                'model' => config('services.openai.model'),
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a doctor providing personalized health tips. Return ONLY a JSON array with exactly 3 tips, no additional text. Format: [{"title":"Title","description":"Brief description (1-2 sentences)"}]'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ],
                ],
                'temperature' => 0.7,
                'top_p' => 1,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
                'max_tokens' => 4096,
            ];

            Log::info('OpenAI Request Data: ', $requestData);

            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                    'Content-Type' => 'application/json',
                ])
                ->post(config('services.openai.url') . '/chat/completions', $requestData);

            Log::info('OpenAI Response Status: ' . $response->status());
            Log::info('OpenAI Response Headers: ', $response->headers());

            if ($response->successful()) {
                $responseData = $response->json();
                Log::info('OpenAI Full Response: ', $responseData);

                $content = trim($responseData['choices'][0]['message']['content'] ?? '');

                Log::info('OpenAI Raw Content: ' . $content);

                // Try multiple JSON extraction methods
                $tips = $this->parseAIResponse($content);

                if ($tips && is_array($tips) && count($tips) >= 3) {
                    Log::info('Successfully parsed AI tips: ', $tips);
                    return array_slice($tips, 0, 3);
                }

                Log::warning('AI response parsing failed, content: ' . $content);
            } else {
                Log::error('OpenAI API failed with status ' . $response->status() . ': ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('OpenAI API Exception: ' . $e->getMessage());
            Log::error('Exception trace: ' . $e->getTraceAsString());
        }

        // Return fallback tips
        Log::info('Using fallback tips for patient: ' . $patientName);
        return $this->getFallbackTips($patientName);
    }

    private function parseAIResponse($content)
    {
        // Method 1: Direct JSON decode
        $tips = json_decode($content, true);
        if ($this->isValidTipsArray($tips)) {
            return $tips;
        }

        // Method 2: Extract JSON from markdown
        $content = preg_replace('/```json\s*/', '', $content);
        $content = preg_replace('/```\s*/', '', $content);
        $tips = json_decode(trim($content), true);
        if ($this->isValidTipsArray($tips)) {
            return $tips;
        }

        // Method 3: Find JSON array pattern
        if (preg_match('/\[.*\]/s', $content, $matches)) {
            $tips = json_decode($matches[0], true);
            if ($this->isValidTipsArray($tips)) {
                return $tips;
            }
        }

        // Method 4: Try to fix common JSON issues
        $fixedContent = str_replace("'", '"', $content);
        $fixedContent = preg_replace('/([{,]\s*)([a-zA-Z_][a-zA-Z0-9_]*)\s*:/', '$1"$2":', $fixedContent);
        $tips = json_decode($fixedContent, true);
        if ($this->isValidTipsArray($tips)) {
            return $tips;
        }

        return false;
    }

    private function isValidTipsArray($tips)
    {
        return is_array($tips) && 
               count($tips) >= 3 && 
               isset($tips[0]['title']) && 
               isset($tips[0]['description']) &&
               !empty($tips[0]['title']) && 
               !empty($tips[0]['description']);
    }

    private function extractJsonFromContent($content)
    {
        // Remove any markdown code blocks
        $content = preg_replace('/```json\s*/', '', $content);
        $content = preg_replace('/```\s*$/', '', $content);
        
        // Find JSON array
        if (preg_match('/\[.*\]/s', $content, $matches)) {
            return $matches[0];
        }
        
        return $content;
    }

    private function getFallbackTips($patientName = 'Pasien')
    {
        // More personalized fallback tips
        $fallbackTips = [
            [
                'title' => 'Hidrasi yang Cukup', 
                'description' => 'Minum air putih 8-10 gelas per hari untuk menjaga fungsi ginjal dan sirkulasi darah yang optimal.'
            ],
            [
                'title' => 'Aktivitas Fisik Ringan', 
                'description' => 'Lakukan jalan santai 20-30 menit setiap hari untuk menjaga kesehatan jantung dan stamina tubuh.'
            ],
            [
                'title' => 'Pola Makan Teratur', 
                'description' => 'Konsumsi makanan bergizi seimbang dengan jadwal teratur, perbanyak sayur dan buah-buahan segar.'
            ],
        ];

        Log::info('Using fallback health tips for patient: ' . $patientName);
        return $fallbackTips;
    }
    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find penduduk by NIK
        $penduduk = Penduduk::where('NIK', $request->nik)->first();

        if (!$penduduk) {
            return back()->withErrors(['nik' => 'NIK tidak ditemukan.']);
        }

        // Check if penduduk has a user account with patient role
        $user = $penduduk->user;

        if (!$user || $user->role->name !== 'patient') {
            return back()->withErrors(['nik' => 'Akun pasien tidak ditemukan untuk NIK ini.']);
        }

        // Attempt login
        if (Auth::attempt(['nik' => $request->nik, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended(route('patient.dashboard'));
        }

        return back()->withErrors(['password' => 'Password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
