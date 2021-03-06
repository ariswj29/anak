<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

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


// Route::group([ 'middleware' => 'auth' ], function () { 
//     // untuk yg harus login masukin disini
//     Route::get('/home', function () {
//         return view('home');
//     });
// });

Route::get('/', function() {
    return view('index');
});

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')
->middleware('auth','administrator');

Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profil'])->name('profile');
Route::post('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

// User
Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/admin/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin/user');
    Route::get('/admin/user/export_excel', [App\Http\Controllers\Admin\UserController::class, 'export_excel']);
    // Route::get('/admin/user/export', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin/user');
    // Route::post('sample/export', 'SampleController@index');
    Route::get('/admin/user/tambah', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin/tambah_user');
    Route::post('/admin/user/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin/tambah_user');
    Route::get('/admin/user/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin/edit_user');
    Route::post('/admin/user/{user}/update', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin/edit_user');
    Route::get('/admin/user/{user}/delete', [App\Http\Controllers\Admin\UserController::class, 'destroy']);
});

// PJUB
Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/admin/pjub', [App\Http\Controllers\Admin\PjubController::class, 'index'])->name('admin/pjub');
    Route::get('/admin/pjub/export_excel', [App\Http\Controllers\Admin\PjubController::class, 'export_excel']);
    Route::get('/admin/pjub/tambah', [App\Http\Controllers\Admin\PjubController::class, 'create'])->name('admin/tambah_pjub');
    Route::post('/admin/pjub/store', [App\Http\Controllers\Admin\PjubController::class, 'store'])->name('admin/tambah_pjub');
    Route::get('/admin/pjub/{pjub}/edit', [App\Http\Controllers\Admin\PjubController::class, 'edit'])->name('admin/edit_pjub');
    Route::post('/admin/pjub/{pjub}/update', [App\Http\Controllers\Admin\PjubController::class, 'update'])->name('admin/edit_pjub');
    Route::get('/admin/pjub/{pjub}/delete', [App\Http\Controllers\Admin\PjubController::class, 'destroy']);
});

// Mitra Admin
Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/admin/mitra', [App\Http\Controllers\Admin\MitraController::class, 'index'])->name('admin/mitra');
    Route::get('/admin/mitra/export_excel', [App\Http\Controllers\Admin\MitraController::class, 'export_excel']);
    Route::get('/admin/mitra/tambah', [App\Http\Controllers\Admin\MitraController::class, 'create'])->name('admin/tambah_mitra');
    Route::post('/admin/mitra/store', [App\Http\Controllers\Admin\MitraController::class, 'store'])->name('admin/tambah_mitra');
    Route::get('/admin/mitra/{mitra}/edit', [App\Http\Controllers\Admin\MitraController::class, 'edit'])->name('admin/edit_mitra');
    Route::post('/admin/mitra/{mitra}/update', [App\Http\Controllers\Admin\MitraController::class, 'update'])->name('admin/edit_mitra');
    Route::get('/admin/mitra/{mitra}/delete', [App\Http\Controllers\Admin\MitraController::class, 'destroy']);
});

// Farm Admin
Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/admin/farm', [App\Http\Controllers\Admin\FarmController::class, 'index'])->name('admin/farm');
    Route::get('/admin/farm/export_excel', [App\Http\Controllers\Admin\FarmController::class, 'export_excel']);
    // Route::get('/admin/farm/json', [App\Http\Controllers\Admin\FarmController::class, 'json']);
    Route::get('/admin/farm/tambah', [App\Http\Controllers\Admin\FarmController::class, 'create'])->name('admin/tambah_farm');
    Route::post('/admin/farm/store', [App\Http\Controllers\Admin\FarmController::class, 'store'])->name('admin/tambah_farm');
    Route::get('/admin/farm/{farm}/edit', [App\Http\Controllers\Admin\FarmController::class, 'edit'])->name('admin/edit_farm');
    Route::post('/admin/farm/{farm}/update', [App\Http\Controllers\Admin\FarmController::class, 'update'])->name('admin/edit_farm');
    Route::get('/admin/farm/{farm}/delete', [App\Http\Controllers\Admin\FarmController::class, 'destroy']);
});

// Capex Admin
// Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/capex', [App\Http\Controllers\Admin\CapexController::class, 'index'])->name('admin/capex');
    Route::get('/admin/capex/{farm}/detail', [App\Http\Controllers\Admin\CapexController::class, 'detail'])->name('admin/detail_capex');
    Route::get('/admin/capex/{farm}/detail/json', [App\Http\Controllers\Admin\CapexController::class, 'json']);
    Route::get('/admin/capex/{farm}/tambah', [App\Http\Controllers\Admin\CapexController::class, 'create'])->name('admin/tambah_capex');
    Route::post('/admin/capex/store', [App\Http\Controllers\Admin\CapexController::class, 'store'])->name('admin/tambah_capex');
    Route::get('/admin/capex/{capex}/edit', [App\Http\Controllers\Admin\CapexController::class, 'edit'])->name('admin/edit_capex');
    Route::post('/admin/capex/{capex}/update', [App\Http\Controllers\Admin\CapexController::class, 'update'])->name('admin/edit_capex');
    Route::get('/admin/capex/{capex}/{farm}/delete', [App\Http\Controllers\Admin\CapexController::class, 'destroy']);
// });

// Opex Admin
// Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/opex', [App\Http\Controllers\Admin\OpexController::class, 'index'])->name('admin/opex');
    Route::get('/admin/opex/{siklus_id}/detail', [App\Http\Controllers\Admin\OpexController::class, 'detail'])->name('admin/detail_opex');
    // Route::get('/admin/opex/{opex}/detail', [App\Http\Controllers\Admin\OpexController::class, 'json']);
    Route::get('/admin/opex/{siklus}/tambah', [App\Http\Controllers\Admin\OpexController::class, 'create'])->name('admin/tambah_opex');
    Route::post('/admin/opex/store', [App\Http\Controllers\Admin\OpexController::class, 'store'])->name('admin/tambah_opex');
    Route::get('/admin/opex/{opex}/edit', [App\Http\Controllers\Admin\OpexController::class, 'edit'])->name('admin/edit_opex');
    Route::post('/admin/opex/{opex}/update', [App\Http\Controllers\Admin\OpexController::class, 'update'])->name('admin/edit_opex');
    Route::get('/admin/opex/{opex}/{siklus}/delete', [App\Http\Controllers\Admin\OpexController::class, 'destroy']);
// });

// Siklus Admin
Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/admin/siklus', [App\Http\Controllers\Admin\SiklusController::class, 'index'])->name('admin/siklus');
    Route::get('/admin/siklus/export_excel', [App\Http\Controllers\Admin\SiklusController::class, 'export_excel']);
    Route::get('/admin/siklus/tambah', [App\Http\Controllers\Admin\SiklusController::class, 'create'])->name('admin/tambah_siklus');
    Route::post('/admin/siklus/store', [App\Http\Controllers\Admin\SiklusController::class, 'store'])->name('admin/tambah_siklus');
    // Route::get('/admin/siklus/{siklus}', [App\Http\Controllers\Admin\SiklusController::class, 'show']);
    Route::get('/admin/siklus/{siklus}', [App\Http\Controllers\Admin\SiklusController::class, 'show'])->name('siklus.show');;
    Route::get('/admin/siklus/{siklus}/edit', [App\Http\Controllers\Admin\SiklusController::class, 'edit'])->name('admin/edit_siklus');
    Route::post('/admin/siklus/{siklus}/update', [App\Http\Controllers\Admin\SiklusController::class, 'update'])->name('admin/edit_siklus');
    Route::get('/admin/siklus/{siklus}/delete', [App\Http\Controllers\Admin\SiklusController::class, 'destroy']);
    // Route::resource('siklus', 'SiklusController');
});

// Pakan Admin
Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/admin/pakan', [App\Http\Controllers\Admin\PakanController::class, 'index'])->name('admin/pakan');
    Route::get('/admin/pakan/export_excel', [App\Http\Controllers\Admin\PakanController::class, 'export_excel']);
    Route::get('/admin/pakan/tambah', [App\Http\Controllers\Admin\PakanController::class, 'create'])->name('admin/tambah_pakan');
    Route::post('/admin/pakan/store', [App\Http\Controllers\Admin\PakanController::class, 'store'])->name('admin/tambah_pakan');
    Route::get('/admin/pakan/{pakan}/edit', [App\Http\Controllers\Admin\PakanController::class, 'edit'])->name('admin/edit_pakan');
    Route::post('/admin/pakan/{pakan}/update', [App\Http\Controllers\Admin\PakanController::class, 'update'])->name('admin/edit_pakan');
    Route::get('/admin/pakan/{pakan}/delete', [App\Http\Controllers\Admin\PakanController::class, 'destroy']);
});

// Minum Admin
Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/admin/minum', [App\Http\Controllers\Admin\MinumController::class, 'index'])->name('admin/minum');
    Route::get('/admin/minum/export_excel', [App\Http\Controllers\Admin\MinumController::class, 'export_excel']);
    Route::get('/admin/minum/tambah', [App\Http\Controllers\Admin\MinumController::class, 'create'])->name('admin/tambah_minum');
    Route::post('/admin/minum/store', [App\Http\Controllers\Admin\MinumController::class, 'store'])->name('admin/tambah_minum');
    Route::get('/admin/minum/{minum}/edit', [App\Http\Controllers\Admin\MinumController::class, 'edit'])->name('admin/edit_minum');
    Route::post('/admin/minum/{minum}/update', [App\Http\Controllers\Admin\MinumController::class, 'update'])->name('admin/edit_minum');
    Route::get('/admin/minum/{minum}/delete', [App\Http\Controllers\Admin\MinumController::class, 'destroy']);
});

// Berat Ayam Admin
Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/admin/berat', [App\Http\Controllers\Admin\BeratController::class, 'index'])->name('admin/berat');
    Route::get('/admin/berat/export_excel', [App\Http\Controllers\Admin\BeratController::class, 'export_excel']);
    Route::get('/admin/berat/tambah', [App\Http\Controllers\Admin\BeratController::class, 'create'])->name('admin/tambah_berat');
    Route::post('/admin/berat/store', [App\Http\Controllers\Admin\BeratController::class, 'store'])->name('admin/tambah_berat');
    Route::get('/admin/berat/{berat}/edit', [App\Http\Controllers\Admin\BeratController::class, 'edit'])->name('admin/edit_berat');
    Route::post('/admin/berat/{berat}/update', [App\Http\Controllers\Admin\BeratController::class, 'update'])->name('admin/edit_berat');
    Route::get('/admin/berat/{berat}/delete', [App\Http\Controllers\Admin\BeratController::class, 'destroy']);
});

// Vitamin Admin
Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/admin/vitamin', [App\Http\Controllers\Admin\VitaminController::class, 'index'])->name('admin/vitamin');
    Route::get('/admin/vitamin/export_excel', [App\Http\Controllers\Admin\VitaminController::class, 'export_excel']);
    Route::get('/admin/vitamin/tambah', [App\Http\Controllers\Admin\VitaminController::class, 'create'])->name('admin/tambah_vitamin');
    Route::post('/admin/vitamin/store', [App\Http\Controllers\Admin\VitaminController::class, 'store'])->name('admin/tambah_vitamin');
    Route::get('/admin/vitamin/{vitamin}/edit', [App\Http\Controllers\Admin\VitaminController::class, 'edit'])->name('admin/edit_vitamin');
    Route::post('/admin/vitamin/{vitamin}/update', [App\Http\Controllers\Admin\VitaminController::class, 'update'])->name('admin/edit_vitamin');
    Route::get('/admin/vitamin/{vitamin}/delete', [App\Http\Controllers\Admin\VitaminController::class, 'destroy']);
});

// Kematian Admin
Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/admin/kematian', [App\Http\Controllers\Admin\KematianController::class, 'index'])->name('admin/kematian');
    Route::get('/admin/kematian/export_excel', [App\Http\Controllers\Admin\KematianController::class, 'export_excel']);
    Route::get('/admin/kematian/tambah', [App\Http\Controllers\Admin\KematianController::class, 'create'])->name('admin/tambah_kematian');
    Route::post('/admin/kematian/store', [App\Http\Controllers\Admin\KematianController::class, 'store'])->name('admin/tambah_kematian');
    Route::get('/admin/kematian/{kematian}/edit', [App\Http\Controllers\Admin\KematianController::class, 'edit'])->name('admin/edit_kematian');
    Route::post('/admin/kematian/{kematian}/update', [App\Http\Controllers\Admin\KematianController::class, 'update'])->name('admin/edit_kematian');
    Route::get('/admin/kematian/{kematian}/delete', [App\Http\Controllers\Admin\KematianController::class, 'destroy']);
});

// Kas Admin
Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/admin/kas', [App\Http\Controllers\Admin\KasController::class, 'index'])->name('admin/kas');
    Route::get('/admin/kas/{siklus}/detail', [App\Http\Controllers\Admin\KasController::class, 'detail'])->name('admin/detail_kas');
    Route::get('/admin/kas/{siklus_id}/detail/export_excel', [App\Http\Controllers\Admin\KasController::class, 'export_excel']);
    Route::get('/admin/kas/{siklus}/lpj', [App\Http\Controllers\Admin\KasController::class, 'lpj'])->name('admin/lpj_kas');
    Route::get('/admin/kas/{siklus}/tambah', [App\Http\Controllers\Admin\KasController::class, 'create'])->name('admin/tambah_kas');
    Route::post('/admin/kas/store', [App\Http\Controllers\Admin\KasController::class, 'store'])->name('admin/tambah_kas');
    Route::get('/admin/kas/{kas}/edit', [App\Http\Controllers\Admin\KasController::class, 'edit'])->name('admin/edit_kas');
    Route::post('/admin/kas/{kas}/update', [App\Http\Controllers\Admin\KasController::class, 'update'])->name('admin/edit_kas');
    Route::get('/admin/kas/{kas}/{siklus_id}/delete', [App\Http\Controllers\Admin\KasController::class, 'destroy']);
    Route::get('/admin/kas/{siklus}/get_data_kas', [App\Http\Controllers\Admin\KasController::class, 'get_data_kas']);
});

// Penjualan Admin
Route::middleware(['auth','administrator'])->group(function () {
    Route::get('/admin/penjualan', [App\Http\Controllers\Admin\PenjualanController::class, 'index'])->name('admin/penjualan');
    Route::get('/admin/penjualan/export_excel', [App\Http\Controllers\Admin\PenjualanController::class, 'export_excel']);
    Route::get('/admin/penjualan/tambah', [App\Http\Controllers\Admin\PenjualanController::class, 'create'])->name('admin/tambah_penjualan');
    Route::post('/admin/penjualan/store', [App\Http\Controllers\Admin\PenjualanController::class, 'store'])->name('admin/tambah_penjualan');
    Route::get('/admin/penjualan/{penjualan}/edit', [App\Http\Controllers\Admin\PenjualanController::class, 'edit'])->name('admin/edit_penjualan');
    Route::post('/admin/penjualan/{penjualan}/update', [App\Http\Controllers\Admin\PenjualanController::class, 'update'])->name('admin/edit_penjualan');
    Route::get('/admin/penjualan/{penjualan}/delete', [App\Http\Controllers\Admin\PenjualanController::class, 'destroy']);
});

Route::get('/admin/dokumen', [App\Http\Controllers\Admin\DokumenController::class, 'index'])->name('admin/dokumen');

Route::get('/mitra/index', function() {
    return view('mitra/index');
})->name('mitra/index')->middleware('auth');

// Route::middleware(['auth','mitra'])->group(function () {
    Route::get('/mitra/index', [App\Http\Controllers\Mitra\IndexController::class, 'index'])->name('mitra/index');
    Route::get('/mitra/{siklus}/detail', [App\Http\Controllers\Mitra\IndexController::class, 'detail'])->name('mitra/detail');
    Route::get('/mitra/perbarui', [App\Http\Controllers\Mitra\IndexController::class, 'create'])->name('mitra/perbarui');
    Route::post('/mitra/perbarui', [App\Http\Controllers\Mitra\IndexController::class, 'store'])->name('mitra/perbarui');
// });

// Farm Mitra
// Route::middleware(['auth','mitra'])->group(function () {
    Route::get('/mitra/farm', [App\Http\Controllers\Mitra\FarmController::class, 'index'])->name('mitra/farm');
    Route::get('/mitra/farm/export_excel', [App\Http\Controllers\Mitra\FarmController::class, 'export_excel']);
    Route::get('/mitra/farm/tambah', [App\Http\Controllers\Mitra\FarmController::class, 'create'])->name('mitra/tambah_farm');
    Route::post('/mitra/farm/store', [App\Http\Controllers\Mitra\FarmController::class, 'store'])->name('mitra/tambah_farm');
    Route::get('/mitra/farm/{farm}/edit', [App\Http\Controllers\Mitra\FarmController::class, 'edit'])->name('mitra/edit_farm');
    Route::post('/mitra/farm/{farm}/update', [App\Http\Controllers\Mitra\FarmController::class, 'update'])->name('mitra/edit_farm');
    Route::get('/mitra/farm/{farm}/delete', [App\Http\Controllers\Mitra\FarmController::class, 'destroy']);
// });

// Siklus Mitra
// Route::middleware(['auth','mitra'])->group(function () {
    Route::get('/mitra/siklus', [App\Http\Controllers\Mitra\SiklusController::class, 'index'])->name('mitra/siklus');
    Route::get('/mitra/siklus/export_excel', [App\Http\Controllers\Mitra\SiklusController::class, 'export_excel']);
    Route::get('/mitra/siklus/tambah', [App\Http\Controllers\Mitra\SiklusController::class, 'create'])->name('mitra/tambah_siklus');
    Route::post('/mitra/siklus/store', [App\Http\Controllers\Mitra\SiklusController::class, 'store'])->name('mitra/tambah_siklus');
    // Route::get('/mitra/siklus/{siklus}', [App\Http\Controllers\Mitra\SiklusController::class, 'show']);
    Route::get('/mitra/siklus/{siklus}', [App\Http\Controllers\Mitra\SiklusController::class, 'show'])->name('siklus.show');;
    Route::get('/mitra/siklus/{siklus}/edit', [App\Http\Controllers\Mitra\SiklusController::class, 'edit'])->name('mitra/edit_siklus');
    Route::post('/mitra/siklus/{siklus}/update', [App\Http\Controllers\Mitra\SiklusController::class, 'update'])->name('mitra/edit_siklus');
    Route::get('/mitra/siklus/{siklus}/delete', [App\Http\Controllers\Mitra\SiklusController::class, 'destroy']);
    // Route::resource('siklus', 'SiklusController');
// });

// Capex Mitra
// Route::middleware(['auth','mitra'])->group(function () {
    Route::get('/mitra/capex', [App\Http\Controllers\Mitra\CapexController::class, 'index'])->name('mitra/capex');
    Route::get('/mitra/capex/{capex}/detail', [App\Http\Controllers\Mitra\CapexController::class, 'detail'])->name('mitra/detail_capex');
    Route::get('/mitra/capex/{farm}/tambah', [App\Http\Controllers\Mitra\CapexController::class, 'create'])->name('mitra/tambah_capex');
    Route::post('/mitra/capex/store', [App\Http\Controllers\Mitra\CapexController::class, 'store'])->name('mitra/tambah_capex');
    Route::get('/mitra/capex/{capex}/edit', [App\Http\Controllers\Mitra\CapexController::class, 'edit'])->name('mitra/edit_capex');
    Route::post('/mitra/capex/{capex}/update', [App\Http\Controllers\Mitra\CapexController::class, 'update'])->name('mitra/edit_capex');
    Route::get('/mitra/capex/{capex}/{farm}/delete', [App\Http\Controllers\Mitra\CapexController::class, 'destroy']);
// });

// Opex Mitra
// Route::middleware(['auth','mitra'])->group(function () {
    Route::get('/mitra/opex', [App\Http\Controllers\Mitra\OpexController::class, 'index'])->name('mitra/opex');
    Route::get('/mitra/opex/{opex}/detail', [App\Http\Controllers\Mitra\OpexController::class, 'detail'])->name('mitra/detail_opex');
    Route::get('/mitra/opex/{siklus}/tambah', [App\Http\Controllers\Mitra\OpexController::class, 'create'])->name('mitra/tambah_opex');
    Route::post('/mitra/opex/store', [App\Http\Controllers\Mitra\OpexController::class, 'store'])->name('mitra/tambah_opex');
    Route::get('/mitra/opex/{opex}/edit', [App\Http\Controllers\Mitra\OpexController::class, 'edit'])->name('mitra/edit_opex');
    Route::post('/mitra/opex/{opex}/update', [App\Http\Controllers\Mitra\OpexController::class, 'update'])->name('mitra/edit_opex');
    Route::get('/mitra/opex/{opex}/{siklus}/delete', [App\Http\Controllers\Mitra\OpexController::class, 'destroy']);
// });

// Penjualan Mitra
// Route::middleware(['auth','mitra'])->group(function () {
    Route::get('/mitra/penjualan', [App\Http\Controllers\Mitra\PenjualanController::class, 'index'])->name('mitra/penjualan');
    Route::get('/mitra/penjualan/export_excel', [App\Http\Controllers\Mitra\PenjualanController::class, 'export_excel']);
    Route::get('/mitra/penjualan/tambah', [App\Http\Controllers\Mitra\PenjualanController::class, 'create'])->name('mitra/tambah_penjualan');
    Route::post('/mitra/penjualan/store', [App\Http\Controllers\Mitra\PenjualanController::class, 'store'])->name('mitra/tambah_penjualan');
    Route::get('/mitra/penjualan/{penjualan}/edit', [App\Http\Controllers\Mitra\PenjualanController::class, 'edit'])->name('mitra/edit_penjualan');
    Route::post('/mitra/penjualan/{penjualan}/update', [App\Http\Controllers\Mitra\PenjualanController::class, 'update'])->name('mitra/edit_penjualan');
    Route::get('/mitra/penjualan/{penjualan}/delete', [App\Http\Controllers\Mitra\PenjualanController::class, 'destroy']);
// });

// Kas Mitra
// Route::middleware(['auth','mitra'])->group(function () {
    Route::get('/mitra/kas', [App\Http\Controllers\Mitra\KasController::class, 'index'])->name('mitra/kas');
    Route::get('/mitra/kas/{siklus}/detail', [App\Http\Controllers\Mitra\KasController::class, 'detail'])->name('mitra/detail_kas');
    Route::get('/mitra/kas/{siklus_id}/detail/export_excel', [App\Http\Controllers\Mitra\KasController::class, 'export_excel']);
    Route::get('/mitra/kas/{siklus}/lpj', [App\Http\Controllers\Mitra\KasController::class, 'lpj'])->name('mitra/lpj_kas');
    Route::get('/mitra/kas/{siklus}/tambah', [App\Http\Controllers\Mitra\KasController::class, 'create'])->name('mitra/tambah_kas');
    Route::post('/mitra/kas/store', [App\Http\Controllers\Mitra\KasController::class, 'store'])->name('mitra/tambah_kas');
    Route::get('/mitra/kas/{kas}/edit', [App\Http\Controllers\Mitra\KasController::class, 'edit'])->name('mitra/edit_kas');
    Route::post('/mitra/kas/{kas}/update', [App\Http\Controllers\Mitra\KasController::class, 'update'])->name('mitra/edit_kas');
    Route::get('/mitra/kas/{kas}/{siklus}/delete', [App\Http\Controllers\Mitra\KasController::class, 'destroy']);
    Route::get('/mitra/kas/{siklus}/get_data_kas', [App\Http\Controllers\Mitra\KasController::class, 'get_data_kas']);
// });

// Pakan Mitra
// Route::middleware(['auth','mitra'])->group(function () {
    Route::get('/mitra/pakan', [App\Http\Controllers\Mitra\PakanController::class, 'index'])->name('mitra/pakan');
    Route::get('/mitra/pakan/export_excel', [App\Http\Controllers\Mitra\PakanController::class, 'export_excel']);
    Route::get('/mitra/pakan/tambah', [App\Http\Controllers\Mitra\PakanController::class, 'create'])->name('mitra/tambah_pakan');
    Route::post('/mitra/pakan/store', [App\Http\Controllers\Mitra\PakanController::class, 'store'])->name('mitra/tambah_pakan');
    Route::get('/mitra/pakan/{pakan}/edit', [App\Http\Controllers\Mitra\PakanController::class, 'edit'])->name('mitra/edit_pakan');
    Route::post('/mitra/pakan/{pakan}/update', [App\Http\Controllers\Mitra\PakanController::class, 'update'])->name('mitra/edit_pakan');
    Route::get('/mitra/pakan/{pakan}/delete', [App\Http\Controllers\Mitra\PakanController::class, 'destroy']);
// });

// Minum Mitra
// Route::middleware(['auth','mitra'])->group(function () {
    Route::get('/mitra/minum', [App\Http\Controllers\Mitra\MinumController::class, 'index'])->name('mitra/minum');
    Route::get('/mitra/minum/export_excel', [App\Http\Controllers\Mitra\MinumController::class, 'export_excel']);
    Route::get('/mitra/minum/tambah', [App\Http\Controllers\Mitra\MinumController::class, 'create'])->name('mitra/tambah_minum');
    Route::post('/mitra/minum/store', [App\Http\Controllers\Mitra\MinumController::class, 'store'])->name('mitra/tambah_minum');
    Route::get('/mitra/minum/{minum}/edit', [App\Http\Controllers\Mitra\MinumController::class, 'edit'])->name('mitra/edit_minum');
    Route::post('/mitra/minum/{minum}/update', [App\Http\Controllers\Mitra\MinumController::class, 'update'])->name('mitra/edit_minum');
    Route::get('/mitra/minum/{minum}/delete', [App\Http\Controllers\Mitra\MinumController::class, 'destroy']);
// });

// Berat Ayam Mitra
// Route::middleware(['auth','mitra'])->group(function () {
    Route::get('/mitra/berat', [App\Http\Controllers\Mitra\BeratController::class, 'index'])->name('mitra/berat');
    Route::get('/mitra/berat/export_excel', [App\Http\Controllers\Mitra\BeratController::class, 'export_excel']);
    Route::get('/mitra/berat/tambah', [App\Http\Controllers\Mitra\BeratController::class, 'create'])->name('mitra/tambah_berat');
    Route::post('/mitra/berat/store', [App\Http\Controllers\Mitra\BeratController::class, 'store'])->name('mitra/tambah_berat');
    Route::get('/mitra/berat/{berat}/edit', [App\Http\Controllers\Mitra\BeratController::class, 'edit'])->name('mitra/edit_berat');
    Route::post('/mitra/berat/{berat}/update', [App\Http\Controllers\Mitra\BeratController::class, 'update'])->name('mitra/edit_berat');
    Route::get('/mitra/berat/{berat}/delete', [App\Http\Controllers\Mitra\BeratController::class, 'destroy']);
// });

// Kematian Mitra
// Route::middleware(['auth','mitra'])->group(function () {
    Route::get('/mitra/kematian', [App\Http\Controllers\Mitra\KematianController::class, 'index'])->name('mitra/kematian');
    Route::get('/mitra/kematian/export_excel', [App\Http\Controllers\Mitra\KematianController::class, 'export_excel']);
    Route::get('/mitra/kematian/tambah', [App\Http\Controllers\Mitra\KematianController::class, 'create'])->name('mitra/tambah_kematian');
    Route::post('/mitra/kematian/store', [App\Http\Controllers\Mitra\KematianController::class, 'store'])->name('mitra/tambah_kematian');
    Route::get('/mitra/kematian/{kematian}/edit', [App\Http\Controllers\Mitra\KematianController::class, 'edit'])->name('mitra/edit_kematian');
    Route::post('/mitra/kematian/{kematian}/update', [App\Http\Controllers\Mitra\KematianController::class, 'update'])->name('mitra/edit_kematian');
    Route::get('/mitra/kematian/{kematian}/delete', [App\Http\Controllers\Mitra\KematianController::class, 'destroy']);
// });

// Vitamin Mitra
// Route::middleware(['auth','mitra'])->group(function () {
    Route::get('/mitra/vitamin', [App\Http\Controllers\Mitra\VitaminController::class, 'index'])->name('mitra/vitamin');
    Route::get('/mitra/vitamin/export_excel', [App\Http\Controllers\Mitra\VitaminController::class, 'export_excel']);
    Route::get('/mitra/vitamin/tambah', [App\Http\Controllers\Mitra\VitaminController::class, 'create'])->name('mitra/tambah_vitamin');
    Route::post('/mitra/vitamin/store', [App\Http\Controllers\Mitra\VitaminController::class, 'store'])->name('mitra/tambah_vitamin');
    Route::get('/mitra/vitamin/{vitamin}/edit', [App\Http\Controllers\Mitra\VitaminController::class, 'edit'])->name('mitra/edit_vitamin');
    Route::post('/mitra/vitamin/{vitamin}/update', [App\Http\Controllers\Mitra\VitaminController::class, 'update'])->name('mitra/edit_vitamin');
    Route::get('/mitra/vitamin/{vitamin}/delete', [App\Http\Controllers\Mitra\VitaminController::class, 'destroy']);
// });


// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/index', [App\Http\Controllers\Pjub\IndexController::class, 'index'])->name('pjub/index');
    Route::get('/pjub/{pjub}/detail', [App\Http\Controllers\Pjub\IndexController::class, 'detail'])->name('pjub/detail');
    Route::get('/pjub/perbarui', [App\Http\Controllers\Pjub\IndexController::class, 'create'])->name('pjub/perbarui');
    Route::post('/pjub/perbarui', [App\Http\Controllers\Pjub\IndexController::class, 'store'])->name('pjub/perbarui');
// });

// PJUB
// Route::middleware(['auth','mitra'])->group(function () {
//     Route::get('/mitra/index', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profil'])->name('profile');
// });

// Mitra PJUB
// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/mitra', [App\Http\Controllers\Pjub\MitraController::class, 'index'])->name('pjub/mitra');
    Route::get('/pjub/mitra/export_excel', [App\Http\Controllers\Pjub\MitraController::class, 'export_excel']);
    Route::get('/pjub/mitra/tambah', [App\Http\Controllers\Pjub\MitraController::class, 'create'])->name('pjub/tambah_mitra');
    Route::post('/pjub/mitra/store', [App\Http\Controllers\Pjub\MitraController::class, 'store'])->name('pjub/tambah_mitra');
    Route::get('/pjub/mitra/{mitra}/edit', [App\Http\Controllers\Pjub\MitraController::class, 'edit'])->name('pjub/edit_mitra');
    Route::post('/pjub/mitra/{mitra}/update', [App\Http\Controllers\Pjub\MitraController::class, 'update'])->name('pjub/edit_mitra');
    Route::get('/pjub/mitra/{mitra}/delete', [App\Http\Controllers\Pjub\MitraController::class, 'destroy']);
// });

// Farm PJUB
// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/farm', [App\Http\Controllers\Pjub\FarmController::class, 'index'])->name('pjub/farm');
    Route::get('/pjub/farm/export_excel', [App\Http\Controllers\Pjub\FarmController::class, 'export_excel']);
    Route::get('/pjub/farm/tambah', [App\Http\Controllers\Pjub\FarmController::class, 'create'])->name('pjub/tambah_farm');
    Route::post('/pjub/farm/store', [App\Http\Controllers\Pjub\FarmController::class, 'store'])->name('pjub/tambah_farm');
    Route::get('/pjub/farm/{farm}/edit', [App\Http\Controllers\Pjub\FarmController::class, 'edit'])->name('pjub/edit_farm');
    Route::post('/pjub/farm/{farm}/update', [App\Http\Controllers\Pjub\FarmController::class, 'update'])->name('pjub/edit_farm');
    Route::get('/pjub/farm/{farm}/delete', [App\Http\Controllers\Pjub\FarmController::class, 'destroy']);
// });

// Capex PJUB
// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/capex', [App\Http\Controllers\Pjub\CapexController::class, 'index'])->name('pjub/capex');
    Route::get('/pjub/capex/{capex}/detail', [App\Http\Controllers\Pjub\CapexController::class, 'detail'])->name('pjub/detail_capex');
    Route::get('/pjub/capex/{farm}/tambah', [App\Http\Controllers\Pjub\CapexController::class, 'create'])->name('pjub/tambah_capex');
    Route::post('/pjub/capex/store', [App\Http\Controllers\Pjub\CapexController::class, 'store'])->name('pjub/tambah_capex');
    Route::get('/pjub/capex/{capex}/edit', [App\Http\Controllers\Pjub\CapexController::class, 'edit'])->name('pjub/edit_capex');
    Route::post('/pjub/capex/{capex}/update', [App\Http\Controllers\Pjub\CapexController::class, 'update'])->name('pjub/edit_capex');
    Route::get('/pjub/capex/{capex}/{farm}/delete', [App\Http\Controllers\Pjub\CapexController::class, 'destroy']);
// });

// Opex PJUB
// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/opex', [App\Http\Controllers\Pjub\OpexController::class, 'index'])->name('pjub/opex');
    Route::get('/pjub/opex/{opex}/detail', [App\Http\Controllers\Pjub\OpexController::class, 'detail'])->name('pjub/detail_opex');
    Route::get('/pjub/opex/{siklus}/tambah', [App\Http\Controllers\Pjub\OpexController::class, 'create'])->name('pjub/tambah_opex');
    Route::post('/pjub/opex/store', [App\Http\Controllers\Pjub\OpexController::class, 'store'])->name('pjub/tambah_opex');
    Route::get('/pjub/opex/{opex}/edit', [App\Http\Controllers\Pjub\OpexController::class, 'edit'])->name('pjub/edit_opex');
    Route::post('/pjub/opex/{opex}/update', [App\Http\Controllers\Pjub\OpexController::class, 'update'])->name('pjub/edit_opex');
    Route::get('/pjub/opex/{opex}/{siklus}/delete', [App\Http\Controllers\Pjub\OpexController::class, 'destroy']);
// });

// Kas PJUB
// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/kas', [App\Http\Controllers\Pjub\KasController::class, 'index'])->name('pjub/kas');
    Route::get('/pjub/kas/{siklus}/detail', [App\Http\Controllers\Pjub\KasController::class, 'detail'])->name('pjub/detail_kas');
    Route::get('/pjub/kas/{siklus_id}/detail/export_excel', [App\Http\Controllers\Pjub\KasController::class, 'export_excel']);
    Route::get('/pjub/kas/{siklus}/lpj', [App\Http\Controllers\Pjub\KasController::class, 'lpj'])->name('pjub/lpj_kas');
    Route::get('/pjub/kas/{siklus}/tambah', [App\Http\Controllers\Pjub\KasController::class, 'create'])->name('pjub/tambah_kas');
    Route::post('/pjub/kas/store', [App\Http\Controllers\Pjub\KasController::class, 'store'])->name('pjub/tambah_kas');
    Route::get('/pjub/kas/{kas}/edit', [App\Http\Controllers\Pjub\KasController::class, 'edit'])->name('pjub/edit_kas');
    Route::post('/pjub/kas/{kas}/update', [App\Http\Controllers\Pjub\KasController::class, 'update'])->name('pjub/edit_kas');
    Route::get('/pjub/kas/{kas}/{siklus}/delete', [App\Http\Controllers\Pjub\KasController::class, 'destroy']);
    Route::get('/pjub/kas/{siklus}/get_data_kas', [App\Http\Controllers\Pjub\KasController::class, 'get_data_kas']);
// });

// Penjualan PJUB
// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/penjualan', [App\Http\Controllers\Pjub\PenjualanController::class, 'index'])->name('pjub/penjualan');
    Route::get('/pjub/penjualan/export_excel', [App\Http\Controllers\Pjub\PenjualanController::class, 'export_excel']);
    Route::get('/pjub/penjualan/tambah', [App\Http\Controllers\Pjub\PenjualanController::class, 'create'])->name('pjub/tambah_penjualan');
    Route::post('/pjub/penjualan/store', [App\Http\Controllers\Pjub\PenjualanController::class, 'store'])->name('pjub/tambah_penjualan');
    Route::get('/pjub/penjualan/{penjualan}/edit', [App\Http\Controllers\Pjub\PenjualanController::class, 'edit'])->name('pjub/edit_penjualan');
    Route::post('/pjub/penjualan/{penjualan}/update', [App\Http\Controllers\Pjub\PenjualanController::class, 'update'])->name('pjub/edit_penjualan');
    Route::get('/pjub/penjualan/{penjualan}/delete', [App\Http\Controllers\Pjub\PenjualanController::class, 'destroy']);
// });

// Siklus PJUB
// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/siklus', [App\Http\Controllers\Pjub\SiklusController::class, 'index'])->name('pjub/siklus');
    Route::get('/pjub/siklus/export_excel', [App\Http\Controllers\Pjub\SiklusController::class, 'export_excel']);
    Route::get('/pjub/siklus/tambah', [App\Http\Controllers\Pjub\SiklusController::class, 'create'])->name('pjub/tambah_siklus');
    Route::post('/pjub/siklus/store', [App\Http\Controllers\Pjub\SiklusController::class, 'store'])->name('pjub/tambah_siklus');
    // Route::get('/pjub/siklus/{siklus}', [App\Http\Controllers\pjub\SiklusController::class, 'show']);
    Route::get('/pjub/siklus/{siklus}', [App\Http\Controllers\Pjub\SiklusController::class, 'show'])->name('siklus.show');;
    Route::get('/pjub/siklus/{siklus}/edit', [App\Http\Controllers\Pjub\SiklusController::class, 'edit'])->name('pjub/edit_siklus');
    Route::post('/pjub/siklus/{siklus}/update', [App\Http\Controllers\Pjub\SiklusController::class, 'update'])->name('pjub/edit_siklus');
    Route::get('/pjub/siklus/{siklus}/delete', [App\Http\Controllers\Pjub\SiklusController::class, 'destroy']);
    // Route::resource('siklus', 'SiklusController');
// });

// Pakan PJUB
// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/pakan', [App\Http\Controllers\Pjub\PakanController::class, 'index'])->name('pjub/pakan');
    Route::get('/pjub/pakan/export_excel', [App\Http\Controllers\Pjub\PakanController::class, 'export_excel']);
    Route::get('/pjub/pakan/tambah', [App\Http\Controllers\Pjub\PakanController::class, 'create'])->name('pjub/tambah_pakan');
    Route::post('/pjub/pakan/store', [App\Http\Controllers\Pjub\PakanController::class, 'store'])->name('pjub/tambah_pakan');
    Route::get('/pjub/pakan/{pakan}/edit', [App\Http\Controllers\Pjub\PakanController::class, 'edit'])->name('pjub/edit_pakan');
    Route::post('/pjub/pakan/{pakan}/update', [App\Http\Controllers\Pjub\PakanController::class, 'update'])->name('pjub/edit_pakan');
    Route::get('/pjub/pakan/{pakan}/delete', [App\Http\Controllers\Pjub\PakanController::class, 'destroy']);
// });

// Minum PJUB
// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/minum', [App\Http\Controllers\Pjub\MinumController::class, 'index'])->name('pjub/minum');
    Route::get('/pjub/minum/export_excel', [App\Http\Controllers\Pjub\MinumController::class, 'export_excel']);
    Route::get('/pjub/minum/tambah', [App\Http\Controllers\Pjub\MinumController::class, 'create'])->name('pjub/tambah_minum');
    Route::post('/pjub/minum/store', [App\Http\Controllers\Pjub\MinumController::class, 'store'])->name('pjub/tambah_minum');
    Route::get('/pjub/minum/{minum}/edit', [App\Http\Controllers\Pjub\MinumController::class, 'edit'])->name('pjub/edit_minum');
    Route::post('/pjub/minum/{minum}/update', [App\Http\Controllers\Pjub\MinumController::class, 'update'])->name('pjub/edit_minum');
    Route::get('/pjub/minum/{minum}/delete', [App\Http\Controllers\Pjub\MinumController::class, 'destroy']);
// });

// Berat Ayam PJUB
// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/berat', [App\Http\Controllers\Pjub\BeratController::class, 'index'])->name('pjub/berat');
    Route::get('/pjub/berat/export_excel', [App\Http\Controllers\Pjub\BeratController::class, 'export_excel']);
    Route::get('/pjub/berat/tambah', [App\Http\Controllers\Pjub\BeratController::class, 'create'])->name('pjub/tambah_berat');
    Route::post('/pjub/berat/store', [App\Http\Controllers\Pjub\BeratController::class, 'store'])->name('pjub/tambah_berat');
    Route::get('/pjub/berat/{berat}/edit', [App\Http\Controllers\Pjub\BeratController::class, 'edit'])->name('pjub/edit_berat');
    Route::post('/pjub/berat/{berat}/update', [App\Http\Controllers\Pjub\BeratController::class, 'update'])->name('pjub/edit_berat');
    Route::get('/pjub/berat/{berat}/delete', [App\Http\Controllers\Pjub\BeratController::class, 'destroy']);
// });

// Kematian PJUB
// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/kematian', [App\Http\Controllers\Pjub\KematianController::class, 'index'])->name('pjub/kematian');
    Route::get('/pjub/kematian/export_excel', [App\Http\Controllers\Pjub\KematianController::class, 'export_excel']);
    Route::get('/pjub/kematian/tambah', [App\Http\Controllers\Pjub\KematianController::class, 'create'])->name('pjub/tambah_kematian');
    Route::post('/pjub/kematian/store', [App\Http\Controllers\Pjub\KematianController::class, 'store'])->name('pjub/tambah_kematian');
    Route::get('/pjub/kematian/{kematian}/edit', [App\Http\Controllers\Pjub\KematianController::class, 'edit'])->name('pjub/edit_kematian');
    Route::post('/pjub/kematian/{kematian}/update', [App\Http\Controllers\Pjub\KematianController::class, 'update'])->name('pjub/edit_kematian');
    Route::get('/pjub/kematian/{kematian}/delete', [App\Http\Controllers\Pjub\KematianController::class, 'destroy']);
// });

// Vitamin PJUB
// Route::middleware(['auth','pjub'])->group(function () {
    Route::get('/pjub/vitamin', [App\Http\Controllers\Pjub\VitaminController::class, 'index'])->name('pjub/vitamin');
    Route::get('/pjub/vitamin/export_excel', [App\Http\Controllers\Pjub\VitaminController::class, 'export_excel']);
    Route::get('/pjub/vitamin/tambah', [App\Http\Controllers\Pjub\VitaminController::class, 'create'])->name('pjub/tambah_vitamin');
    Route::post('/pjub/vitamin/store', [App\Http\Controllers\Pjub\VitaminController::class, 'store'])->name('pjub/tambah_vitamin');
    Route::get('/pjub/vitamin/{vitamin}/edit', [App\Http\Controllers\Pjub\VitaminController::class, 'edit'])->name('pjub/edit_vitamin');
    Route::post('/pjub/vitamin/{vitamin}/update', [App\Http\Controllers\Pjub\VitaminController::class, 'update'])->name('pjub/edit_vitamin');
    Route::get('/pjub/vitamin/{vitamin}/delete', [App\Http\Controllers\Pjub\VitaminController::class, 'destroy']);
// });


//Auth::routes();