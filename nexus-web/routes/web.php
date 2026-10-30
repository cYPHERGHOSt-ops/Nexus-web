<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BorusPageController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\AtividadeConclusaoController;
use App\Http\Controllers\TransacaoController;

Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {
    // Páginas, com dados do usuário autenticado
    Route::get('/dashboard', [BorusPageController::class, 'dashboard'])->name('dashboard');
    Route::get('/rotina', [BorusPageController::class, 'rotina'])->name('nexus.rotina');
    Route::get('/financas', [BorusPageController::class, 'financas'])->name('nexus.financas');

    // Outras páginas existentes, mantidas por compatibilidade
    Route::view('/treinos', 'nexus.treinos')->name('nexus.treinos');
    Route::view('/perfil', 'nexus.perfil')->name('nexus.perfil');
    Route::get('/inicio', fn () => redirect()->route('dashboard'))->name('nexus.dashboard');

    // Perfil do Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Atividades e conclusões (controllers já existentes)
    Route::get('/atividades', [AtividadeController::class, 'index']);
    Route::post('/atividades', [AtividadeController::class, 'store']);
    Route::get('/atividades/{atividade}', [AtividadeController::class, 'show']);
    Route::put('/atividades/{atividade}', [AtividadeController::class, 'update']);
    Route::delete('/atividades/{atividade}', [AtividadeController::class, 'destroy']);
    Route::post('/atividades/{atividade}/conclusoes', [AtividadeConclusaoController::class, 'store']);
    Route::delete('/atividades/{atividade}/conclusoes', [AtividadeConclusaoController::class, 'destroy']);

    // Transações (controller já existente)
    Route::get('/transacoes', [TransacaoController::class, 'index']);
    Route::post('/transacoes', [TransacaoController::class, 'store']);
    Route::get('/transacoes/{transacao}', [TransacaoController::class, 'show']);
    Route::put('/transacoes/{transacao}', [TransacaoController::class, 'update']);
    Route::delete('/transacoes/{transacao}', [TransacaoController::class, 'destroy']);
});

require __DIR__.'/auth.php';
