<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [ApiController::class, 'login']);

Route::get('/posts', [ApiController::class, 'index']);
Route::get('/posts/{post}', [ApiController::class, 'show']);
Route::post('/posts', [ApiController::class, 'store'])->middleware('auth:sanctum');;
// HF: update, delete
