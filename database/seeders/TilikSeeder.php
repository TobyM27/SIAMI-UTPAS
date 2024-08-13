<?php

namespace Database\Seeders;

use App\Models\Standar;
use App\Models\Tilik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/data/tilikSeeder.csv"), "r");
        $firstline = true;
        
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $id_standar = Standar::where('nama', $data['0'])
                    ->first()
                    ->id;

                $tilik = Tilik::create([
                    'pertanyaan' => $data['2'],
                    'id_standar' => $id_standar,
                    'butir_mutu' => $data['1']
                ]);
            }
            $firstline = false;
        }
   
        fclose($csvFile);
//         $tiliks = [
//             [
//                 'nama_standar' => 'Standar Kompetensi Lulusan',
//                 'tilik' => [
//                     [
//                         'pertanyaan' => 'Apakah dokumen Profil Lulusan Program Studi memenuhi Aspek; 
// 1.	Aspek Sikap
// 2.	Aspek Pengetahuan
// 3.	Aspek Keterampilan (Umum dan Khusus)',
//                         'butir_mutu' => 'Tersedianya dokumen Profil Lulusan Program Studi (Sikap, Pengetahuan, Keterampilan umum dan Khusus)'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah tersedia dokumen sahih tentang sosialisasi profil lulusan Program Studi ?',
//                         'butir_mutu' => 'Tersedianya dokumen Profil Lulusan Program Studi (Sikap, Pengetahuan, Keterampilan umum dan Khusus)'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah Profil lulusan sudah sesuai dengan visi dan misi Program Studi ?',
//                         'butir_mutu' => 'Tersedianya dokumen Profil Lulusan Program Studi (Sikap, Pengetahuan, Keterampilan umum dan Khusus)'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah dilaksanakan rapat pengendalian hasil evaluasi profil lulusan',
//                         'butir_mutu' => 'Tersedianya dokumen Profil Lulusan Program Studi (Sikap, Pengetahuan, Keterampilan umum dan Khusus)'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah ada peningkatan  Profil Lulusan ?',
//                         'butir_mutu' => 'Tersedianya dokumen Profil Lulusan Program Studi (Sikap, Pengetahuan, Keterampilan umum dan Khusus)'
//                     ]
//                 ]
//             ],
//             [
//                 'nama_standar' => 'Standar Kompetensi Lulusan',
//                 'tilik' => [
//                     [
//                         'pertanyaan' => 'Apakah dokumen kurikulum sudah sesuai dengan pedoman?',
//                         'butir_mutu' => 'Dokumen Capaian Pembelajaran Lulusan (CPL) pada program Studi sesuai SNPT dan Level KKNI'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah tersedia laporan capaian pembelajaran setiap mata kuliah (CPMK)?',
//                         'butir_mutu' => 'Dokumen Capaian Pembelajaran Lulusan (CPL) pada program Studi sesuai SNPT dan Level KKNI'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah CPMK sudah sesuai dengan CPL ?',
//                         'butir_mutu' => 'Dokumen Capaian Pembelajaran Lulusan (CPL) pada program Studi sesuai SNPT dan Level KKNI'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah dilaksanakan rapat pengendalian hasil evaluasi CPL ?',
//                         'butir_mutu' => 'Dokumen Capaian Pembelajaran Lulusan (CPL) pada program Studi sesuai SNPT dan Level KKNI'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah ada peningkatan CPL ?',
//                         'butir_mutu' => 'Dokumen Capaian Pembelajaran Lulusan (CPL) pada program Studi sesuai SNPT dan Level KKNI'
//                     ]
//                 ]
//             ],
//             [
//                 'nama_standar' => 'Standar Kompetensi Lulusan',
//                 'tilik' => [
//                     [
//                         'pertanyaan' => 'Apakah tersedia kebijakan tentang Treacher Study ?',
//                         'butir_mutu' => 'Tersedia dokumen dan link akun Treacher Study Dokumen Treacher Study'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah tersedia laporan Treacher Study dan E- Treacher Study ?',
//                         'butir_mutu' => 'Tersedia dokumen dan link akun Treacher Study Dokumen Treacher Study'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah jumlah  lulusan yang meresepon treacher study sudah memenuhi 20 % dari jumlah Alumni per- tahun ?',
//                         'butir_mutu' => 'Tersedia dokumen dan link akun Treacher Study Dokumen Treacher Study'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah dilaksanakan rapat pengendalian hasil Treacher Study  ?',
//                         'butir_mutu' => 'Tersedia dokumen dan link akun Treacher Study Dokumen Treacher Study'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah ada peningkatan terhadap hasil Treacher Study dan dilakukan pelaporan setiap tahun melalui E- Treacher Study Kemendikbud ?',
//                         'butir_mutu' => 'Tersedia dokumen dan link akun Treacher Study Dokumen Treacher Study'
//                     ]
//                 ]
//             ],
//             [
//                'nama_standar' => 'Standar Kompetensi Lulusan',
//                 'tilik' => [
//                     [
//                         'pertanyaan' => 'Apakah ada dokumen kebijakan tentang Waktu Tunggu Lulusan Bekerja ?',
//                         'butir_mutu' => 'Waktu Tunggu Lulusan Bekerja  ≤ 6 bulan'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah tersedia laporan tentang Waktu Tunggu Lulusan?',
//                         'butir_mutu' => 'Waktu Tunggu Lulusan Bekerja  ≤ 6 bulan'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah  Waktu Lulusan sudah sesuai yaitu ≤6 bulan ?',
//                         'butir_mutu' => 'Waktu Tunggu Lulusan Bekerja  ≤ 6 bulan'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah dilaksanakan rapat pengendalian hasil Waktu Tunggu Lulusan ?',
//                         'butir_mutu' => 'Waktu Tunggu Lulusan Bekerja  ≤ 6 bulan'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah ada peningkatan terhadap Waktu Tunggu Lulusan ? (kalau ada berapa % peningkatan dari jumlah alumni)',
//                         'butir_mutu' => 'Waktu Tunggu Lulusan Bekerja  ≤ 6 bulan'
//                     ]
//                 ] 
//             ],
//             [
//                 'nama_standar' => 'Standar Kompetensi Lulusan',
//                 'tilik' => [
//                     [
//                         'pertanyaan' => 'Apakah tersedia Kebijakan tentang TOEFL dan Brevet ?',
//                         'butir_mutu' => 'Tersedia Dokumen TOEFL dan Brevet Mahasiswa'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah tersedia laporan tentang data nama alumni yang telah memiliki sertifikat Toefl? (dilengkapi dengan file sertifikat TOEFL dan Brevet per-tahun)',
//                         'butir_mutu' => 'Tersedia Dokumen TOEFL dan Brevet Mahasiswa'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah semua Lulusan memiliki sertifikat TOEFL dan Brevet ?',
//                         'butir_mutu' => 'Tersedia Dokumen TOEFL dan Brevet Mahasiswa'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah dilaksanakan rapat pengendalian hasil pelaksanaan TOEFL dan Brevet ?',
//                         'butir_mutu' => 'Tersedia Dokumen TOEFL dan Brevet Mahasiswa'
//                     ],
//                     [
//                         'pertanyaan' => 'Apakah ada peningkatan terkait kegiatan TOEFL dan Brevet ? (jika ada kegiatan tambahan selain TOEFL dan Brevet)',
//                         'butir_mutu' => 'Tersedia Dokumen TOEFL dan Brevet Mahasiswa'
//                     ]
//                 ]
//             ],
            
//         ];
//         foreach ($tiliks as $std){
//             $id_standar = Standar::where("Nama", $std['nama_standar'])
//             ->first()
//             ->id;
//             foreach ($std['tilik'] as $tilik) {
//                 $tlk = Tilik::create([
                    // 'pertanyaan' => $tilik['pertanyaan'],
                    // 'id_standar' => $id_standar,
                    // 'butir_mutu' => $tilik['butir_mutu']
//                 ]);
    
//             }
//         }
    }
}
