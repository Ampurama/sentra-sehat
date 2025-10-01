<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Sektor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $roleAdmin = Role::where('name', 'super_admin')->first();
        if (!$roleAdmin) {
            $this->command->error('Super admin role not found. Run RoleSeeder first.');
            return;
        }

        $sektorDinkes = Sektor::where('name', 'Dinas Kesehatan')->first();
        if (!$sektorDinkes) {
            $this->command->error('Dinas Kesehatan sektor not found. Run SektorSeeder first.');
            return;
        }

        $existingAdmin = User::where('email', 'admin@sentra.com')->first();
        if (!$existingAdmin) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@sentra.com',
                'nik' => '0000000000000000', // Dummy NIK for admin
                'password' => Hash::make('password123'), // Ganti dengan password kuat
                'role_id' => $roleAdmin->id,
                'sektor_id' => $sektorDinkes->id,
                'penduduk_id' => null, // Admin not tied to penduduk
            ]);

            $this->command->info('Super admin user created successfully.');
        } else {
            $this->command->info('Super admin user already exists.');
        }
    }
}