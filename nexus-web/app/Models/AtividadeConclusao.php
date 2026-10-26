<?php
//nada a comentar aqui, so a mesma coisa que o outro model, 
// so que esse é para a tabela de conclusao das atividades
//é so um copia e cola o que muda é o belogs to, 
// que diz que a tabela de conclusao pertence a tabela de atividades

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtividadeConclusao extends Model
{
    protected $table = 'atividade_conclusoes';

    protected $fillable = [
        'atividade_id',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'date',
        ];
    }

    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }
}
