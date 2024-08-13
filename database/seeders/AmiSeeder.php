<?php

namespace Database\Seeders;

use App\Models\Standar;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ami = [
            [
                'id_user_auditor1' => User::where('name', 'Roberto Tomahuw')->first()->id,
                'id_user_auditor2' => User::where('name', 'Lindawati Widjaja')->first()->id,
                'id_user_auditee' => User::where('name', 'Santi')->first()->id,
                'id_user_lpm' => User::where('name', 'Prima Dita Hapsari')->first()->id,
                'prodi' => 'Manajemen',
                'siklus' => '1',
                'tanggal_mulai' => date('Y-m-d H:i:s', time()),
                'tanggal_ami' => date('Y-m-d H:i:s', time()),
                'tanggal_akhir' => date('Y-m-d H:i:s', time()),
                'nama_rektor_utpas' => 'Sutarna',
                'nama_warek_utpas' => 'Budi Karyanto',
                'nama_spmi' => 'Nani',
                'sah' => true,
                'link_file' => 'https://www.filesk.com'
            ],
        ];

        DB::table('ami')->insert($ami);
    }
}
