<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\ToolController;
use App\Http\Middleware\CustomAuth;
use App\Http\Middleware\CustomGuest;
use Illuminate\Support\Facades\Route;

Route::middleware(CustomGuest::class)->group(function () {
    Route::get('/', [SessionController::class, 'index'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('auth.login');
    Route::post('/register', [SessionController::class, 'create'])->name('auth.register');
});

Route::middleware(CustomAuth::class)->group(function () {
    Route::get('/tools', [ToolController::class, 'index'])->name('home');
    Route::post('/tools', [ToolController::class, 'store'])->name('create.tool');

    Route::get('/tools/{slug}', [ToolController::class, 'show'])->name('show.tool');
    Route::put('/tools/{slug}', [ToolController::class, 'update'])->name('update.tool');
    Route::delete('/tools/{slug}', [ToolController::class, 'delete'])->name('delete.tool');
    
    Route::get('/profile', [SessionController::class, 'show'])->name('profile');
    Route::put('/profile', [SessionController::class, 'update'])->name('update.account');
    Route::delete('/profile', [SessionController::class, 'delete'])->name('delete.account');

    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
});