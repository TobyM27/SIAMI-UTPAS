<?php

namespace Database\Seeders;

use App\Models\Pengesahan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            // AmiSeeder::class,
            InstrumenSeeder::class,
            StandarSeeder::class,
            // DokumenSeeder::class,
            TilikSeeder::class,
            // PenilaianSeeder::class,
            // RancanganAnggaranSeeder::class,
            // PengesahanSeeder::class,
            // RtpSeeder::class,
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
