<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TweetController::class, 'index'])->name('tweets.index');

// Public user profile
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::get('/dashboard', [TweetController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');
    Route::post('/tweets/{tweet}/like', [TweetController::class, 'like'])->name('tweets.like');
    Route::post('/tweets/{tweet}/retweet', [TweetController::class, 'retweet'])->name('tweets.retweet');
    Route::get('/tweets/{tweet}/edit', [TweetController::class, 'edit'])->name('tweets.edit');
    Route::put('/tweets/{tweet}', [TweetController::class, 'update'])->name('tweets.update');
    Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy'])->name('tweets.destroy');
});

require __DIR__.'/auth.php';
