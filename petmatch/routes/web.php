<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Área Tutor
use App\Http\Controllers\Tutor\DashboardTutorController;
use App\Http\Controllers\Tutor\PetController;
use App\Http\Controllers\Tutor\MatchController;
use App\Http\Controllers\Tutor\PostagemController;
use App\Http\Controllers\Tutor\EventoController;
use App\Http\Controllers\Tutor\ChatController;
use App\Http\Controllers\Tutor\ComentarioController;

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
Route::middleware(['auth', 'tutor'])->prefix('tutor')->as('tutor.')->group(function () {
    Route::get('/dashboard', [DashboardTutorController::class, 'dashboard'])->name('dashboard');
    Route::resource('pets', PetController::class);
    Route::resource('matches', MatchController::class);
    Route::resource('postagens', PostagemController::class);
    Route::post('comentarios/{postagemId}', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::delete('comentarios/{id}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');
    Route::resource('eventos', EventoController::class);
    Route::resource('chats', ChatController::class);
});


// Área do Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'dashboard'])->name('admin.dashboard');
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

//rota para o redirecionamento para a tela de login ao dar logout
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

require __DIR__ . '/auth.php';
