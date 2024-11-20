<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [AdminController::class, 'listUsers'])->name('admin.users');
    Route::get('/report/{user}', [AdminController::class, 'viewReport'])->name('admin.report');
});

Route::middleware(['auth', 'role:employee'])->group(function () {

    Route::post('/clock-in', [ClockController::class, 'clockIn'])->name('clock.in');
    Route::post('/clock-out', [ClockController::class, 'clockOut'])->name('clock.out');
    Route::post('/break', [ClockController::class, 'manageBreak']);
});


require __DIR__ . '/auth.php';
