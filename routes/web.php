<?php

use Illuminate\Support\Facades\Route;
use App\Models\Guest;
use App\Http\Controllers\AuthController;

// Dashboard Admin (protected)
Route::get('/admin', function() {
    if (!session('is_admin')) return redirect('/admin/login');
    $guests = Guest::orderBy('created_at', 'desc')->get();
    return view('dashboard', compact('guests'));
})->name('dashboard');

// Login page
Route::get('/admin/login', function() {
    if (session('is_admin')) return redirect('/admin');
    return view('login');
})->name('login');

// Login submit
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.submit');

// Logout
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Toggle visibility (Hide/Tampil)
Route::put('/admin/guests/{id}/toggle', function($id) {
    if (!session('is_admin')) return redirect('/admin/login');
    
    $guest = Guest::findOrFail($id);
    $guest->status = !$guest->status; // Toggle 0/1
    $guest->save();
    
    return redirect('/admin')->with('success', 'Status berhasil diubah');
})->name('admin.guests.toggle');

// Delete guest
Route::delete('/admin/guests/{id}', function($id) {
    if (!session('is_admin')) return redirect('/admin/login');
    
    Guest::destroy($id);
    
    return redirect('/admin')->with('success', 'Data berhasil dihapus');
})->name('admin.guests.delete');