<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RtpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rtp = [
            [
                'id_ami' => 1,
                'temuan' => 'blabla',
                'rtp' => 'blablabla',
                'penanggungjawab' => 'annita',
            ],
        ];
        DB::table('rtp')->insert($rtp);

    }
}
