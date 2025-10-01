<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Penduduk;
use App\Models\Role;

class PatientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the patient role
        $patientRole = Role::where('name', 'patient')->first();

        if (!$patientRole) {
            $this->command->error('Patient role not found. Please run RoleSeeder first.');
            return;
        }

        // Get some penduduk records to create patient accounts
        $penduduks = Penduduk::take(5)->get(); // Take first 5 penduduk as sample patients

        foreach ($penduduks as $penduduk) {
            // Check if user already exists
            $existingUser = User::where('nik', $penduduk->NIK)->first();

            if (!$existingUser) {
                User::create([
                    'name' => $penduduk->nama,
                    'email' => strtolower(str_replace(' ', '.', $penduduk->nama)) . '@patient.local', // Generate email
                    'nik' => $penduduk->NIK,
                    'penduduk_id' => $penduduk->id,
                    'role_id' => $patientRole->id,
                    'sektor_id' => 1, // Default sektor for patients
                    'password' => Hash::make('password123'), // Default password for demo
                ]);

                $this->command->info("Created patient user for: {$penduduk->nama} (NIK: {$penduduk->NIK})");
            } else {
                $this->command->info("Patient user already exists for: {$penduduk->nama} (NIK: {$penduduk->NIK})");
            }
        }

        $this->command->info('Patient users seeding completed.');
        $this->command->info('Default password for all patients: password123');
    }
}
