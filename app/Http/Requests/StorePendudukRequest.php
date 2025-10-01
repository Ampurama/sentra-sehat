<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon; // Digunakan di sini untuk before:today

class StorePendudukRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan untuk membuat request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk request.
     */
    public function rules(): array
    {
        // Ambil ID penduduk dari route jika ini adalah operasi update (untuk Rule::unique)
        $pendudukId = $this->route('penduduk'); 
        
        return [
            'NIK' => [
                'required', 
                'string', 
                'digits:16', 
                Rule::unique('penduduk', 'NIK')->ignore($pendudukId), 
            ],
            'nama' => 'required|string|max:255',
            'JK' => 'required|in:L,P', // <-- HANYA MENGIZINKAN L atau P
            'wilayah_id' => 'required|exists:wilayah,id',
            'no_telp' => 'nullable|string|max:20',
            'no_bpjs' => 'nullable|string|max:20|unique:penduduk,no_bpjs',

            // Relasi self-referencing
            'kepala_keluarga_id' => 'nullable|exists:penduduk,id', // <-- DITAMBAHKAN
            
            // --- FIELD BARU DARI FORM ---
            'tempat_lahir' => 'required|string|max:100', 
            // Tambahkan before_or_equal:today untuk memastikan tanggal lahir tidak di masa depan
            'tanggal_lahir' => 'required|date|before_or_equal:today', 
            
            // Alamat (Pastikan kolom-kolom ini ada di database)
            'alamat_rt' => 'required|string|max:3',
            'alamat_rw' => 'required|string|max:3',
            'alamat_detail' => 'nullable|string|max:500', 
            
            // Faktor Risiko (menggunakan boolean, input form harus mengirim 1 atau 0)
            'riwayat_merokok' => 'nullable|boolean',
            'riwayat_alkohol' => 'nullable|boolean',
            'riwayat_penyakit_keturunan' => 'nullable|boolean',

            // Data Klinis Pasien
            'data_klinis_ringkas' => 'nullable|string|max:1000',
            'diagnosis_utama' => 'nullable|string|max:500',
            'diagnosis_penyerta' => 'nullable|string|max:500',
            'tindakan_perawatan' => 'nullable|string|max:1000',
            'obat_pulang' => 'nullable|string|max:1000',
            'alat_kesehatan_rumah' => 'nullable|string|max:1000',
            'status_fungsional_pulang' => 'nullable|string|max:255',
            'hasil_pemeriksaan_terakhir' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Dapatkan pesan kesalahan yang disesuaikan untuk aturan validasi.
     */
    public function messages(): array
    {
        return [
            'NIK.required' => 'Nomor Induk Kependudukan (NIK) wajib diisi.',
            'NIK.digits' => 'NIK harus terdiri dari 16 digit angka.',
            'NIK.unique' => 'NIK ini sudah terdaftar di database.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'wilayah_id.required' => 'Wilayah wajib dipilih.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh di masa depan.', // PESAN DIPERBARUI
            'JK.in' => 'Pilihan Jenis Kelamin harus L (Laki-laki) atau P (Perempuan).', // PESAN DIPERBARUI
            'alamat_rt.required' => 'Nomor RT wajib diisi.',
            'alamat_rw.required' => 'Nomor RW wajib diisi.',
        ];
    }
}
