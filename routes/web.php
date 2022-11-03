<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MassUpdateController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', [AuthenticatedSessionController::class, 'home'])->middleware('guest')->name('home');

Route::get('/updateContractStatus', [MassUpdateController::class, 'contractStatusUpdate'])->middleware('auth')->name('contractStatus.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/scheduler_start', function () {
    Artisan::call('schedule:run');
    dd(Artisan::output());
})->name('start_scheduler');

require __DIR__.'/auth.php';
require __DIR__.'/assets.php';
require __DIR__.'/humanresource.php';
