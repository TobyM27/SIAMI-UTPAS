<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         // Log the entire request data for debugging
         Log::info($request->all());
     
         // Filter the 'nilai' input
         $semua_nilai = array_filter($request->input("nilai"), function ($data_nilai) {
             return $data_nilai['angka'] ?? null;
         });
     
         $id_ami = $request->input("id_ami");
     
         foreach ($semua_nilai as $id_tilik => $data_nilai) {
             // Log each id_tilik and data_nilai for debugging
             Log::info("ID Tilik: {$id_tilik}, Data Nilai: ", $data_nilai);
     
             // Find existing record or create a new one
             $nilai = Penilaian::where('id_ami', $id_ami)->where('id_tilik', $id_tilik)->first();
     
             if ($nilai === null) {
                 $nilai = Penilaian::create([
                     'id_ami' => $id_ami,
                     'id_tilik' => $id_tilik,
                     'angka' => $data_nilai['angka'],
                     'catatan' => $data_nilai['catatan'],
                 ]);
             } else {
                $nilai->angka = $data_nilai['angka'];
                $nilai->catatan = $data_nilai['catatan'];
                $nilai->save();
                //  $nilai->update([
                //      'angka' => $data_nilai['angka'],
                //      'catatan' => $data_nilai['catatan'],
                //  ]);
             }
         }
     
         return redirect()->route('auditor.view.tilik', $id_ami);
     }

    // public function store(Request $request)
    // {
    //     $semua_nilai = array_filter($request->input("nilai"), function ($data_nilai) {
    //         return $data_nilai['angka'] ?? null;
    //     });
    //     $id_ami = $request->input("id_ami");
    //     foreach($semua_nilai as $id_tilik => $data_nilai){
    //         $nilai = Penilaian::where('id_ami', $id_ami)->where('id_tilik', $id_tilik)->first();
    //         if($nilai == null){
    //             $nilai = Penilaian::create([
    //                 'id_ami' => $id_ami,
    //                 'id_tilik' => $id_tilik,
    //                 'angka' => $data_nilai['angka'],
    //                 'catatan' => $data_nilai['catatan'],
    //             ]);
    //         }else{
    //             $nilai->update([
    //                 $nilai->angka = $data_nilai['angka'],
    //                 $nilai->catatan = $data_nilai['catatan'],
    //             ]);
    //             // $nilai->save();
    //         }
    //     }
    //     return redirect()->route('auditor.view.tilik', $id_ami);
    // }

    public function store_temuan(Request $request){
        $data_temuan = $request->input('temuan');
        $id_ami = $request->input("id_ami");
        $data_temuan = array_filter($data_temuan, function ($temuan) {
            return array_key_exists('kekurangan_kategori', $temuan) && $temuan['kekurangan_kategori'] != null;
        });

        foreach ($data_temuan as $id_penilaian => $temuan) {
            $penilaian = Penilaian::find($id_penilaian);
            $penilaian->kelebihan = $temuan['kelebihan'];
            $penilaian->kekurangan_kategori = $temuan['kekurangan_kategori'];
            $penilaian->peluang_peningkatan = $temuan['peluang_peningkatan'];

            $penilaian->save();
        }

        return redirect()->route("auditor.temuan.view", $id_ami);
    }

    public function store_rtp(Request $request){
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
