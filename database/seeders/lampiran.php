<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class lampiran extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengesahan = [ 
            [
                'id_ami' => '1',
                'link' => 'google.com',
            ],
        ];
        DB::table('pengesahan')->insert($pengesahan);
    }
}
