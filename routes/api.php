<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\GuestController; 

// Public routes - pakai controller
Route::get('/guests', [GuestController::class, 'index']);
Route::post('/guests', [GuestController::class, 'store']);

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/guests', [AdminController::class, 'index']);
    Route::patch('/guests/{id}/toggle-visibility', [AdminController::class, 'toggleVisibility']);
    Route::delete('/guests/{id}', [AdminController::class, 'destroy']);
});