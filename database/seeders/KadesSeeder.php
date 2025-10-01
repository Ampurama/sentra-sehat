<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KadesSeeder extends Seeder
{
    public function run()
    {
        $roleKades = Role::where('name', 'kades')->first();
        if (!$roleKades) {
            $this->command->error('Kades role not found. Run RoleSeeder first.');
            return;
        }

        // Get some sample wilayah (desa) from Pattallassang kecamatan
        $wilayahSamples = \App\Models\Wilayah::where('nama_kecamatan', 'Pattallassang')->take(3)->get();
        if ($wilayahSamples->isEmpty()) {
            $this->command->error('No wilayah found in Pattallassang. Run WilayahSeeder first.');
            return;
        }

        $kadesData = [
            [
                'name' => 'Kades Desa 1',
                'email' => 'kades1@pattallassang.com',
                'nik' => '3333333333333331',
                'wilayah' => $wilayahSamples[0] ?? null,
            ],
            [
                'name' => 'Kades Desa 2',
                'email' => 'kades2@pattallassang.com',
                'nik' => '3333333333333332',
                'wilayah' => $wilayahSamples[1] ?? null,
            ],
            [
                'name' => 'Kades Desa 3',
                'email' => 'kades3@pattallassang.com',
                'nik' => '3333333333333333',
                'wilayah' => $wilayahSamples[2] ?? null,
            ],
        ];

        foreach ($kadesData as $data) {
            if (!$data['wilayah']) continue;

            $existingKades = User::where('email', $data['email'])->first();
            if (!$existingKades) {
                User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'nik' => $data['nik'],
                    'password' => Hash::make('password123'),
                    'role_id' => $roleKades->id,
                    'wilayah_id' => $data['wilayah']->id,
                    'penduduk_id' => null,
                    'sektor_id' => null,
                ]);
                $this->command->info("Kades user {$data['name']} created successfully.");
            } else {
                $this->command->info("Kades user {$data['name']} already exists.");
            }
        }
    }
}
