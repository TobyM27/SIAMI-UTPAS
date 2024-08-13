<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RancanganAnggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rancangan_anggaran = [
            [
                'id_ami' => '1',
                'nama_item' => 'banner',
                'harga_satuan' => '1',
                'jumlah_item' => '2',
                'subtotal'=>'3',

            ],
        ];
        DB::table('rancangan_anggaran')->insert($rancangan_anggaran);

    }
}
