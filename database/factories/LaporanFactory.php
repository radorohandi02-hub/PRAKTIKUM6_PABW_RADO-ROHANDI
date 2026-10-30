<?php

namespace Database\Factories;

use App\Models\Laporan;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Laporan> */
class LaporanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_pelapor' => fake()->name(),
            'no_hp'        => '08'.fake()->numerify('##########'),
            'lokasi'       => 'Jl. '.fake()->streetName().' RT 0'.fake()->numberBetween(1, 9),
            'kecamatan'    => fake()->randomElement(Laporan::KECAMATAN),
            'tinggi_air'   => fake()->numberBetween(10, 150),
            'keterangan'   => fake()->sentence(),
            'foto'         => null,
            'status'       => 'Menunggu',
        ];
    }
}
