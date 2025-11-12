<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Dashboard with Posts CRUD
Route::get('/dashboard', [PostController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/dashboard', [PostController::class, 'store'])
    ->middleware('auth')
    ->name('posts.store');

Route::put('/dashboard/{post}', [PostController::class, 'update'])
    ->middleware('auth')
    ->name('posts.update');

Route::delete('/dashboard/{post}', [PostController::class, 'destroy'])
    ->middleware('auth')
    ->name('posts.destroy');

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
