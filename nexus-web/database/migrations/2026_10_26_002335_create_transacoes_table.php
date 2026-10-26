<?php

/*opa, cara eu vou comentar tudo que eu fazer, ate mesmo pois decidi refazer o tcc justamente para
estudar, este aviso vai estar em tudo que eu fizer :)   windows + v abre a área de transferência kkkk*/


//mesmo esquema das outras
//so copiar e alteras os valores 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();  

            $table->string('descricao');
            $table->decimal('valor', 12, 2);
            $table->string('tipo', 10);
            $table->string('categoria', 100);
            $table->date('data');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};