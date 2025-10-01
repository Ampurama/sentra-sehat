<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Sektor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DinkesAdminSeeder extends Seeder
{
    public function run()
    {
        $roleDinkes = Role::where('name', 'dinkes_admin')->first();
        if (!$roleDinkes) {
            $this->command->error('Dinkes admin role not found. Run RoleSeeder first.');
            return;
        }

        $sektorDinkes = Sektor::where('name', 'Dinas Kesehatan')->first();
        if (!$sektorDinkes) {
            $this->command->error('Dinas Kesehatan sektor not found. Run SektorSeeder first.');
            return;
        }

        $existingDinkesAdmin = User::where('email', 'dinkes@sentra.com')->first();
        if (!$existingDinkesAdmin) {
            User::create([
                'name' => 'Admin Dinas Kesehatan',
                'email' => 'dinkes@sentra.com',
                'nik' => '1111111111111111', // Dummy NIK for dinkes admin
                'password' => Hash::make('password123'),
                'role_id' => $roleDinkes->id,
                'sektor_id' => $sektorDinkes->id,
                'penduduk_id' => null, // Admin not tied to penduduk
            ]);

            $this->command->info('Dinkes admin user created successfully.');
        } else {
            $this->command->info('Dinkes admin user already exists.');
        }
    }
}
