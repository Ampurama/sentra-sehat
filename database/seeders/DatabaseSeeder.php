<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // database/seeders/DatabaseSeeder.php
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            SektorSeeder::class,
            WilayahSeeder::class,
            PendudukSeeder::class,
            KesehatanLingkunganSeeder::class,
            PenyakitSeeder::class,
            KesehatanGiziSeeder::class,
            KesehatanAnakIbuSeeder::class,
            AdminUserSeeder::class,
            DinkesAdminSeeder::class,
            PuskesmasAdminSeeder::class,
            KadesSeeder::class,
            PatientUserSeeder::class,
        ]);
    }
}
