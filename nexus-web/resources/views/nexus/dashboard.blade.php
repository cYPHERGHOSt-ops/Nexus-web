
@extends('layouts.app')

@section('title', 'Dashboard | Borus')

@section('content')

<div class="dashboard borus-dragon-bg">



    <!-- Cabeçalho -->
    <div class="dashboard-header">
        <div>
            <span class="dashboard-eyebrow">SEU PAINEL</span>
            <h1>Visão geral<span class="dashboard-dot">.</span></h1>
            <p>Organize. Evolua. Conquiste.</p>
        </div>

        <div class="dashboard-date">
            <i class="bi bi-calendar3"></i>
            {{ now()->format('d/m/Y') }}
        </div>
    </div>

    <!-- Indicadores -->
    <div class="row g-3 mb-4">

        <div class="col-12 col-md-4">
            <div class="dashboard-card h-100">
                <div class="dashboard-card-top">
                    <span>Atividades concluídas</span>
                    <i class="bi bi-check2-circle"></i>
                </div>

                <div class="dashboard-value">
                    {{ $concluidas }}
                    <span>/ {{ $total }}</span>
                </div>

                <div class="dashboard-progress">
                    <div style="width: {{ $progresso }}%"></div>
                </div>

                <small>{{ $progresso }}% do dia concluído</small>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="dashboard-card h-100">
                <div class="dashboard-card-top">
                    <span>Saldo atual</span>
                    <i class="bi bi-wallet2"></i>
                </div>

                <div class="dashboard-value dashboard-money">
                    R$ {{ number_format($saldo, 2, ',', '.') }}
                </div>

                <a href="{{ route('nexus.financas') }}"
                   wire:navigate
                   class="dashboard-card-link">
                    Ver finanças
                    <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="dashboard-card h-100">
                <div class="dashboard-card-top">
                    <span>Investida / Patente</span>
                    <i class="bi bi-shield"></i>
                </div>

                <div class="dashboard-value">—</div>

                <small>Sua evolução aparecerá aqui.</small>
            </div>
        </div>

    </div>

    <!-- Atividades -->
    <section class="dashboard-card dashboard-activities">

        <div class="dashboard-section-header">
            <div>
                <h2>Atividades de hoje</h2>
                <p>Acompanhe suas tarefas e hábitos.</p>
            </div>

            <a href="{{ route('nexus.rotina') }}"
               wire:navigate
               class="dashboard-action">
                Ver rotina
                <i class="bi bi-arrow-up-right"></i>
            </a>
        </div>

        <div class="dashboard-activity-list">

            @forelse($atividades as $atividade)

                @php
                    $feita = $atividade->conclusoes->isNotEmpty();
                @endphp

                <div class="dashboard-activity">

                    <form
                        action="{{ url('/atividades/'.$atividade->id.'/conclusoes') }}"
                        method="POST"
                        data-borus-form
                        class="m-0"
                    >
                        @csrf

                        @if($feita)
                            @method('DELETE')
                        @endif

                        <button
                            type="submit"
                            class="dashboard-check {{ $feita ? 'done' : '' }}"
                            aria-label="{{ $feita ? 'Desmarcar' : 'Concluir' }} atividade"
                        >
                            <i class="bi {{ $feita ? 'bi-check-circle-fill' : 'bi-circle' }}"></i>
                        </button>
                    </form>

                    <span class="dashboard-activity-name {{ $feita ? 'completed' : '' }}">
                        {{ $atividade->titulo }}
                    </span>

                    <span class="dashboard-activity-time">
                        <i class="bi bi-clock"></i>
                        {{ $atividade->horario ? substr($atividade->horario, 0, 5) : 'Sem horário' }}
                    </span>

                </div>

            @empty

                <div class="dashboard-empty">
                    <i class="bi bi-calendar-plus"></i>
                    <h3>Nenhuma atividade hoje</h3>
                    <p>Comece criando sua primeira atividade.</p>

                    <a href="{{ route('nexus.rotina') }}"
                       wire:navigate
                       class="dashboard-action">
                        Criar atividade
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            @endforelse

        </div>

    </section>

</div>

@endsection

@push('styles')
<style>
.dashboard {
    max-width: 1400px;
    margin: 0 auto;
}

/* Cabeçalho */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 32px;
}

.dashboard-eyebrow {
    color: #777;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 2px;
}

.dashboard-header h1 {
    font-size: 34px;
    font-weight: 700;
    letter-spacing: -1px;
    margin: 8px 0;
}

.dashboard-dot {
    color: #888;
}

.dashboard-header p {
    color: #888;
    margin: 0;
}

.dashboard-date {
    color: #aaa;
    background: #181818;
    border: 1px solid #303030;
    padding: 10px 14px;
    border-radius: 10px;
    font-size: 13px;
    white-space: nowrap;
}

.dashboard-date i {
    margin-right: 8px;
}

/* Cartões */
.dashboard-card {
    background: #171717b0;
    border: 1px solid #303030;
    border-radius: 16px;
    padding: 24px;
    transition: border-color .2s;
}

.dashboard-card:hover {
    border-color: #505050;
}

.dashboard-card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #999;
    font-size: 13px;
}

.dashboard-card-top i {
    font-size: 20px;
    color: #aaa;
}

.dashboard-value {
    color: #fff;
    font-size: 38px;
    font-weight: 700;
    letter-spacing: -1px;
    margin: 18px 0;
}

.dashboard-value span {
    color: #666;
    font-size: 22px;
}

.dashboard-money {
    font-size: clamp(23px, 2.3vw, 34px);
    overflow-wrap: anywhere;
}

.dashboard-card small {
    color: #888;
    font-size: 12px;
}

/* Progresso */
.dashboard-progress {
    height: 6px;
    background: #333;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 10px;
}

.dashboard-progress div {
    height: 100%;
    background: #eaeaea;
    border-radius: 10px;
    transition: width .3s;
}

/* Links */
.dashboard-card-link,
.dashboard-action {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #ddd;
    text-decoration: none;
    font-size: 13px;
    transition: color .2s;
}

.dashboard-card-link:hover,
.dashboard-action:hover {
    color: white;
}

.dashboard-action {
    background: #252525;
    border: 1px solid #383838;
    padding: 9px 14px;
    border-radius: 9px;
    white-space: nowrap;
}

/* Seção de atividades */
.dashboard-section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-bottom: 20px;
}

.dashboard-section-header h2 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 5px;
}

.dashboard-section-header p {
    font-size: 13px;
    color: #888;
    margin: 0;
}

.dashboard-activity {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 17px 0;
    border-top: 1px solid #303030;
}

.dashboard-check {
    border: 0;
    background: none;
    color: #777;
    padding: 0;
    font-size: 23px;
    line-height: 1;
    cursor: pointer;
}

.dashboard-check:hover,
.dashboard-check.done {
    color: white;
}

.dashboard-activity-name {
    flex: 1;
    font-size: 14px;
}

.dashboard-activity-name.completed {
    color: #777;
    text-decoration: line-through;
}

.dashboard-activity-time {
    font-size: 12px;
    color: #888;
    white-space: nowrap;
}

.dashboard-activity-time i {
    margin-right: 5px;
}

/* Estado vazio */
.dashboard-empty {
    padding: 45px 15px;
    text-align: center;
    border-top: 1px solid #303030;
}

.dashboard-empty > i {
    font-size: 32px;
    color: #777;
}

.dashboard-empty h3 {
    font-size: 17px;
    margin-top: 15px;
}

.dashboard-empty p {
    font-size: 13px;
    color: #888;
}

@media (max-width: 768px) {
    .dashboard-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .dashboard-header h1 {
        font-size: 28px;
    }

    .dashboard-card {
        padding: 20px;
    }

    .dashboard-section-header {
        align-items: flex-start;
        flex-direction: column;
    }

  
}
</style>
@endpush
