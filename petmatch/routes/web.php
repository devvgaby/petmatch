<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Área Tutor
use App\Http\Controllers\Tutor\DashboardTutorController;
use App\Http\Controllers\Tutor\PetController;
use App\Http\Controllers\Tutor\MatchController;
use App\Http\Controllers\Tutor\PostagemController;
use App\Http\Controllers\Tutor\EventoController;
use App\Http\Controllers\Tutor\ChatController;

// Área Admin
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\PetController as AdminPetController;
use App\Http\Controllers\Admin\EventoController as AdminEventoController;
use App\Http\Controllers\Admin\PostagemController as AdminPostagemController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Área do Tutor
Route::middleware(['auth', 'tutor'])->prefix('tutor')->group(function () {
    Route::get('/dashboard', [DashboardTutorController::class, 'index'])->name('tutor.dashboard');
    Route::resource('pets', PetController::class);
    Route::resource('matches', MatchController::class);
    Route::resource('postagens', PostagemController::class);
    Route::resource('eventos', EventoController::class);
    Route::get('chat', ChatController::class);
});

// Área do Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('pets', AdminPetController::class);
    Route::resource('eventos', AdminEventoController::class);
    Route::resource('postagens', AdminPostagemController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
