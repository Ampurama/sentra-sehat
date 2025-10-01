<?php

namespace Database\Seeders;

use App\Models\KesehatanAnakIbu;
use App\Models\Sektor;
use App\Models\Penduduk;
use Illuminate\Database\Seeder;

class KesehatanAnakIbuSeeder extends Seeder
{
    public function run()
    {
        $sektor = Sektor::where('name', 'Kesehatan Anak dan Ibu')->first();
        $penduduk = Penduduk::first(); // Assuming at least one penduduk exists

        if ($sektor && $penduduk) {
            KesehatanAnakIbu::create([
                'sektor_id' => $sektor->id,
                'penduduk_id' => $penduduk->id,
                'child_vaccinations_complete' => true,
                'maternal_checkups_count' => 5,
                'birth_weight' => 3.2,
                'last_checkup' => now(),
                'notes' => 'Kesehatan ibu dan anak dalam kondisi baik.',
            ]);
        }
    }
}
