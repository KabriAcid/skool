<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/**
 * Health check / API info endpoint
 * This is the only thing :8000 serves directly
 * All UI is handled by React on :5173
 */
Route::get('/', function () {
    return response()->json([
        'status' => 'ok',
        'app' => config('app.name', 'Laravel'),
        'version' => '1.0.0',
        'message' => 'Server is running. UI is served from http://localhost:5173',
        'api_docs' => '/api',
    ]);
})->name('health');

/**
 * All UI routes are now handled by React + Inertia on :5173
 * These routes still exist for Inertia to render pages when accessed from React
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__ . '/settings.php';
