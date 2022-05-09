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
    Route::get('cuentas/create', [CuentaController::class, 'create'])
        ->name('cuentas.create');

    Route::post('cuentas/', [CuentaController::class, 'store'])
        ->name('cuentas.store');

    Route::get('cuentas/{cuenta}', [CuentaController::class, 'show'])
        ->name('cuentas.show');

    Route::post('cuentas/{cuenta}/titulares', [CuentaController::class, ''])
        ->name('cuentas.');

    Route::delete('cuentas/{cuenta}/titulares', [CuentaController::class, ''])
        ->name('cuentas.titulares.delete');
});

require __DIR__.'/auth.php';
