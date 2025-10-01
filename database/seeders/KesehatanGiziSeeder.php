<?php

namespace Database\Seeders;

use App\Models\KesehatanGizi;
use App\Models\Sektor;
use App\Models\Penduduk;
use Illuminate\Database\Seeder;

class KesehatanGiziSeeder extends Seeder
{
    public function run()
    {
        $sektor = Sektor::where('name', 'Kesehatan Gizi')->first();
        $penduduk = Penduduk::first(); // Assuming at least one penduduk exists

        if ($sektor && $penduduk) {
            KesehatanGizi::create([
                'sektor_id' => $sektor->id,
                'penduduk_id' => $penduduk->id,
                'bmi' => 22.5,
                'diet_type' => 'Seimbang',
                'deficiencies' => 'Vitamin D',
                'nutritional_status' => 'Normal',
                'assessment_date' => now(),
            ]);
        }
    }
}
