<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/ds', [App\Http\Controllers\Dashboard\DashboardController::class, 'home']);

Route::get('/coba', [App\Http\Controllers\Dashboard\DashboardController::class, 'coba'])->middleware('auth')->name('cobaAdminIndex');

Route::name('admin')
    ->prefix('admin')
    ->middleware('auth')
    ->group(__DIR__.'/admin.php');


// Route::prefix('admin')->middleware('auth')->group(function () {
//     Route::get('/', [DashboardController::class, 'home'])->name('Index');
//     Route::get('coba', [DashboardController::class, 'coba'])->name('coba');

//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);

// });