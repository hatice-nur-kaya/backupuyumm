<?php

use Illuminate\Support\Facades\Route;



Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    'confirm' => false, // Email Confirmation Routes...
    'login' => false, // Login Routes...
]);

Route::get('/', function () {});
Route::get('/godMode/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/godMode/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
Route::get('/godMode', [App\Http\Controllers\HomeController::class, 'index'])->name('home')
    ->middleware(['auth', 'permission:developer']);
