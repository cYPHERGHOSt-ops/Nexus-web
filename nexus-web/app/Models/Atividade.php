<?php

//os models é o que faz a conexão do laravel com o bd, tipo ele diz para o laravel
//o que é a tabela, quais são os campos, quais são os tipos de dados, etc
//e tambem ele permite que o laravel faça alterações nos dados do bd

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $table = 'atividades'; //infoma qual a tabela que ele vai conectar

    protected $fillable = [ //vei, aqui no fillable ele diz qual campos pode ser prenchido, tipo em massa, coisa que eu não vou fazer 😎
        'user_id',
        'titulo',
        'descricao',
        'tipo',
        'data_inicio',
        'data_fim',
        'dias_semana',
        'horario',
        'ativo',
    ];

    protected function casts(): array //cara aqui é o seguinte, ele altera o tipo de dado, tipo 1=true 

    {
        return [                      //carbon é o tipo de data que o laravel usa
            'data_inicio' => 'date', // Objeto Carbon/data padrão (Y-m-d)
            'data_fim' => 'date',
            'dias_semana' => 'array',
            'ativo' => 'boolean',
        ];
    }

    public function conclusoes()
    {
        return $this->hasMany(AtividadeConclusao::class);
    }
}

//eu vou deixar o link da ducumentação aqui
//estou vendo e estudando 'por fora' kkkk 
//então tem coisas aqui que eu não sei, mas vou aprendendo aos poucos
//principalmente coisas que não foram passadas na aula, como o livewire
//https://laravel.com/framework/docs/12.x/eloquent-mutators
