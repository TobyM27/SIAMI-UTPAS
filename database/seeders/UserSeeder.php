<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Gono Sutrisno',
                'email' => 'gono@utpas.ac.id',
                'password' => Hash::make('gono321'),
                'role' => 'LPM',
                'prodi' => '',
            ],
            [
                'name' => 'Sutarna',
                'email' => 'sutarna@utpas.ac.id',
                'password' => Hash::make('sutarna321'),
                'role' => 'LPM',
                'prodi' => 'Manajemen',
            ],
            [
                'name' => 'Roberto Tomahuw',
                'email' => 'roberto@utpas.ac.id',
                'password' => Hash::make('roberto321'),
                'role' => 'Auditor',
                'prodi' => '',
            ],
            [
                'name' => 'Lindawati Widjaja',
                'email' => 'lindawati@utpas.ac.id',
                'password' => Hash::make('lindawati321'),
                'role' => 'Auditor',
                'prodi' => '',
            ],
            [
                'name' => 'Budi Karyanto',
                'email' => 'budi@utpas.ac.id',
                'password' => Hash::make('budi321'),
                'role' => 'Auditor',
                'prodi' => '',
            ],
            [
                'name' => 'Santi',
                'email' => 'santi@utpas.ac.id',
                'password' => Hash::make('santi321'),
                'role' => 'Auditor',
                'prodi' => 'Manajemen',
            ],
            [
                'name' => 'Prima Dita Hapsari',
                'email' => 'prima@utpas.ac.id',
                'password' => Hash::make('prima321'),
                'role' => 'Auditor',
                'prodi' => 'Akuntansi',
            ],
            [
                'name' => 'Ronald Tehupuring',
                'email' => 'ronald@utpas.ac.id',
                'password' => Hash::make('ronald321'),
                'role' => 'Auditor',
                'prodi' => 'Akuntansi',
            ],
            [
                'name' => 'Weri Aprilia',
                'email' => 'weri@utpas.ac.id',
                'password' => Hash::make('weri321'),
                'role' => 'Auditor',
                'prodi' => 'Akuntansi',
            ]
        ];
    
        DB::table('users')->insert($users);
    }


}
