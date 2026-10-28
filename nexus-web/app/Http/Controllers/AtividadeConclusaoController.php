<?php

namespace App\Http\Controllers;

//outro controller que faz a conexão entre o model e as rotas 

use App\Models\Atividade;
use Illuminate\Http\Request;

class AtividadeConclusaoController extends Controller
{
    public function store(Request $request, Atividade $atividade)    //cria a atividade concluida
    {
        abort_unless($atividade->user_id === $request->user()->id, 403); //verifica de novo 

        return $atividade->conclusoes()->firstOrCreate([
            'data' => $request->input('data', now()->toDateString()) //vai salvar que a atividade foi concluida hoje
            //no caso quando ela for comleta
        ]);
    }

    public function destroy(Request $request, Atividade $atividade)  //apaga a conclusão da atividade
    {
        abort_unless($atividade->user_id === $request->user()->id, 403);

        $atividade->conclusoes()
            ->whereDate('data', $request->input('data', now()->toDateString()))
            ->delete();

        return response()->noContent();
    }
}
