<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokumen = [
            [
                'id_ami' => '1',
                'id_soalstandar' => '1',
                'link' => 'google.com',
                'jawaban' => true,
                'keterangan' => 'cukup',
                'status_verifikasi' => false,
                'komentar_verifikasi' =>'tidak ada',
            ],
        ];

        DB::table('dokumen')->insert($dokumen);

    }
}
