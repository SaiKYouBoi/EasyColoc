<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/is-banned', function () {
    return view('auth.is-banned');
})->name('is-banned');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','checkbanned'])->name('dashboard');

Route::middleware(['auth','checkbanned'])->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('userdashboard');
    Route::get('/user-colocations',  [ColocationController::class, 'colocation'])->name('colocations');
    Route::post('/user-colocations', [ColocationController::class, 'store'])->name('colocation.create');
    Route::get('/colocation-details', [ColocationController::class, 'colocDetail'])->name('colocation.detail');
    Route::get('/colocations/{colocation}', [ColocationController::class, 'show'])->name('colocations.show');
    Route::get('/categories/{colocation}', [CategoryController::class, 'colocCategories'])->name('categories.show');
    Route::post('/colocations/{colocation}/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/colocations/{colocation}', [ExpenseController::class, 'store'])->name('expense.store');



});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
