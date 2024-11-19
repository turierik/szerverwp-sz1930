<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect() -> route('posts.index');
});

// Route::get('/posts', [PostController::class, 'index']) -> name('posts.index');
// Route::get('/posts/create', [PostController::class, 'create']) -> name('posts.create');
// Route::get('/posts/{post}/edit', [PostController::class, 'edit']) -> name('posts.edit');
// Route::get('/posts/{post}', [PostController::class, 'show']) -> name('posts.show');
// Route::post('/posts', [PostController::class, 'store']) -> name('posts.store');
// Route::patch('/posts/{post}', [PostController::class, 'update']) -> name('posts.update');
// Route::delete('/posts/{post}', [PostController::class, 'destroy']) -> name('posts.destroy');
Route::resource('/posts', PostController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
