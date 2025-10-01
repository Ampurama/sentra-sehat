<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penduduk;
use App\Models\Wilayah;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get wilayah in Mappakasunggu and Pattallassang
        $wilayahs = Wilayah::whereIn('nama_kecamatan', ['Mappakasunggu', 'Pattallassang'])->get();

        $sampleData = [
            [
                'nama' => 'Ahmad Surya Pratama',
                'JK' => 'L',
                'TTL' => '1985-03-15',
                'tempat_lahir' => 'Makassar',
                'alamat_lengkap' => 'RT 001/RW 002 - Jl. Sudirman No. 45, Desa Sample',
                'no_telp' => '081234567890',
                'riwayat_merokok' => 1,
                'riwayat_alkohol' => 0,
                'riwayat_penyakit_keturunan' => 1,
                'data_klinis_ringkas' => 'Pasien hipertensi dengan riwayat stroke ringan 2 tahun yang lalu. Saat ini dalam pengobatan rutin dengan kontrol tekanan darah stabil.',
                'diagnosis_utama' => 'Hipertensi Grade II (I10)',
                'diagnosis_penyerta' => 'Dislipidemia, Obesitas',
                'tindakan_perawatan' => 'Pemberian antihipertensi (Amlodipine 10mg 1x sehari), statin untuk dislipidemia, dan konseling gizi untuk penurunan berat badan.',
                'obat_pulang' => '1. Amlodipine 10mg tablet - 1 tablet sehari setelah makan pagi
2. Simvastatin 20mg tablet - 1 tablet sehari malam hari
3. Aspirin 80mg tablet - 1 tablet sehari',
                'alat_kesehatan_rumah' => 'Tensimeter digital untuk monitoring tekanan darah harian, timbangan badan digital, dan alat pengukur gula darah.',
                'status_fungsional_pulang' => 'Mandiri dengan bantuan minimal untuk aktivitas berat',
                'hasil_pemeriksaan_terakhir' => 'Tekanan darah: 140/85 mmHg, Kadar kolesterol total: 220 mg/dL, BMI: 28.5 kg/m², Gula darah puasa: 95 mg/dL'
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'JK' => 'P',
                'TTL' => '1990-07-22',
                'tempat_lahir' => 'Takalar',
                'alamat_lengkap' => 'RT 002/RW 003 - Jl. Merdeka No. 12, Desa Sample',
                'no_telp' => '081345678901',
                'riwayat_merokok' => 0,
                'riwayat_alkohol' => 0,
                'riwayat_penyakit_keturunan' => 0,
                'data_klinis_ringkas' => 'Pasien diabetes melitus tipe 2 dengan kontrol gula darah baik melalui diet dan obat oral.',
                'diagnosis_utama' => 'Diabetes Melitus Tipe 2 (E11)',
                'diagnosis_penyerta' => 'Hipertensi',
                'tindakan_perawatan' => 'Pemberian antidiabetik oral (Metformin 500mg 2x sehari) dan antihipertensi (Lisinopril 10mg 1x sehari).',
                'obat_pulang' => '1. Metformin 500mg tablet - 2 tablet sehari
2. Lisinopril 10mg tablet - 1 tablet sehari',
                'alat_kesehatan_rumah' => 'Glucometer untuk monitoring gula darah harian.',
                'status_fungsional_pulang' => 'Mandiri',
                'hasil_pemeriksaan_terakhir' => 'Gula darah puasa: 110 mg/dL, Tekanan darah: 130/80 mmHg, BMI: 25 kg/m²'
            ],
        ];

        $nikBase = 7301010000000000; // Base NIK for South Sulawesi

        foreach ($wilayahs as $wilayah) {
            $numPenduduk = rand(1, 2); // 1 or 2 penduduk per desa
            for ($i = 0; $i < $numPenduduk; $i++) {
                $data = $sampleData[$i % count($sampleData)];
                $nik = $nikBase + ($wilayah->id * 100) + $i;
                Penduduk::firstOrCreate([
                    'NIK' => (string)$nik,
                ], array_merge($data, [
                    'wilayah_id' => $wilayah->id,
                    'alamat_lengkap' => str_replace('Desa Sample', 'Desa ' . $wilayah->nama_desa, $data['alamat_lengkap']),
                ]));
            }
        }
    }
}
