<?php

namespace Database\Seeders;

use App\Models\Laporan;
use Illuminate\Database\Seeder;

/**
 * Data contoh (tanpa foto) untuk mencoba pagination.
 * Jalankan: php artisan db:seed --class=LaporanSeeder
 */
class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        Laporan::factory()->count(12)->create();
    }
}
