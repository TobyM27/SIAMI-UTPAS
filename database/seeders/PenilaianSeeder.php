<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penilaian = [
            [
                'id_ami' => '1',
                'id_tilik' => '1',
                'angka' => '3',
                'catatan' => 'tidak ada',
                'kelebihan'=> 'sesuai',
                'kekurangan_kategori'=> '1',
                'peluang_peningkatan'=> 'tidak ada',

            ],
        ];
        DB::table('penilaian')->insert($penilaian);

    }
}
