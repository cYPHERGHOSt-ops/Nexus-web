<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\AtividadeConclusaoController;
use App\Http\Controllers\TransacaoController;

// paginas (rotas das visualizações)
Route::view('/', 'nexus.dashboard')->name('nexus.dashboard');
Route::view('/rotina', 'nexus.rotina')->name('nexus.rotina');
Route::view('/treinos', 'nexus.treinos')->name('nexus.treinos');
Route::view('/financas', 'nexus.financas')->name('nexus.financas');
Route::view('/perfil', 'nexus.perfil')->name('nexus.perfil');

// atividades( são os controlles conctados com as rotas, então quando o usuario acessa a rota ele chama o controler )
Route::middleware('auth')->group(function () {
    Route::get('/atividades', [AtividadeController::class, 'index']);
    Route::get('/atividades/{atividade}', [AtividadeController::class, 'show']);
    Route::post('/atividades', [AtividadeController::class, 'store']);
    Route::put('/atividades/{atividade}', [AtividadeController::class, 'update']);
    Route::delete('/atividades/{atividade}', [AtividadeController::class, 'destroy']);

    // conclusões (mesma coisa, so que para as atividades concluidas)
    Route::post('/atividades/{atividade}/conclusoes', [AtividadeConclusaoController::class, 'store']);
    Route::delete('/atividades/{atividade}/conclusoes', [AtividadeConclusaoController::class, 'destroy']);

    // finanças( mesma coisa, so que para as transações)
    Route::get('/transacoes', [TransacaoController::class, 'index']);
    Route::get('/transacoes/{transacao}', [TransacaoController::class, 'show']);
    Route::post('/transacoes', [TransacaoController::class, 'store']);
    Route::put('/transacoes/{transacao}', [TransacaoController::class, 'update']);
    Route::delete('/transacoes/{transacao}', [TransacaoController::class, 'destroy']);
});