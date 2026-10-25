<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name'     => $faker->name(),
                'email'    => $faker->unique()->safeEmail(),
                'password' => Hash::make('petugas123'),
            ]);
        }

        User::updateOrCreate(
            ['email' => 'admin@bpbd.test'],
            ['name' => 'Admin BPBD', 'password' => Hash::make('admin12345')]
        );
    }
}