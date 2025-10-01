<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWilayahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Otorisasi ditangani di Controller
    }

    public function rules(): array
    {
        // Pastikan kode_pos unique kecuali saat update data yang sama
        $uniqueKodePos = 'nullable|string|max:10|unique:wilayah,kode_pos';
        if ($this->route('wilayah')) {
             $uniqueKodePos = 'nullable|string|max:10|unique:wilayah,kode_pos,' . $this->route('wilayah')->id;
        }

        return [
            'kode_pos' => $uniqueKodePos,
            'nama_desa' => 'required|string|max:100',
            'nama_kecamatan' => 'required|string|max:100',
            'nama_kabupaten' => 'required|string|max:100',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ];
    }
    
    public function messages(): array
    {
        return [
            'nama_desa.required' => 'Nama desa wajib diisi.',
            'nama_kecamatan.required' => 'Nama kecamatan wajib diisi.',
            'nama_kabupaten.required' => 'Nama kabupaten wajib diisi.',
            'kode_pos.unique' => 'Kode Pos sudah digunakan untuk wilayah lain.'
        ];
    }
}
