<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\AlamatJamaahController;
use App\Http\Controllers\Dashboard\DataJamaahController;
use App\Http\Controllers\Dashboard\KasPenerimaanController;
use App\Http\Controllers\Dashboard\KasPengeluaranController;
use App\Http\Controllers\Dashboard\ZisController;
use App\Http\Controllers\Dashboard\ZisTypeController;
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
Route::get('/', [DashboardController::class, 'home'])->name('Index');
Route::get('/admin-profile', [DashboardController::class, 'coba'])->name('coba'); 

//Admin Role 
Route::group(['middleware' => ['role:Admin']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

//Permission Bendahara
Route::group(['middleware' => ['can:bendahara-create']], function(){
    //kas Route
    Route::resource('kas-penerimaan', KasPenerimaanController::class);
    Route::resource('kas-pengeluaran', KasPengeluaranController::class);

    //Zis
    Route::resource('zis-type', ZisTypeController::class);
});

//Can create
Route::group(['middleware' => ['permission:outsource-create']], function(){
    //Jamaah
    Route::resource('alamat-jamaah', AlamatJamaahController::class);
    Route::resource('data-jamaah', DataJamaahController::class);

    //zis
    Route::get('zis-dashboard', [ZisController::class, 'zisDashboard'])->name('ZisDashboard');
    Route::resource('zis', ZisController::class);
    Route::get('rekap-zakat-rekapan/{zis_type}', [ZisController::class, 'rekapHarian'])->name('ZisRekapHarian');

});

//can do soft delete
Route::group(['middleware' => ['permission:outsource-delete|dkm-delete']], function(){
    Route::delete('softdelete/keluarga/{id}', [DataJamaahController::class, 'SoftDelete'])->name('SoftDeleteKeluarga');
    Route::delete('softdelete/data-jamaah/{id}', [DataJamaahController::class, 'SoftDeleteByJamah'])->name('SoftDeleteJamaah');
    Route::delete('softdelete/zis/{id}', [ZisController::class, 'SoftDeleteById'])->name('SoftDeleteZis');
});



//Jamaah



Route::group(['prefix' => 'print'],function(){
    //Print Keluarga atau jamaah
    Route::get('/keluarga/{id}', [AlamatJamaahController::class, 'PrintKeluarga'])->name('PrintKeluarga');
});

Route::group(['prefix' => 'api'],function(){
    //Kas
    Route::get('/kas-penerimaan', [KasPenerimaanController::class, 'getAllDataPenerimaan'])->name('ApiAllKasPenerimaan');

    //Jamaah
    Route::get('/jamaah-internal', [AlamatJamaahController::class, 'getJamaahInternal'])->name('ApiAllJamaahInternal');
    Route::get('/jamaah-external', [AlamatJamaahController::class, 'getJamaahExternal'])->name('ApiAllJamaahExternal');

    //zis
    Route::get('/zis-data-tahun-ini', [ZisController::class, 'getZisDataByThisYear'])->name('ApiZisDataByThisYear');

});

Route::group(['prefix' => 'print'],function(){
    //Print Zakat {Fitrah, Mall, Fidyah}
    Route::get('/zakat-jamaah/{id}', [ZisController::class, 'PrintZakatJamaah'])->name('PrintZakatJamaah');
});