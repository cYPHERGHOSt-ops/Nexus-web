<?php

/*opa, cara eu vou comentar tudo que eu fazer, ate mesmo pois decidi refazer o tcc justamente para
estudar, este aviso vai estar em tudo que eu fizer :)*/

//migration: é o que controla -cria - altera o banco de dados 

//imports
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void //função up: cria as tabelas
    {
        Schema::create('atividades', function (Blueprint $table) {

            //linha base: $table->tipoDeDado('nome_da_coluna')->modificador();

            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            //cacade: apaga tudo que esta relacionado a tabela pai 

            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->string('tipo', 20);

            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->json('dias_semana')->nullable();
            $table->time('horario')->nullable();

            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atividades');
    }
};