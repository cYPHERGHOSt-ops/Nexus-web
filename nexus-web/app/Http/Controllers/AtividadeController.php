<?php

namespace App\Http\Controllers; //aqui deu erro kkk a sintaxe do php tem que esta na linha 1, e não pd ter nada antes do namespace

//controller é o que faz a conexão entre o model e as rotas 
//ele é o que cuida das logicas de requisição do banco de dados 

use App\Models\Atividade;
use Illuminate\Http\Request;

class AtividadeController extends Controller
{
    public function index(Request $request)  //mostra as atividades ativas do usuario
    {
        return $request->user()->atividades()
            ->where('ativo', true)
            ->orderBy('horario')
            ->get();
    }

    public function show(Request $request, Atividade $atividade)  //faz uma validação simples
                                                                  //para garantir qie as atividades são do usario logado
    {
        abort_unless($atividade->user_id === $request->user()->id, 403);

        return $atividade;
    }      //se o id do usuario for diferente do id da aitividade ele retorna o erro 403 
             //ainda vou pedsquiasr para saber se da para criar paginas de erro personalizadas 
            //aqui ele cria atividades store==guardar
 

public function store(Request $request)
{
    $atividade = $request->user()->atividades()->create(
        $request->only([
            'titulo', 'descricao', 'tipo',
            'data_inicio', 'data_fim',
            'dias_semana', 'horario'
        ])
    );

    return $request->expectsJson()
        ? response()->json($atividade, 201)
        : redirect()->route('dashboard');
}


    public function update(Request $request, Atividade $atividade)   //aqui ele atualiza as atividades
    {
        abort_unless($atividade->user_id === $request->user()->id, 403);//outra verificação 
                                                                        //que alias é bem facil de fazer

        $atividade->update($request->only([
            'titulo', 'descricao', 'tipo',
            'data_inicio', 'data_fim',
            'dias_semana', 'horario'
        ]));

        return $atividade;
    }

    public function destroy(Request $request, Atividade $atividade)  //aqui apaga
    {
        abort_unless($atividade->user_id === $request->user()->id, 403);

        $atividade->update(['ativo' => false]);

        return response()->noContent();
    }
}
