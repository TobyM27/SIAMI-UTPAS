<?php

namespace Database\Seeders;

use App\Models\Instrumen;
use App\Models\Standar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StandarSeeder extends Seeder
{

    public function run(): void
    {
        $csvFile = fopen(base_path("database/data/standarSeeder.csv"), "r");
  
        $firstline = true;
        $no_soal = 1;
        $butir_mutu = [];

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $id_instrumen = Instrumen::where('nama_instrumen', $data['0'])
                    ->first()
                    ->id;

                $standar = Standar::where('nama', $data['1'])->first();

                if ($standar == null) {
                    $standar = Standar::create([
                        'nama' => $data['1'],
                        'id_instrumen' => $id_instrumen,
                        // 'id_ami' => 1,
                    ]);
                }

                if (! in_array($data['2'], $butir_mutu)) {
                    $butir_mutu[] = $data['2'];
                    $no_soal = 1;
                }

                $soal_standar = $standar->soal_standar()->create([
                    'daftar_pertanyaan' => $data['3'],
                    'butir_mutu' => $data['2'],
                    'no_soal' => $no_soal
                ]);

                $no_soal++;
            }

            $firstline = false;

            
        }
   
        fclose($csvFile);
    }
}
