<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;

// Route d'inscription
Route::get('/register', [RegisterController::class, 'create'])
    ->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Route de connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Route de réinitialisation du mot de passe
Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->name('password.update');

// Routes de vérification des emails
Route::get('/email/verify', [VerificationController::class, 'notice'])
    ->middleware(['auth'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed'])->name('verification.verify');
Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])->name('verification.send');
