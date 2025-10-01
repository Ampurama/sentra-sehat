<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'super_admin', 'description' => 'Akses penuh ke seluruh sistem.'],
            ['name' => 'dinkes_admin', 'description' => 'Admin di tingkat Dinas Kesehatan.'],
            ['name' => 'puskesmas_admin', 'description' => 'Admin di tingkat Puskesmas/Klinik.'],
            ['name' => 'dokter', 'description' => 'Petugas medis untuk input tindakan.'],
            ['name' => 'kades', 'description' => 'Kepala Desa untuk monitoring dan pendampingan.'],
            ['name' => 'patient', 'description' => 'Pasien yang dapat melihat riwayat intervensi kesehatan.'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
}
