<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTindakanIntervensiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Otorisasi ditangani di Controller
    }

    public function rules(): array
    {
        return [
            // Field TindakanIntervensi
            'penduduk_id' => 'required|exists:penduduk,id', // ID Penduduk yang diintervensi
            'penyakit_id' => 'required|exists:penyakits,id',
            'tanggal_intervensi' => 'required|date',
            'diagnosis' => 'required|string|max:255',
            'tindakan' => 'required|string|max:500',
            'status_fungsional' => 'nullable|string|max:255',

            // Field RencanaLanjutan
            'keluhan_komplikasi' => 'nullable|string|max:500',
            'jadwal_kontrol_berikutnya' => 'nullable|date',
            'terapi_lanjutan' => 'nullable|string|max:255',
            'kebutuhan_pendampingan' => 'nullable|string|max:255',
            'keterangan_lain' => 'nullable|string',
        ];
    }
    
    public function messages(): array
    {
        return [
            'penyakit_id.required' => 'Penyakit wajib dipilih.',
            'penyakit_id.exists' => 'Penyakit yang dipilih tidak valid.',
            'diagnosis.required' => 'Diagnosis wajib diisi.',
            'penduduk_id.required' => 'Data penduduk tidak ditemukan.',
            'tanggal_intervensi.required' => 'Tanggal intervensi wajib diisi.',
            'tindakan.required' => 'Tindakan wajib diisi.',
        ];
    }
}
