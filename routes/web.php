<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [ThreadController::class, 'index'])->name('home');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Forum routes

// Show all threads
Route::get('/threads', [ThreadController::class, 'index'])
    ->name('threads.index');

// Create a new thread
Route::middleware('auth')->group(function () {
    Route::post('/thread/{thread}/topic', [TopicController::class, 'store'])
        ->name('topic.store');

    Route::post('/topic/{topic}/reply', [ReplyController::class, 'store'])
        ->name('reply.store');

    Route::get('/topic/{topic}/edit', [TopicController::class, 'edit'])
        ->name('topic.edit');

    Route::put('/topic/{topic}', [TopicController::class, 'update'])
        ->name('topic.update');

    Route::get('/reply/{reply}/edit', [ReplyController::class, 'edit'])
        ->name('reply.edit');

    Route::put('/reply/{reply}', [ReplyController::class, 'update'])
        ->name('reply.update');
});

// Admin-only routes
Route::middleware(['auth', App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/thread/create', [ThreadController::class, 'create'])
        ->name('thread.create');

    Route::post('/thread', [ThreadController::class, 'store'])
        ->name('thread.store');

    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/users/{user}', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update');

    Route::put('/users/{user}/password', [UserController::class, 'updatePassword'])
        ->name('users.password.update');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');
});

// Show one thread
Route::get('/thread/{thread}', [ThreadController::class, 'show'])
    ->name('thread.show');

// Show one topic inside a thread
Route::get('/thread/{thread}/topic/{topic}', [TopicController::class, 'show'])
    ->name('topic.show');

// Breeze authentication routes
require __DIR__.'/auth.php';