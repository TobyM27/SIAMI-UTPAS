<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstrumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instrumen = [ 
            [
                'nama_instrumen' => 'Pendidikan',
            ],
            [
                'nama_instrumen' => 'Penelitian',
            ],
            [
                'nama_instrumen' => "Pengabdian Kepada Masyarakat"
            ]
        ];
        DB::table('instrumen')->insert($instrumen);
    }
}
