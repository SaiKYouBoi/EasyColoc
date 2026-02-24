<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/is-banned', function () {
    return view('auth.is-banned');
})->name('is-banned');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','checkbanned'])->name('dashboard');

Route::middleware(['auth','checkbanned'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
