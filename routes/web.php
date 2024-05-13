<?php

use App\Http\Middleware\CekLevel;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\admin\dokumen\DokumenadminController;
use App\Http\Controllers\superadmin\master_setup\BoxController;
use App\Http\Controllers\superadmin\master_setup\MapController;
use App\Http\Controllers\superadmin\master_setup\RakController;
use App\Http\Controllers\admin\riwayat\RiwayatretensiController;
use App\Http\Controllers\admin\dokumen\DokumenadminDuaController;
use App\Http\Controllers\superadmin\master_setup\RuangController;
use App\Http\Controllers\superadmin\approval\PeminjamanController;
use App\Http\Controllers\admin\riwayat\RiwayatpeminjamanController;
use App\Http\Controllers\superadmin\approval\PengarsipanController;
use App\Http\Controllers\superadmin\menu_dokumen\DokumenController;
use App\Http\Controllers\admin\riwayat\RiwayatpengarsipanController;
use App\Http\Controllers\superadmin\approval\PengembalianController;
use App\Http\Controllers\superadmin\master_setup\DatauserController;
use App\Http\Controllers\admin\riwayat\RiwayatpengembalianController;
use App\Http\Controllers\superadmin\approval\PeminjamanDuaController;
use App\Http\Controllers\admin\riwayat\RiwayatpeminjamanDuaController;
use App\Http\Controllers\superadmin\approval\PengarsipanDuaController;
use App\Http\Controllers\superadmin\master_setup\DepartemenController;
use App\Http\Controllers\superadmin\menu_dokumen\DokumenDuaController;
use App\Http\Controllers\superadmin\approval\PengembalianDuaController;
use App\Http\Controllers\superadmin\master_setup\KelengkapanController;
use App\Http\Controllers\admin\riwayat\RiwayatpengembalianDuaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'beforelogin'])->name('first');

Route::get('/login', [LoginController::class, 'view_login'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::post('/sesi/create', [LoginController::class, 'create']);
// Route::get('/refreshCapcha', [LoginController::class, 'refreshCapcha']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
Route::group(['middleware' => ['auth', 'cekaktif']], function () {
    Route::get('dashboard', [DashboardController::class, 'afterlogin'])->name('dashboard');
});

//// Untuk Admin ////
Route::group(['middleware' => ['auth', 'ceklevel:admin', 'cekaktif']], function () {
    //Menu Dokumen
    
    Route::get('/dokumen_terbuka_admin', [DokumenadminController::class, 'dokumen_terbuka_admin'])->name('dokumen');
    Route::get('/detail_dokumen_admin/{id}', [DokumenadminController::class, 'detail_data'])->name('dokumen');
    //Menu Riwayat
    // Route::get('/riwayat/riwayat_pengarsipan', [RiwayatpengarsipanController::class, 'index']);
    // Route::get('/riwayat/riwayat_retensi', [RiwayatretensiController::class, 'index']);
    Route::get('/riwayat/riwayat_peminjaman', [RiwayatpeminjamanController::class, 'index']);
    Route::get('/riwayat/riwayat_pengembalian', [RiwayatpengembalianController::class, 'index']);
    // Untuk CRUD Dokumen
    Route::resource('/input_retensi_admin', DokumenadminController::class);
    Route::resource('/input_pengarsipan_admin', DokumenadminController::class);
    Route::post('/input_cuti/{id}', [DokumenadminController::class, 'ajukan_cuti']);
    Route::post('/input_pengembalian_peralatan', [DokumenadminController::class, 'pengembalian_dokumenById']);
    // showpdf
    Route::get('/showPdfAdmin/{nomorDokumen}', [DokumenadminController::class, 'showPdfAdmin'])->name('dokumen');
    //detail riwayat
    Route::get('/d_riwayat_pengarsipan/{id}', [RiwayatpengarsipanController::class, 'show_detail']);
    Route::get('/d_riwayat_retensi/{id}', [RiwayatretensiController::class, 'show_detail']);
    Route::get('/d_riwayat_peminjaman/{id}', [RiwayatpeminjamanController::class, 'show_detail']);
    Route::get('/d_riwayat_pengembalian/{id}', [RiwayatpengembalianController::class, 'show']);
    // Route::resource('/d_riwayat_pengembalian/{id}', RiwayatpengembalianController::class);
});

//// Untuk User ////
Route::group(['middleware' => ['auth', 'ceklevel:user', 'cekaktif']], function () {
    Route::get('/dokumen_terbatas_user', [UserController::class, 'index'])->name('dokumen');
    Route::get('/dokumen_terbuka_user', [UserController::class, 'dokumen_terbuka'])->name('dokumen');
    Route::get('/detail_dokumen_user/{id}', [UserController::class, 'detail_data'])->name('dokumen');
    Route::get('/showPdfUser/{nomorDokumen}', [UserController::class, 'showPdfUser'])->name('dokumen');
});

//// Untuk Super Admin ////
Route::group(['middleware' => ['auth', 'ceklevel:superadmin', 'cekaktif']], function () {
    //Menu Dokumen
    // Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen');
    // Route::resource('/dokumen_terbatas', DokumenController::class);
    Route::resource('/dokumen_terbuka', DokumenController::class);
    
    //input cuti bersama
    // Route::get('/input_cuti_bersama', [DokumenController::class, 'cuti_bersama']);
    // Route::post('/input_cuti_bersama/{id}', [DokumenController::class, 'cuti_bersama']);
    Route::post('/input_cuti_bersama', [DokumenController::class, 'cuti_bersama'])->name('cuti_bersama');

    Route::get('/dokumen_terbuka', [DokumenController::class, 'dokumen_terbuka']);
    Route::put('/peralatan/edit/{id}', [DokumenController::class, 'edit_dokumen']);
    Route::get('/detail_dokumen/{id}', [DokumenController::class, 'detail_data'])->name('dokumen');
    Route::get('/tidak_ketemu', [PengembalianController::class, 'employee_not_found'])->name('employee_not_found');
    Route::get('/tidak_ketemu/hitung_cuti', [PengembalianController::class, 'employee_not_found'])->name('hitung_cuti_karyawan_hilang');
    
    //Menu Master Setup
    Route::get('/master_setup/ruang', [RuangController::class, 'index'])->name('ruang');
    Route::get('/master_setup/rak', [RakController::class, 'index'])->name('rak');
    Route::get('/master_setup/box', [BoxController::class, 'index'])->name('box');
    Route::get('/master_setup/map', [MapController::class, 'index'])->name('map');
    Route::get('/master_setup/data_departemen', [DepartemenController::class, 'index'])->name('data_departemen');
    Route::get('/master_setup/data_user', [DatauserController::class, 'index'])->name('data_user');
    Route::get('/master_setup/data_cuti', [PengarsipanController::class, 'index'])->name('data_cuti');
    Route::get('/master_setup/hitung_cuti', [PengembalianController::class, 'index'])->name('hitung_cuti');
    Route::get('/master_setup/data_cuti/{id}', [PengarsipanController::class, 'detail_cuti'])->name('detail_cuti');
    Route::post('/master_setup/data_user/{id}', [DatauserController::class, 'update_password'])->name('data_user');
    Route::get('/master_setup/kelengkapan_dokumen', [KelengkapanController::class, 'index'])->name('kelengkapan_dokumen');

    // Menu Approval
    Route::get('/approval/pengarsipan', [PengarsipanController::class, 'index'])->name('pengarsipan');
    Route::get('/approval/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman');
    Route::get('/approval/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian');
    // Route::get('/approval/pengembalian/{id}', [PengembalianController::class, 'detail_cuti_user'])->name('detail_cuti_user');
    Route::post('/approval/pengembalian/{id}', [PengembalianController::class, 'detail_cuti_user'])->name('detail_cuti_user');

    // Export excel
    Route::get('/approval/peminjaman/export',[PeminjamanController::class,'export'])->name('export');
    Route::get('/approval/peminjaman/exportUser',[PeminjamanController::class,'exportUser'])->name('exportUser');
    Route::get('/approval/peminjaman/exportPDF',[PeminjamanController::class,'createPDF'])->name('PDF');
    Route::get('/approval/peminjaman/exportCutiPDF',[PeminjamanController::class,'createCutiPDF'])->name('cutiPDF');
    Route::get('/exportUserNotFoundPDF',[PeminjamanController::class,'createNotFoundUserPDF'])->name('NotFoundUserPDF');

    //Untuk CRUD Master Setup
    Route::resource('/data_departemen', DepartemenController::class);
    Route::resource('/data_user', DatauserController::class);
    Route::resource('/data_cuti', PengarsipanController::class);
    Route::resource('/kelengkapan', KelengkapanController::class);

    //get rak berdasarkan id ruang
    Route::get('/getRak/{id_ruang}', [RakController::class, 'detail_rak'])->name('getRak');
    //get box berdasarkan id rak
    Route::get('/getBox/{id_rak}', [BoxController::class, 'detail_box'])->name('getBox');

    Route::get('/getMap/{id_box}', [MapController::class, 'detail_map'])->name('getMap');

    // Route::get('/get_rak_pengarsipan/{id_ruang}', [PengarsipanController::class, 'lokasi_dokumen'])->name('get_rak_pengarsipan');


    // Untuk CRUD Dokumen
    Route::resource('/input_pengarsipan', DokumenController::class);
    Route::resource('/softdelete', DokumenController::class);

    // Approval
    Route::resource('/pengarsipan', PengarsipanController::class);
    Route::resource('/peminjaman', PeminjamanController::class);
    Route::resource('/pengembalian', PengembalianController::class);

    // show pdf
    Route::get('/showPdf/{nomorDokumen}', [DokumenController::class, 'showPdf'])->name('dokumen');
});

use App\Mail\MailableName;
use Illuminate\Support\Facades\Mail;

    Route::get('/testroute', function() {
    $name = "Funny Coder";

    // The email sending is done using the to method on the Mail facade
    Mail::to('geraldy.yp@bcupt.id’')->send(new MailableName($name));
});

//Menu Profil
Route::get('/profil', [Controller::class, 'profil_pengguna'])->name('profil');
