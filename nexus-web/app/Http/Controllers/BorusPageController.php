<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BorusPageController extends Controller
{
    private function atividadesHoje(Request $request)
    {
        $hoje = now()->toDateString();
        $diaSemana = now()->dayOfWeekIso;

        return $request->user()->atividades()
            ->with(['conclusoes' => fn ($query) => $query->whereDate('data', $hoje)])
            ->where('ativo', true)
            ->whereDate('data_inicio', '<=', $hoje)
            ->where(function ($query) use ($hoje) {
                $query->whereNull('data_fim')->orWhereDate('data_fim', '>=', $hoje);
            })
            ->orderBy('horario')
            ->get()
            ->filter(function ($atividade) use ($hoje, $diaSemana) {
                if ($atividade->tipo === 'tarefa') {
                    return $atividade->data_inicio->toDateString() === $hoje;
                }

                return empty($atividade->dias_semana)
                    || in_array($diaSemana, $atividade->dias_semana);
            })
            ->values();
    }

    public function dashboard(Request $request)
    {
        $atividades = $this->atividadesHoje($request);
        $total = $atividades->count();
        $concluidas = $atividades->filter(fn ($atividade) => $atividade->conclusoes->isNotEmpty())->count();
        $progresso = $total ? round($concluidas / $total * 100) : 0;

        $entradas = $request->user()->transacoes()->where('tipo', 'entrada')->sum('valor');
        $saidas = $request->user()->transacoes()->where('tipo', 'saida')->sum('valor');
        $saldo = (float) $entradas - (float) $saidas;

        return view('nexus.dashboard', compact('atividades', 'total', 'concluidas', 'progresso', 'saldo'));
    }

    public function rotina(Request $request)
    {
        $atividades = $this->atividadesHoje($request);

        return view('nexus.rotina', compact('atividades'));
    }

    public function financas(Request $request)
    {
        $transacoes = $request->user()->transacoes()
            ->orderByDesc('data')
            ->orderByDesc('id')
            ->get();

        $entradas = (float) $transacoes->where('tipo', 'entrada')->sum('valor');
        $saidas = (float) $transacoes->where('tipo', 'saida')->sum('valor');
        $saldo = $entradas - $saidas;

        return view('nexus.financas', compact('transacoes', 'entradas', 'saidas', 'saldo'));
    }
}
