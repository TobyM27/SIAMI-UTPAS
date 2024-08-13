<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengesahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengesahan = [ 
            [
                'id_ami' => '1',
                'id_user' => '1',
                'nama' => 'Anita',
                'jabatan' => 'Kaprodi',
                'tanggal'=> date('Y-m-d H:i:s', time()),
            ]
        ];
        DB::table('pengesahan')->insert($pengesahan);
    }
}
