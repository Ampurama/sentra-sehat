<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use App\Models\Sektor;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder
{
    public function run()
    {
        $sektor = Sektor::where('name', 'Faktor Risiko Penyakit dan Penyakit')->first();

        if ($sektor) {
            $penyakits = [
                [
                    'sektor_id' => $sektor->id,
                    'name' => 'Diabetes Mellitus',
                    'description' => 'Penyakit kronis yang mempengaruhi cara tubuh mengubah makanan menjadi energi.',
                    'symptoms' => 'Sering haus, sering buang air kecil, lapar berlebihan, kelelahan.',
                    'prevalence' => 0.15,
                    'icd_code' => 'E10',
                    'spesialisasi' => 'Penyakit Dalam',
                ],
                [
                    'sektor_id' => $sektor->id,
                    'name' => 'Hipertensi',
                    'description' => 'Tekanan darah tinggi yang dapat menyebabkan masalah kesehatan serius.',
                    'symptoms' => 'Sakit kepala, pusing, penglihatan kabur, nyeri dada.',
                    'prevalence' => 0.20,
                    'icd_code' => 'I10',
                    'spesialisasi' => 'Penyakit Dalam',
                ],
                [
                    'sektor_id' => $sektor->id,
                    'name' => 'Penyakit Jantung',
                    'description' => 'Kondisi yang mempengaruhi fungsi jantung dan pembuluh darah.',
                    'symptoms' => 'Nyeri dada, sesak napas, pusing, kelelahan.',
                    'prevalence' => 0.18,
                    'icd_code' => 'I20',
                    'spesialisasi' => 'Penyakit Dalam',
                ],
                [
                    'sektor_id' => $sektor->id,
                    'name' => 'Asma Jantung',
                    'description' => 'Kombinasi asma dan masalah jantung yang mempengaruhi pernapasan.',
                    'symptoms' => 'Sesak napas, batuk, nyeri dada, kelelahan.',
                    'prevalence' => 0.12,
                    'icd_code' => 'J45',
                    'spesialisasi' => 'Penyakit Dalam',
                ],
                [
                    'sektor_id' => $sektor->id,
                    'name' => 'Asma Obstruktif',
                    'description' => 'Penyakit paru obstruktif kronis yang menyulitkan pernapasan.',
                    'symptoms' => 'Sesak napas, batuk kronis, produksi dahak.',
                    'prevalence' => 0.10,
                    'icd_code' => 'J44',
                    'spesialisasi' => 'Penyakit Dalam',
                ],
                [
                    'sektor_id' => $sektor->id,
                    'name' => 'Stroke',
                    'description' => 'Gangguan aliran darah ke otak yang menyebabkan kerusakan sel otak.',
                    'symptoms' => 'Kelemahan wajah, kesulitan berbicara, kehilangan keseimbangan.',
                    'prevalence' => 0.16,
                    'icd_code' => 'I63',
                    'spesialisasi' => 'Penyakit Dalam',
                ],
            ];

            foreach ($penyakits as $penyakit) {
                Penyakit::create($penyakit);
            }
        }
    }
}
