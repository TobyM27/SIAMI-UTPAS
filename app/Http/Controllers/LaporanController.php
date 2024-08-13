<?php

namespace App\Http\Controllers;

use App\Models\Ami;
use App\Models\Pengesahan;
use Illuminate\Http\Request;

class LaporanController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ami $ami)
    {
        $ami->load('standar.soal_standar', 'standar.tilik');
        $jumlah_tilik = $ami->standar->pluck('tilik')->flatten()->count();
        // dd($ami->standar->pluck('tilik')->flatten()->toArray());
        $jumlah_butir_mutu = $ami->standar->pluck('soal_standar')->flatten()->groupBy('butir_mutu')->count();
        $prodi = $ami->prodi;
        $siklus = $ami->siklus;
        $tanggal_ami = $ami->tanggal_ami->locale('id_ID');
        $tanggal_mulai = $ami->tanggal_mulai->locale('id_ID');
        $tanggal_akhir = $ami->tanggal_akhir->locale('id_ID');
        $spmi = $ami->nama_spmi;
        $rektor = $ami->rektor;
        $warek = $ami->warek;
        $auditee = $ami->user_auditee;
        $auditor1 = $ami->user_auditor1;
        $auditor2 = $ami->user_auditor2;
        $anggaran = $ami->rancangan_anggaran;
        // $penilaian = $ami->penilaian;
        $penilaian =$ami->penilaian()->where('angka', '<', 5)
        ->with('tilik.standar.instrumen')->get();
        $rtp = $ami->rtp()->with('standar')->get()->groupBy('standar.nama');

        $alreadyApproved = Pengesahan::where('id_ami', $ami->id)
        ->get()->toArray();
        return view("user.laporan.laporan", compact(
            'ami', 'jumlah_butir_mutu', 'jumlah_tilik',
            'prodi', 'siklus', 'tanggal_ami', 'tanggal_mulai',
            'tanggal_akhir', 'spmi', 'rektor',
            'warek', 'auditee', 'auditor1', 'auditor2', 'anggaran',
            'penilaian', 'rtp', 'alreadyApproved'
        ));
        
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
