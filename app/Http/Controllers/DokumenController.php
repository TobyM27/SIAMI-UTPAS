<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(Request $request)
    {

        $links = array_filter($request->input("link_dokumen"));
        $id_ami = $request->input("id_ami");
        foreach($links as $id_soalstandar => $link){
            $dokumen = Dokumen::where('id_ami',$id_ami)->where('id_soalstandar',$id_soalstandar)->first();
            if($dokumen == null){
                $dokumen = Dokumen::create([
                    'id_ami' => $id_ami,
                    'id_soalstandar' => $id_soalstandar,
                    'link' => $link,
                ]);
            }else{
                $dokumen->link = $link;
                $dokumen->save();
            }
        }
        return redirect()->route('auditee.dokumen.create',$id_ami);
    }

    public function store_statusverifikasi(Request $request)
{
    $status_vrf = array_filter($request->input("status_vrf"), function ($status) {
        return $status !== null;
    });
    $komentar_verifikasi = array_filter($request->input("status_komentar"));
    $id_ami = $request->input("id_ami");

    foreach ($status_vrf as $id_soalstandar => $status_verifikasi) {
        $dokumen = Dokumen::where('id_ami', $id_ami)
                          ->where('id_soalstandar', $id_soalstandar)
                          ->first();
        if ($dokumen == null) {
            $dokumen = Dokumen::create([
                'id_ami' => $id_ami,
                'id_soalstandar' => $id_soalstandar,
                'status_verifikasi' => $status_verifikasi,
                'komentar_verifikasi' => $komentar_verifikasi[$id_soalstandar] ?? null,
            ]);
        } else {
            $dokumen->status_verifikasi = $status_verifikasi;
            $dokumen->komentar_verifikasi = $komentar_verifikasi[$id_soalstandar] ?? null;
            $dokumen->save();
        }
    }

    return redirect()->route('auditor.status.create', $id_ami);
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
     *

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
