<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NovelController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminRegisteredController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// Dashboard umum (setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::get('/', [StoreController::class, 'home'])->name('store.home');
Route::get('/products', [StoreController::class, 'products'])->name('store.products');
Route::get('/categories', [StoreController::class, 'categories'])->name('store.categories');
Route::get('/contact', [StoreController::class, 'contact'])->name('store.contact');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

// Route Admin Auth (login, register, logout)
Route::prefix('admin')->name('admin.')->middleware('guest:admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::get('register', [AdminRegisteredController::class, 'create'])->name('register');
    Route::post('register', [AdminRegisteredController::class, 'store']);
});

Route::post('admin/logout', [AdminAuthController::class, 'logout'])->middleware('auth:admin')->name('admin.logout');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    

// Route auth default
require __DIR__ . '/auth.php';
