<?php

namespace App\Http\Controllers;



use App\Models\Transacao;
use Illuminate\Http\Request;

class TransacaoController extends Controller   
{
    public function index(Request $request)     //isso vai listas as trasações do usuario logado
    {
        return $request->user()->transacoes()
            ->orderByDesc('data')
            ->get();
    }

    public function show(Request $request, Transacao $transacao)   //ele faz uma consulta a trasação
    {
        abort_unless($transacao->user_id === $request->user()->id, 403);//de novo validação

        return $transacao;
    }

    public function store(Request $request)   //guarda as transações 
    {
        return $request->user()->transacoes()->create(
            $request->only([
                'descricao', 'valor', 'tipo', 'categoria', 'data'
            ])
        );
    }

    public function update(Request $request, Transacao $transacao)   //atualiza as transações
    {
        abort_unless($transacao->user_id === $request->user()->id, 403);

        $transacao->update($request->only([
            'descricao', 'valor', 'tipo', 'categoria', 'data'
        ]));

        return $transacao;
    }

    public function destroy(Request $request, Transacao $transacao)  //apaga as transações
    {
        abort_unless($transacao->user_id === $request->user()->id, 403);

        $transacao->delete();

        return response()->noContent();
    }
}
