<?php

use App\Http\Controllers\DokumenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\RtpController;
use App\Models\Ami;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/pengesahan-ami', function (Request $request) {
    dd($request->query());
})->name('laporan-ami-untuk-disahkan-publik')->middleware('signed');
    
Route::middleware('auth')->group(function(){

    // Laporan
    Route::get('/laporan/{ami}', [LaporanController::class,'show'])->name('laporan.ami.view');

    Route::get('/pengesahan-laporan-page/{ami}', [AmiController::class, 'show_pengesahan'])->name('laporan.pengesahan.view');


    Route::post('pengesahan-laporan-page/{ami}', [AmiController::class, 'store_pengesahan'])->name('laporan.ami.sah');
    
    // LPM
    Route::get('/lpm-main-page', [AmiController::class, 'index_prodi'])->name('lpm.dokumen.create');
    
    Route::get('/lpm-prodi-page/{prodi}',[AmiController::class, 'index_lpm'])->name('lpm.prodi.page');
    
    Route::get('/lpm-assign-page/{prodi}', [AmiController::class, 'create'])->name('lpm.ami.create');

    Route::get('/lpm-assign-edit-page/{ami}', [AmiController::class, 'daftar_lpm_assign_edit'])->name('lpm.edit.view');

    Route::post('/lpm-assign-page/{prodi}', [AmiController::class, 'store'])->name('lpm.ami.store');

    Route::post('lpm-assign-edit-page/{ami}', [AmiController::class, 'store_lpm_assign_edit'])->name('lpm.ami.edit');

    // Route::get('/lpm-assign-edit-page/{prodi}/{ami}', [AmiController::class, 'store_pengesahan'])->name('lpm.edit.store');
    // Route::get('/lpm-assign-page', [AmiController::class, 'daftar_lpm_standar'])->name('lpm.view.standar');
    // Route::get('/lpm-assign-page', [AmiController::class, 'store']);
    
    Route::get('/lpm-progress-page/{ami}', [AmiController::class, 'daftar_pertanyaan_lpm'])->name('lpm.ami.view');

    Route::get('/lpm-lampiran-page/{ami}', [AmiController::class, 'daftar_butir_rtp'])->name('lpm.ami.rtp');

    Route::post('lpm-lampiran-page/{ami}', [RtpController::class, 'store'])->name('rtp.ami.store');

    Route::get('/generate-link-pengesahan/{ami}/{jabatan}', function (Ami $ami, string $jabatan) {
        $url = URL::temporarySignedRoute(
            'laporan-ami-untuk-disahkan-publik',
            now()->addSeconds(15),
            [
                'ami' => $ami,
                'jabatan' => $jabatan
            ]
        );

        // return view('', ['url' => $url]);
        return $url;
    });

    Route::get('/dashboard-audit-page', [AmiController::class, 'index_ami_prodi'])->name('dashboard.view.ami');
    
    // Auditee    
    Route::post('/auditee-ami-page', [DokumenController::class, 'store'])->name('auditee.dokumen.store');
    
    Route::get('/auditee-ami-page/{ami}', [AmiController::class, 'daftar_pertanyaan_auditee'])->name('auditee.dokumen.create');

    // Route::get('/auditee-ami-page', function () {
    //     return view('user.auditee-auditor.auditee.auditee-ami-page');
    // });

    // Auditor
    Route::get('/auditor-verdok-page/{ami}', [AmiController::class, 'daftar_pertanyaan_verdok'])->name('auditor.verdok.view');

    Route::post('/auditor-verdok-page/{ami}', [DokumenController::class, 'store_statusverifikasi'])->name('auditor.status.create'); 

    Route::get('/auditor-temuan-page/{ami}', [AmiController::class,'daftar_butir_temuan'])->name('auditor.temuan.view');

    Route::post('/auditor-temuan-page', [PenilaianController::class, 'store_temuan'])->name('auditor.store.temuan');

    Route::get('/auditor-tilik-page/{ami}', [AmiController::class, 'daftar_pertanyaan_tilik'])->name('auditor.view.tilik');

    Route::post('/auditor-tilik-page/{ami}', [PenilaianController::class, 'store'])->name('auditor.store.penilaian');

    // Auditor
    
    Route::get('/ami', [AmiController::class, 'index']);

    //for logouts 
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
// Laporan
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
