<?php

namespace App\Http\Controllers;

use App\Models\Ami;
use App\Models\Pengesahan;
use App\Models\RancanganAnggaran;
use App\Models\SoalStandar;
use App\Models\Standar;
use App\Models\Tilik;
use App\Models\User;
use Illuminate\Http\Request;

class AmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_lpm(string $prodi)
    {
        // 'desain-komunikasi-visual'
        $prodi = str_replace('-', ' ', $prodi); // desain komunikasi visual
        $prodi = ucwords($prodi); // Desain Komunikasi Visual
        $data_ami = Ami::where('prodi', $prodi)->get()->groupBy('siklus');
        /**
         * [
         *      1: [
         *          {id: 1, prodi: dkv, siklus: 1, auditee,auditor}
         *      ],
         *      2: [...],
         *      ...
         * ]
         */
        return view("user.lpm.lpm-prodi-page",[
            'data_ami' => $data_ami, 
            'prodi' => $prodi,
        ]);
    }

    public function index_ami_prodi(){
        $prodi = auth()->user()->prodi;
        $data_ami = Ami::where('prodi', $prodi)->get()->groupBy('siklus');
        return view("user.auditee-auditor.dashboard-audit-page", [
            'data_ami' => $data_ami,
            'prodi' => $prodi,
        ]);
    }

    public function index_prodi(){
        // $prodi = ['Teknologi Informasi', 'SI', 'A', 'B'];
        $data_ami = Ami::with('persetujuan')
        ->select([
            'id', 'siklus', 'prodi'
        ])
        ->orderByDesc('tanggal_mulai')
        ->groupBy([
            'id', 'siklus', 'prodi'
        ])
        ->get();
        $data_ami_prodi = [
            'Akuntansi' => [],
            'Desain Komunikasi Visual' => [],
            'Hukum' => [],
            'Manajemen' => [],
            'Manajemen Administrasi' => [],
            'Sekretari' => [],
            'Sistem Informasi' => [],
            'Teknologi Informasi' => [],
        ];
        foreach($data_ami_prodi as $nama_prodi => $ami_prodi){
            $ami = $data_ami->firstWhere('prodi', $nama_prodi);

            if ($ami == null) {
                $data_ami_prodi[$nama_prodi]['nama_prodi'] = $nama_prodi;
                $data_ami_prodi[$nama_prodi]['status'] = 'belum ada';
                continue;
            }

            $ami_prodi = [
                'nama_prodi'=>$ami->prodi, 
                'siklus'=>$ami->siklus,
                'url' => route('lpm.prodi.page', ['prodi' => $ami->prodi])
            ];

            $user_ami = [
                'auditee'=> $ami->id_user_auditee,
                'auditor1'=> $ami->id_user_auditor1,
                'auditor2'=> $ami->id_user_auditor2,
                'lpm'=> $ami->id_user_lpm,
            ];

            $user_setuju = $ami->persetujuan->pluck('id')->toArray();

            $diff_user = array_diff($user_ami, $user_setuju);

            if(empty($diff_user)){
                if($ami->sah == true){
                    $ami_prodi['status'] = 'disahkan';
                }else{
                    $ami_prodi['status'] = 'disetujui';
                }
            }else{
                $filter = array_keys(array_filter($user_ami, function($id_user)use($diff_user){
                    return in_array($id_user, $diff_user);
                }));
                if(array_diff($filter, ['auditee', 'auditor1', 'auditor2']) == []){
                    $ami_prodi['status'] = 'terlaksana';
                }else{
                    $ami_prodi['status'] = 'sedang dilaksanakan';
                }
            }

            $data_ami_prodi[$ami->prodi] = $ami_prodi;
        }

        // dd($data_ami_prodi);
        return view("user.lpm.lpm-main-page", [
            'data_ami_prodi'=>$data_ami_prodi,
            'ami' => $ami,
        ]);
    }

    // public function index_auditee(){
    //     $prodi = auth()->user()->prodi;
    //     $data_ami = Ami::where('prodi', $prodi)->get()->groupBy('siklus');
    //     return view('user.auditee-auditor.auditee.auditee-main-page',[
    //         'data_ami' => $data_ami, 
    //     ]);
    // }

    public function daftar_pertanyaan_auditee(Ami $ami){
        $data_pertanyaan = SoalStandar::with(["standar", "dokumen" => function ($query) use ($ami){
            $query->where('id_ami', $ami->id);
        }])->get()->groupBy('standar.nama')->toArray();
        return view("user.auditee-auditor.auditee.auditee-ami-page", [
            'data_pertanyaan' => $data_pertanyaan,
            'ami' => $ami,
            'dokumen' => $ami->dokumen,
        ]); 
    }

    public function daftar_pertanyaan_verdok(Ami $ami){
        $data_standar = $ami->standar()->with('soal_standar.dokumen')->get()->keyBy('nama');
        // $data_standar = SoalStandar::with(["standar", "dokumen" => function ($query) use ($ami){
        //     $query->where('id_ami', $ami->id);
        // }])->get()->groupBy('standar.nama')->toArray();
        // dd($data_standar);
        return view("user.auditee-auditor.auditor.auditor-verdok-page", [
            'data_standar' => $data_standar,
            'ami' => $ami,
            'dokumen' => $ami->dokumen,
        ]);
    }

    public function daftar_pertanyaan_auditor(Ami $ami){
        $data_pertanyaan = SoalStandar::get();
        return view("user.auditee-auditor.auditor.auditor-main-page", [
            'data_pertanyaan' => $data_pertanyaan,
            'ami' => $ami,
            'dokumen' => $ami->dokumen,
        ]);
    }

    public function daftar_pertanyaan_lpm(Ami $ami){
        $data_pertanyaan = $ami->standar()->with('soal_standar')->get()->pluck('soal_standar')->flatten();
        return view("user.lpm.lpm-progress-page", [
            'data_pertanyaan' => $data_pertanyaan,
            'ami' =>$ami,
        ]);
    }

    public function daftar_pertanyaan_tilik(Ami $ami){
        $data_tilik = $ami->standar()->with('instrumen', 'tilik.penilaian')
        ->get()
        ->groupBy('instrumen.nama_instrumen');
        // $data_tilik = Tilik::with([
        //     'standar.instrumen',
        //     'penilaian' => function ($query) use ($ami) {
        //         $query->where('id_ami', $ami->id);
        //     }
        //     ])->get()->groupBy(['standar.instrumen.nama_instrumen', 'standar.nama']);
        return view("user.auditee-auditor.auditor.auditor-tilik-page", [
            'data_tilik' => $data_tilik,
            'ami' => $ami,
            // 'standar' => $standar_tilik->id
        ]);
    }

    public function daftar_butir_temuan(Ami $ami){
        $data_penilaian = $ami->penilaian()->where('angka', '<', 5)
        ->with('tilik.standar.instrumen')->get()->groupBy(['tilik.standar.instrumen.nama_instrumen', 'tilik.standar.nama']);
        // $data_temuan = Tilik::with('standar.instrumen')->get()->groupBy(['standar.instrumen.nama_instrumen', 'standar.nama']);
        return view("user.auditee-auditor.auditor.auditor-temuan-page", [
            // 'data_temuan' => $data_temuan,
            'data_penilaian' => $data_penilaian,
            'ami' => $ami,
        ]);
    }

    public function daftar_butir_rtp(Ami $ami){
        $data_standar = $ami->standar()->with([
            'rtp' => function ($query) use ($ami) {
                $query->where('id_ami', $ami->id);
            }
        ])->get();
        
        return view("user.lpm.lpm-lampiran-page", [
            'data_standar' => $data_standar,
            'ami' => $ami,
        ]);
    }

    public function daftar_butir_mutu(Ami $ami){
        $data_butir_mutu = Tilik::with('standar')->get();
        return view('user.auditee-auditor.auditor.auditor-ami1-page', [
            'data_butir_mutu' => $data_butir_mutu,
            'ami' => $ami,
        ]);
    }

    public function daftar_lpm_assign(Ami $ami){
        $prodi = Ami::get();
        return view("user.lpm.lpm-assign-page", [
            'prodi' => $prodi,
        ]);
    }

    // public function daftar_lpm_standar(Ami $ami){
    //     $standar = Standar::get();
    //     return view("user.lpm.lpm-assign-page", [
    //         'nama' => $standar,
    //     ]);
    // }

    public function store_lpm_assign_edit(Request $request, Ami $ami){
        $id_ami = $ami->id;
        $prodi = $ami->prodi;
        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_ami = $request->input('tanggal_ami');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $nama_rektor_utpas = $request->input('nama_rektor_utpas');
        $nama_warek_utpas = $request->input('nama_warek_utpas');
        $nama_spmi = $request->input('nama_spmi');
        $auditee = $request->input('auditee');
        $ketua_auditor = $request->input('ketua_auditor');
        $anggota_auditor = $request->input('anggota_auditor');
        $link_file = $request->input('link_file');
        $standar = $request->input('standar');
        $rancangan_anggaran = $request->input('rancangan_anggaran');

        $ami_prodi_terakhir = Ami::where('prodi', $prodi)->orderByDesc('siklus')->first();
        if ($ami_prodi_terakhir == null) {
            $siklus = 1;
        } else {
            $siklus = $ami_prodi_terakhir->siklus + 1;
        }

        $updated_ami = Ami::where('id', $id_ami)->first;
        $updated_ami->id_user_auditor1 = $ketua_auditor;
        $updated_ami->id_user_auditor2 = $anggota_auditor;
        $updated_ami->id_user_auditee = $auditee;
        $updated_ami->tanggal_mulai = $tanggal_mulai;
        $updated_ami->tanggal_ami = $tanggal_ami;
        $updated_ami->tanggal_akhir = $tanggal_akhir;
        $updated_ami->nama_rektor_utpas = $nama_rektor_utpas;
        $updated_ami->nama_warek_utpas = $nama_warek_utpas;
        $updated_ami->nama_spmi = $nama_spmi;
        $updated_ami->link_file = $link_file;
        $updated_ami->prodi = $prodi;
        $updated_ami->id_user_lpm = auth()->user()->id;
        $updated_ami->siklus = $siklus;
        $updated_ami->standar()->attach($standar);
        $updated_ami->save();
        
        foreach ($rancangan_anggaran as $anggaran){
            $ami->rancangan_anggaran()->updateOrCreate(
                [
                    'id' => $anggaran['id']
                ],
                $anggaran
            );
        }
        return redirect()->route('lpm.prodi.page', $prodi);
    }

    public function store(Request $request, string $prodi){
        //input untuk penugasan ami
        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_ami = $request->input('tanggal_ami');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $nama_rektor_utpas = $request->input('nama_rektor_utpas');
        $nama_warek_utpas = $request->input('nama_warek_utpas');
        $nama_spmi = $request->input('nama_spmi');
        $auditee = $request->input('auditee');
        $ketua_auditor = $request->input('ketua_auditor');
        $anggota_auditor = $request->input('anggota_auditor');
        $link_file = $request->input('link_file');
        $standar = $request->input('standar');

        $rancangan_anggaran = $request->input('rancangan_anggaran');

        $ami_prodi_terakhir = Ami::where('prodi', $prodi)->orderByDesc('siklus')->first();

        if ($ami_prodi_terakhir == null) {
            $siklus = 1;
        } else {
            $siklus = $ami_prodi_terakhir->siklus + 1;
        }

        //insert data to ami
        $ami = Ami::create([
            'id_user_auditor1'=>$ketua_auditor,
            'id_user_auditor2'=>$anggota_auditor,
            'id_user_auditee'=>$auditee,
            'tanggal_mulai'=>$tanggal_mulai,
            'tanggal_ami'=>$tanggal_ami,
            'tanggal_akhir'=>$tanggal_akhir,
            'nama_rektor_utpas' => $nama_rektor_utpas,
            'nama_warek_utpas' => $nama_warek_utpas,
            'nama_spmi' => $nama_spmi,
            'link_file'=>$link_file,
            'prodi' => $prodi,
            'id_user_lpm' => auth()->user()->id,
            'siklus' => $siklus
        ]);

        $ami->standar()->attach($standar);
    
        //insert data to anggaran
        $ami->rancangan_anggaran()->createMany($rancangan_anggaran);
        return redirect()->route('lpm.prodi.page', $prodi);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(string $prodi)
    {
        $prodi = str_replace('-', ' ', $prodi); // desain komunikasi visual
        $prodi = ucwords($prodi); // Desain Komunikasi Visual
        $data_ami = Ami::where('prodi', $prodi)->get()->groupBy('siklus');
        $standar = Standar::get();
        $data_user = User::get();
        return view("user.lpm.lpm-assign-page", [
            'data_user' => $data_user,
            'standar' => $standar,
            'prodi' => $prodi,
        ]);
    }

    public function daftar_lpm_assign_edit(Ami $ami){
        $data_ami = $ami->where('id', $ami->id)->with(["rancangan_anggaran" => function ($query) use ($ami){
            $query->where('id_ami', $ami->id);
        }])->get();
        // dd($data_ami);
        $standar = Standar::get();
        $ami_standars = $ami->standar()->pluck('id_standar')->toArray();
        $user = User::get();
        return view("user.lpm.lpm-assign-edit-page", [
            'data_ami' => $data_ami,
            'ami' => $ami,
            'rancangan_anggaran' => $ami->rancangan_anggaran,
            'standar' => $standar, 
            'user' => $user,
            'prodi' => $ami->prodi,
            'ami_standars' => $ami_standars,
        ]);
    }

    // public function daftar_lpm_assign_edit(string $prodi, Ami $ami){
    //     $data_ami = $ami->where('id', $ami->id)->where('prodi', $prodi)->with(["rancangan_anggaran" => function ($query) use ($ami){
    //         $query->where('id_ami', $ami->id);
    //     }])->get();
    //     // dd($data_ami);
    //     $standar = Standar::get();
    //     $ami_standars = $ami->standar()->pluck('id_standar')->toArray();
    //     $user = User::get();
    //     return view("user.lpm.lpm-assign-edit-page", [
    //         'data_ami' => $data_ami,
    //         'ami' => $ami,
    //         'rancangan_anggaran' => $ami->rancangan_anggaran,
    //         'standar' => $standar,
    //         'prodi' => $prodi, 
    //         'user' => $user,
    //         'ami_standars' => $ami_standars,
    //     ]);
    // }

    public function show_pengesahan(Ami $ami){
        $alreadyApproved = Pengesahan::where('id_ami', $ami->id)
        ->where('id_user', auth()->user()->id)->exists();
        
        return view('user.laporan.pengesahan-laporan-page', [
            'ami' => $ami,
            'alreadyApproved' => $alreadyApproved,
        ]);
    }

    public function store_pengesahan(Request $request, Ami $ami){
        $id_ami = $request->input("id_ami");
        $id_user = $request->input("id_user");
        $nama = $request->input("nama_pengesah");
        $jabatan = $request->input('jabatan_pengesah');
        $tanggal = $request->input("tanggal_pengesahan");

        $pengesahan = Pengesahan::create([
            'id_ami' => $id_ami,
            'id_user' => $id_user,
            'nama' => $nama,
            'jabatan' => $jabatan,
            'tanggal' => $tanggal,
        ]);

        return redirect()->route('laporan.ami.sah', $ami)->with('success', 'AMI document approved!');
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
