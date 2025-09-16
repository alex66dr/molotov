<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;

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
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/upload', [AdminController::class, 'upload'])->name('upload');
        Route::post('/upload', [AdminController::class, 'store'])->name('upload.store');
        
        // Server management routes
        Route::get('/servers', [ServerController::class, 'index'])->name('servers');
        Route::post('/servers', [ServerController::class, 'create'])->name('servers.create');
        Route::delete('/servers', [ServerController::class, 'destroy'])->name('servers.destroy');
    });
});

require __DIR__.'/auth.php';
