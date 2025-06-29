<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NovelApiController;

Route::get('/novels', [NovelApiController::class, 'index']);
Route::put('/novels/{id}/toggle', [NovelApiController::class, 'toggleActive']);
