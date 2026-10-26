<?php
/*opa, cara eu vou comentar tudo que eu fazer, ate mesmo pois decidi refazer o tcc justamente para
estudar, este aviso vai estar em tudo que eu fizer :)*/


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('atividade_conclusoes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('atividade_id') 
                ->constrained('atividades')
                ->cascadeOnDelete();
//a unica coisa de codar que muda da migration de atividades é o relacionamento
//aqui relacionando a atividade_conclusoes com a tabela atividades, e o cascadeOnDelete para apagar tudo que esta relacionado a tabela pai


            $table->date('data');

            $table->unique(['atividade_id', 'data']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atividade_conclusoes');
    }
};