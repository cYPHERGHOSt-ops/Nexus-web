
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\AtividadeConclusaoController;
use App\Http\Controllers\TransacaoController;

// pagina de login
Route::redirect('/', '/login');

// dashboard porem so entra que esta logado 
Route::middleware('auth')->group(function () {

    Route::view('/dashboard', 'nexus.dashboard')->name('dashboard');
    Route::view('/rotina', 'nexus.rotina')->name('nexus.rotina');
    Route::view('/treinos', 'nexus.treinos')->name('nexus.treinos');
    Route::view('/financas', 'nexus.financas')->name('nexus.financas');
    Route::view('/perfil', 'nexus.perfil')->name('nexus.perfil');

    // Perfil do Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Atividades
    Route::get('/atividades', [AtividadeController::class, 'index']);
    Route::get('/atividades/{atividade}', [AtividadeController::class, 'show']);
    Route::post('/atividades', [AtividadeController::class, 'store']);
    Route::put('/atividades/{atividade}', [AtividadeController::class, 'update']);
    Route::delete('/atividades/{atividade}', [AtividadeController::class, 'destroy']);

    // Conclusões
    Route::post('/atividades/{atividade}/conclusoes', [AtividadeConclusaoController::class, 'store']);
    Route::delete('/atividades/{atividade}/conclusoes', [AtividadeConclusaoController::class, 'destroy']);

    // Finanças
    Route::get('/transacoes', [TransacaoController::class, 'index']);
    Route::get('/transacoes/{transacao}', [TransacaoController::class, 'show']);
    Route::post('/transacoes', [TransacaoController::class, 'store']);
    Route::put('/transacoes/{transacao}', [TransacaoController::class, 'update']);
    Route::delete('/transacoes/{transacao}', [TransacaoController::class, 'destroy']);
});

// Rotas de autenticação do Breeze
require __DIR__.'/auth.php';
