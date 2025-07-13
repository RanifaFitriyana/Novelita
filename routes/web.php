<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NovelController;
use App\Http\Controllers\StoreController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman depan
Route::get('/', function () {
    return view('welcome');
});

// Dashboard umum (setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/store', [StoreController::class, 'index'])->name('store.index');

// Dashboard Admin (khusus admin)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Resource routes untuk Kategori dan Novel
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');
    Route::resource('novels', NovelController::class);
    Route::post('novels/{novel}/toggle-status', [NovelController::class, 'toggleStatus'])->name('novels.toggleStatus');
});


// Route untuk profil user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Route auth default (login, register, dll)
require __DIR__ . '/auth.php';
