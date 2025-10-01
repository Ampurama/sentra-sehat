<?php

namespace Database\Seeders;

use App\Models\Sektor;
use Illuminate\Database\Seeder;

class SektorSeeder extends Seeder
{
    public function run()
    {
        $sektors = [
            ['name' => 'Dinas Kesehatan', 'type' => 'Dinas'],
            ['name' => 'Dinas Kependudukan dan Catatan Sipil', 'type' => 'Dinas'],
            ['name' => 'Puskesmas A', 'type' => 'Fasilitas Kesehatan'],
            ['name' => 'BPJS', 'type' => 'Lainnya'],
            ['name' => 'Kesehatan Lingkungan', 'type' => 'Sektor Kesehatan'],
            ['name' => 'Faktor Risiko Penyakit dan Penyakit', 'type' => 'Sektor Kesehatan'],
            ['name' => 'Kesehatan Gizi', 'type' => 'Sektor Kesehatan'],
            ['name' => 'Kesehatan Anak dan Ibu', 'type' => 'Sektor Kesehatan'],
        ];

        foreach ($sektors as $sektor) {
            Sektor::firstOrCreate(
                ['name' => $sektor['name']],
                $sektor
            );
        }
    }
}
