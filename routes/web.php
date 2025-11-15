<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

/**
 * Public routes (guest or authenticated)
 */
Route::get('/', function () {
    return Inertia::render('home', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

/**
 * Health check / API info endpoint
 * Direct access to :8000 shows server status only
 */
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'app' => config('app.name', 'Laravel'),
        'version' => '1.0.0',
        'message' => 'Server is running. UI is served from http://localhost:5173',
        'api_docs' => '/api',
    ]);
})->name('health');

/**
 * Protected routes (authenticated + verified)
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__ . '/settings.php';
