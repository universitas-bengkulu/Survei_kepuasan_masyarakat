<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PandaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});
Route::get('/operator', function () {
    return redirect()->route('operator.login');
});
Route::group(['prefix'  => 'operator/'],function(){
    Route::get('/login', function () {
        return view('auth/login_operator');
    })->name('operator.login');

    Route::get('/dashboard',[OperatorController::class, 'dashboard'])->name('operator.dashboard');

    Route::group(['prefix'  => 'indikator/'],function(){
        Route::get('/',[IndikatorController::class, 'index'])->name('operator.indikator');
        Route::post('/',[IndikatorController::class, 'post'])->name('operator.indikator.post');
        Route::delete('/{id}/delete',[IndikatorController::class, 'delete'])->name('operator.indikator.delete');
    });

    Route::group(['prefix'  => 'laporan/'],function(){
        Route::get('/per_prodi',[LaporanController::class, 'perProdi'])->name('operator.laporan.per_prodi');
        Route::get('/per_fakultas',[LaporanController::class, 'perFakultas'])->name('operator.laporan.per_fakultas');
        Route::get('/keseluruhan',[LaporanController::class, 'keseluruhan'])->name('operator.laporan.keseluruhan');
    });

});

Auth::routes();
// Route::get('/login',[PandaController::class, 'showLoginForm'])->name('login');
Route::post('/pandalogin',[PandaController::class, 'pandaLogin'])->name('panda.login');
Route::get('/logout', [PandaController::class, 'authLogout'])->name('authLogout');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'  => 'evaluasi/'],function(){
    Route::get('/',[HomeController::class, 'dashboard'])->name('evaluasi.dashboard');
    Route::post('/',[HomeController::class, 'post'])->name('evaluasi.post');
});
