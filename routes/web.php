<?php

use App\Http\Controllers\RandomUserController;
use Illuminate\Support\Facades\Route;

// Pantalla inicial → tu login personalizado
Route::get('/', function () {
    return view('login'); // ESTA ES TU VISTA PERSONALIZADA
})->name('login');

// Logout
Route::post('/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

// API
Route::middleware('api')->get('/random-user', [RandomUserController::class, 'generate']);

// Generador (solo logueado)
Route::middleware(['auth', 'verified'])->get('/viewer', function () {
    return view('random-viewer');
})->name('viewer');

// Dashboard redirige a viewer
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/viewer');
    })->name('dashboard');
});
