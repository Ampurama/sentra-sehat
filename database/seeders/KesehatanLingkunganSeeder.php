<?php

namespace Database\Seeders;

use App\Models\KesehatanLingkungan;
use App\Models\Sektor;
use App\Models\Wilayah;
use Illuminate\Database\Seeder;

class KesehatanLingkunganSeeder extends Seeder
{
    public function run()
    {
        $sektor = Sektor::where('name', 'Kesehatan Lingkungan')->first();
        $wilayah = Wilayah::first(); // Assuming at least one wilayah exists

        if ($sektor && $wilayah) {
            KesehatanLingkungan::create([
                'sektor_id' => $sektor->id,
                'wilayah_id' => $wilayah->id,
                'description' => 'Kesehatan lingkungan di wilayah ini cukup baik.',
                'air_quality' => 85.5,
                'sanitation_level' => 'Tinggi',
                'waste_management' => 'Teratur',
            ]);
        }
    }
}
