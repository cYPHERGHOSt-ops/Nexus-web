
<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'nexus.dashboard')->name('nexus.dashboard');
Route::view('/rotina', 'nexus.rotina')->name('nexus.rotina');
Route::view('/treinos', 'nexus.treinos')->name('nexus.treinos');
Route::view('/financas', 'nexus.financas')->name('nexus.financas');
Route::view('/perfil', 'nexus.perfil')->name('nexus.perfil');
