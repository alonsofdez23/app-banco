<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CuentaController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/clientes', ClienteController::class)
    ->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/cuentas', [CuentaController::class, 'index'])
        ->name('cuentas.index');

    Route::get('/cuentas/create', [CuentaController::class, 'create'])
        ->name('cuentas.create');

    Route::post('/cuentas', [CuentaController::class, 'store'])
        ->name('cuentas.store');

    Route::get('/cuentas/{cuenta}', [CuentaController::class, 'show'])
        ->name('cuentas.show');

    Route::get('/cuentas/{cuenta}/addtitular', [CuentaController::class, 'addtitular'])
        ->name('cuentas.addtitular');

    Route::put('/cuentas/{cuenta}', [CuentaController::class, 'addtitularupdate'])
        ->name('cuentas.addtitular.update');

    Route::get('/cuentas/{cuenta}/titulares', [CuentaController::class, 'titulares'])
        ->name('cuentas.titulares');

    Route::delete('/cuentas/{cuenta}/titulares/{cliente}', [CuentaController::class, 'deleteTitular'])
        ->name('cuentas.titulares.delete');
});

require __DIR__.'/auth.php';
