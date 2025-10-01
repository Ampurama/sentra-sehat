<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Sektor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PuskesmasAdminSeeder extends Seeder
{
    public function run()
    {
        $rolePuskesmas = Role::where('name', 'puskesmas_admin')->first();
        if (!$rolePuskesmas) {
            $this->command->error('Puskesmas admin role not found. Run RoleSeeder first.');
            return;
        }

        // Wilayah for Pattallassang
        $wilayahPattallassang = \App\Models\Wilayah::where('nama_kecamatan', 'Pattallassang')->first();
        if (!$wilayahPattallassang) {
            $this->command->error('Wilayah Pattallassang not found. Run WilayahSeeder first.');
            return;
        }

        // Wilayah for Mappakasunggu
        $wilayahMappakasunggu = \App\Models\Wilayah::where('nama_kecamatan', 'Mappakasunggu')->first();
        if (!$wilayahMappakasunggu) {
            $this->command->error('Wilayah Mappakasunggu not found. Run WilayahSeeder first.');
            return;
        }

        // Create admin for Pattallassang
        $existingPattallassangAdmin = User::where('email', 'puskesmas-pattallassang@sentra.com')->first();
        if (!$existingPattallassangAdmin) {
            User::create([
                'name' => 'Admin Puskesmas Pattallassang',
                'email' => 'puskesmas-pattallassang@sentra.com',
                'nik' => '2222222222222221', // Dummy NIK
                'password' => Hash::make('password123'),
                'role_id' => $rolePuskesmas->id,
                'wilayah_id' => $wilayahPattallassang->id,
                'penduduk_id' => null,
            ]);
            $this->command->info('Puskesmas Pattallassang admin user created successfully.');
        } else {
            $this->command->info('Puskesmas Pattallassang admin user already exists.');
        }

        // Create admin for Mappakasunggu
        $existingMappakasungguAdmin = User::where('email', 'puskesmas-mappakasunggu@sentra.com')->first();
        if (!$existingMappakasungguAdmin) {
            User::create([
                'name' => 'Admin Puskesmas Mappakasunggu',
                'email' => 'puskesmas-mappakasunggu@sentra.com',
                'nik' => '2222222222222223', // Dummy NIK
                'password' => Hash::make('password123'),
                'role_id' => $rolePuskesmas->id,
                'wilayah_id' => $wilayahMappakasunggu->id,
                'penduduk_id' => null,
            ]);
            $this->command->info('Puskesmas Mappakasunggu admin user created successfully.');
        } else {
            $this->command->info('Puskesmas Mappakasunggu admin user already exists.');
        }
    }
}
