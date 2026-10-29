@extends('layouts.app')

@section('title', 'Dashboard | Borus')
@section('heading', 'Visão geral')

@section('content')
    @php
        // Dados temporários: depois serão carregados do banco de dados.
        $atividades = [
            ['titulo' => 'Estudar programação', 'horario' => '08:00', 'concluida' => true],
            ['titulo' => 'Praticar violão', 'horario' => '19:00', 'concluida' => false],
            ['titulo' => 'Trabalhar no Borus', 'horario' => '20:00', 'concluida' => false],
        ];
        $total = count($atividades);
        $concluidas = count(array_filter($atividades, fn ($item) => $item['concluida']));
        $progresso = $total ? round($concluidas / $total * 100) : 0;
    @endphp

    <style>
        .borus-dashboard .card {
            background: #151515;
            color: #f5f5f5;
            border: 1px solid #303030;
            border-radius: 12px;
        }
        .borus-dashboard .muted { color: #999; }
        .borus-dashboard .progress { background: #303030; height: 7px; }
        .borus-dashboard .progress-bar { background: #f5f5f5; }
        .borus-dashboard .list-group-item {
            background: transparent;
            color: #f5f5f5;
            border-color: #303030;
        }
        .borus-dashboard .form-check-input:checked {
            background-color: #777;
            border-color: #aaa;
        }
        .borus-dashboard .tarefa-concluida .tarefa-titulo {
            color: #888;
            text-decoration: line-through;
        }
    </style>

    <div class="borus-dashboard">
        <div class="mb-4">
            <h2 class="h4 mb-1">Bem-vindo ao Borus!</h2>
            <p class="muted mb-0">Organize. Evolua. Conquiste.</p>
            <small class="muted">{{ now()->locale('pt_BR')->translatedFormat('d \d\e F \d\e Y') }}</small>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <div class="card p-3 h-100">
                    <span class="muted">Atividades concluídas</span>
                    <strong class="fs-2" id="borus-contador">{{ $concluidas }}/{{ $total }}</strong>
                    <div class="progress mt-2" role="progressbar" aria-label="Progresso diário">
                        <div class="progress-bar" id="borus-progresso" style="width: {{ $progresso }}%"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card p-3 h-100">
                    <span class="muted">Investida atual</span>
                    <strong class="fs-2">—</strong>
                    <small class="muted">Aguardando integração com os dados</small>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card p-3 h-100">
                    <span class="muted">Patente</span>
                    <strong class="fs-2">—</strong>
                    <small class="muted">Definida pela sua consistência</small>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12 col-lg-8">
                <div class="card p-3">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                        <h3 class="h5 mb-0">Atividades de hoje</h3>
                        <a href="{{ route('nexus.rotina') }}" wire:navigate class="link-light">Ver rotina</a>
                    </div>

                    <div class="list-group list-group-flush" id="borus-lista">
                        @foreach ($atividades as $atividade)
                            <label class="list-group-item d-flex align-items-center gap-3 py-3 {{ $atividade['concluida'] ? 'tarefa-concluida' : '' }}">
                                <input type="checkbox" class="form-check-input m-0 borus-checkbox"
                                       @checked($atividade['concluida']) onchange="atualizarDashboardBorus()">
                                <span class="tarefa-titulo flex-grow-1">{{ $atividade['titulo'] }}</span>
                                <small class="muted">{{ $atividade['horario'] }}</small>
                            </label>
                        @endforeach
                    </div>
                    <small class="muted mt-3">Atividades demonstrativas. A persistência será implementada depois.</small>
                </div>