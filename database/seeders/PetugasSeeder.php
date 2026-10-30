<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        // Akun petugas dibuat lewat seeder (registrasi publik sengaja dinonaktifkan).
        User::updateOrCreate(
            ['email' => 'admin@bpbd.test'],
            ['name' => 'Admin BPBD', 'password' => Hash::make('admin12345')]
        );
    }
}
