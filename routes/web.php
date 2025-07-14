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

// Halaman toko (store frontend)
Route::get('/store', [StoreController::class, 'index'])->name('store.index');

// Route untuk dashboard & fitur admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Sinkronisasi dan toggle status (pastikan sebelum resource!)
    Route::post('novels/{novel}/sync', [NovelController::class, 'sync'])->name('novels.sync');
    Route::post('novels/{novel}/toggle-status', [NovelController::class, 'toggleStatus'])->name('novels.toggleStatus');
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggleStatus');
    Route::post('categories/{category}/sync', [CategoryController::class, 'sync'])->name('categories.sync');

    // CRUD Resource
    Route::resource('novels', NovelController::class);
    Route::resource('categories', CategoryController::class);
});

// Route untuk profil user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route auth default
require __DIR__ . '/auth.php';
