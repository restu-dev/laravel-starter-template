<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AksesController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\MasterButtonController;
use App\Http\Controllers\Auth\RegisterController;

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

Auth::routes();

//verifikasi email user
Auth::routes(['verify' => true]);
Route::get('/verip', function () {
    return view('auth.verify');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reload-captcha', [RegisterController::class, 'reloadCaptcha']);

// select
Route::post('select-level', [SelectController::class, 'level'])->name('select-level')->middleware('auth');

// user
Route::get('/user-account', [UserAccountController::class, 'index'])->name('user-account')->middleware('auth');
Route::post('/edit-user-account', [UserAccountController::class, 'edit'])->name('edit-user-account')->middleware('auth');

// home
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth')->middleware('cekmenuakses');

// master-button
Route::get('/master-button', [MasterButtonController::class, 'index'])->name('master-button')->middleware('auth')->middleware('cekmenuakses');


// level
Route::get('/admin/level', [LevelController::class, 'index'])->middleware('auth');
Route::post('admin/load-tabel-level', [LevelController::class, 'loadTabelLevel'])->name('load-tabel-level');
Route::post('admin/store-level', [LevelController::class, 'store']);
Route::post('admin/destroy-level', [LevelController::class, 'destroy']);

// user
Route::get('/admin/user', [UserController::class, 'index'])->middleware('auth');
Route::post('admin/load-tabel-user', [UserController::class, 'loadTabelUser'])->name('load-tabel-user');
Route::post('admin/destroy-user', [UserController::class, 'destroy']);
Route::post('admin/store-user', [UserController::class, 'store']);

// menu header
Route::get('/admin/menu', [MenuController::class, 'index'])->middleware('auth');
Route::post('admin/load-tabel-menu-header', [MenuController::class, 'loadTabelMenuHeader'])->name('load-tabel-menu-header');
Route::post('admin/store-menu-header', [MenuController::class, 'storeMenuHeader']);
Route::post('admin/detail-menu-header', [MenuController::class, 'detailMenuHeader']);
// menu parent
Route::post('admin/load-tabel-menu-parent', [MenuController::class, 'loadTabelMenuParent'])->name('load-tabel-menu-parent');
Route::post('admin/store-menu-parent', [MenuController::class, 'storeMenuParent']);
Route::post('admin/destroy-menu-parent', [MenuController::class, 'destroyParent']);

// akses
Route::get('/admin/akses', [AksesController::class, 'index'])->middleware('auth');
Route::post('admin/tampil-level-akses', [AksesController::class, 'tampilLevelAkses'])->name('tampil-level-akses');
Route::post('admin/simpan-akses-menu', [AksesController::class, 'simpanAksesMenu']);