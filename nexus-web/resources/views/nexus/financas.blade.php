@extends('layouts.app')
@section('title', 'Finanças | Borus')
@section('content')
@php
$lista = collect($transacoes ?? []);
$entradas = $lista->where('tipo', 'entrada')->sum('valor');
$saidas = $lista->where('tipo', 'saida')->sum('valor');
@endphp
<div class="financas borus-dragon-bg">

    <!-- Cabeçalho -->
    <div class="financas-header">
        <div>
            <span class="financas-eyebrow">CONTROLE FINANCEIRO</span>
            <h1>Minhas finanças<span class="financas-dot">.</span></h1>
            <p>Controle seu dinheiro. Planeje seu futuro.</p>
        </div>
        <div class="financas-date">
            <i class="bi bi-calendar3"></i>
            {{ now()->format('d/m/Y') }}
        </div>
    </div>

    <!-- Indicadores -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <section class="financas-card financas-saldo h-100">
                <div class="financas-card-top">
                    <span>Saldo atual</span>
                    <i class="bi bi-wallet2"></i>
                </div>
                <div class="financas-value">
                    R$ {{ number_format($saldo, 2, ',', '.') }}
                </div>
                <small>Seu saldo disponível</small>
            </section>
        </div>
        <div class="col-12 col-md-4">
            <section class="financas-card financas-entrada h-100">
                <div class="financas-card-top">
                    <span>Entradas</span>
                    <i class="bi bi-arrow-up-right "></i>
                </div>
                <div class="financas-value">
                    R$ {{ number_format($entradas, 2, ',', '.') }}
                </div>
                <small>Total recebido</small>
            </section>
        </div>
        <div class="col-12 col-md-4">
            <section class="financas-card financas-saida h-100">
                <div class="financas-card-top">
                    <span>Saídas</span>
                    <i class="bi bi-arrow-down-left"></i>
                </div>
                <div class="financas-value">
                    R$ {{ number_format($saidas, 2, ',', '.') }}
                </div>
                <small>Total gasto</small>
            </section>
        </div>
    </div>
    <div class="row g-3">

        <!-- Nova transação -->
        <div class="col-12 col-lg-4">
            <section class="financas-card">
                <div class="financas-section-heading">
                    <i class="bi bi-plus-circle"></i>
                    <h2>Nova transação</h2>
                </div>
                <p class="financas-description">
                    Registre suas entradas e saídas.
                </p>
                <form method="POST"
                    action="{{ url('/transacoes') }}"
                    data-borus-form>
                    @csrf
                    <div class="financas-field">
                        <label for="descricao">Descrição</label>
                        <input
                            id="descricao"
                            name="descricao"
                            class="form-control financas-input"
                            placeholder="Ex.: Trabalho freelancer"
                            maxlength="255"
                            required>
                    </div>
                    <div class="financas-field">
                        <label for="valor">Valor (R$)</label>
                        <input
                            id="valor"
                            name="valor"
                            type="number"
                            min="0.01"
                            step="0.01"
                            class="form-control financas-input"
                            placeholder="0,00"
                            required>
                    </div>
                    <div class="financas-field">
                        <label for="tipo">Tipo</label>
                        <select id="tipo"
                            name="tipo"
                            class="form-select financas-input">
                            <option value="entrada">Entrada</option>
                            <option value="saida">Saída</option>
                        </select>
                    </div>
                    <div class="financas-field">
                        <label for="categoria">Categoria</label>
                        <input
                            id="categoria"
                            name="categoria"
                            class="form-control financas-input"
                            placeholder="Ex.: Trabalho"
                            maxlength="100"
                            required>
                    </div>
                    <div class="financas-field">
                        <label for="data">Data</label>
                        <input
                            id="data"
                            name="data"
                            type="date"
                            value="{{ now()->toDateString() }}"
                            class="form-control financas-input"
                            required>
                    </div>
                    <button type="submit" class="financas-submit">
                        <i class="bi bi-plus-lg"></i>
                        Adicionar transação
                    </button>
                </form>
            </section>
        </div>

        <!-- Histórico -->
        <div class="col-12 col-lg-8">
            <section class="financas-card">
                <div class="financas-list-heading">
                    <div>
                        <h2>Histórico de transações</h2>
                        <p>Suas movimentações financeiras.</p>
                    </div>
                    <span class="financas-counter">
                        {{ $lista->count() }}
                        {{ $lista->count() === 1 ? 'transação' : 'transações' }}
                    </span>
                </div>
                <div class="financas-list">
                    @forelse($lista as $transacao)
                    <div class="financas-item">
                        <div class="financas-item-icon">
                            <i class="bi {{ $transacao->tipo === 'entrada'
                                    ? 'bi-arrow-up-right'
                                    : 'bi-arrow-down-left' }}"></i>
                        </div>
                        <div class="financas-item-info">
                            <div class="financas-item-title">
                                {{ $transacao->descricao }}
                            </div>
                            <div class="financas-item-meta">
                                {{ $transacao->categoria }}
                                ·
                                {{ \Carbon\Carbon::parse($transacao->data)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="financas-item-value">
                            {{ $transacao->tipo === 'entrada' ? '+' : '-' }}
                            R$ {{ number_format($transacao->valor, 2, ',', '.') }}
                        </div>
                        <form method="POST"
                            action="{{ url('/transacoes/'.$transacao->id) }}"
                            data-borus-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="financas-remove"
                                aria-label="Excluir transação">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </div>
                    @empty
                    <div class="financas-empty">
                        <i class="bi bi-wallet2"></i>
                        <h3>Nenhuma transação ainda</h3>
                        <p>Registre sua primeira movimentação financeira.</p>
                    </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>

    .financas {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Cabeçalho */

    .financas-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 32px;
    }

    .financas-eyebrow {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 2px;
        color: #777;
    }
    .financas-header h1 {
        font-size: 34px;
        font-weight: 700;
        letter-spacing: -1px;
        margin: 8px 0;
    }

    .financas-dot {
        color: #888;
    }
    .financas-header p {
        color: #888;
        margin: 0;
    }

    .financas-date {
    color: #aaa;
    background: #181818;
    border: 1px solid #303030;
    padding: 10px 14px;
    border-radius: 10px;
    font-size: 13px;
    white-space: nowrap;
    }

    /* Cartões */

    .financas-card {
        background: #171717b0;
        border: 1px solid #303030;
        border-radius: 16px;
        padding: 24px;
        height: 100%;
        transition: border-color .2s;
    }
    .financas-card:hover {
        border-color: #746f6fd4;
    }

    /* Brilho radial dos indicadores financeiros */

    .financas-card.financas-entrada {
        background: radial-gradient(
            ellipse at 90% 0%,
            rgba(30, 185, 100, 0.30) 0%,
            rgba(23, 23, 23, 0.82) 72%
        );
        
    }

    .financas-card.financas-saida {
        background: radial-gradient(
            ellipse at 90% 0%,
            rgba(220, 55, 75, 0.28) 0%,
            rgba(23, 23, 23, 0.82) 72%
        );
       
    }

        .financas-card.financas-saldo {
        background: radial-gradient(
            ellipse at 90% 0%,
            rgba(204, 220, 55, 0.28) 0%,
            rgba(23, 23, 23, 0.82) 72%
        );
       
    }

    .financas-entrada .financas-card-top i {
        color: #65d895;
    }
    .financas-saida .financas-card-top i {
        color: #ef8790;
    }

    .financas-card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #999;
        font-size: 13px;
    }
    .financas-card-top i {
        font-size: 20px;
    }

    .financas-value {
        color: white;
        font-size: clamp(23px, 2.4vw, 34px);
        font-weight: 700;
        letter-spacing: -1px;
        margin: 20px 0;
        overflow-wrap: anywhere;
    }
    .financas-card small {
        color: #888;
        font-size: 12px;
    }

    /* Formulário */

    .financas-section-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
    }
    .financas-section-heading h2,
    .financas-list-heading h2 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }
    .financas-section-heading i {
        color: #aaa;
        font-size: 20px;
    }

    .financas-description {
        color: #888;
        font-size: 13px;
        margin-bottom: 24px;
    }

    .financas-field {
        margin-bottom: 18px;
    }
    .financas-field label {
        display: block;
        font-size: 13px;
        color: #aaa;
        margin-bottom: 8px;
    }

    .financas-input,
    .financas-input:focus {
        background: #222;
        color: white;
        border: 1px solid #383838;
        border-radius: 9px;
        padding: 11px 13px;
        box-shadow: none;
    }
    .financas-input:focus {
        border-color: #888;
    }
    .financas-input::placeholder {
        color: #777;
    }
    .financas-input option {
        background: #222;
        color: white;
    }
    .financas-input::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }

    .financas-submit {
        width: 100%;
        background: #f0f0f0;
        color: #111;
        border: none;
        border-radius: 9px;
        padding: 12px;
        font-size: 14px;
        font-weight: 600;
        margin-top: 6px;
        transition: background .2s;
    }
    .financas-submit:hover {
        background: #ccc;
    }

    /* Histórico */

    .financas-list-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 22px;
    }
    .financas-list-heading p {
        color: #888;
        font-size: 13px;
        margin: 7px 0 0;
    }

    .financas-counter {
        background: #252525;
        border: 1px solid #383838;
        color: #aaa;
        padding: 7px 11px;
        border-radius: 8px;
        font-size: 12px;
        white-space: nowrap;
    }

    .financas-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 18px 0;
        border-top: 1px solid #303030;
    }

    .financas-item-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        background: #252525;
        border-radius: 10px;
        display: grid;
        place-items: center;
        color: #ddd;
    }

    .financas-item-info {
        flex: 1;
        min-width: 0;
    }

    .financas-item-title {
        color: white;
        font-size: 14px;
        overflow-wrap: anywhere;
    }

    .financas-item-meta {
        color: #888;
        font-size: 12px;
        margin-top: 6px;
    }

    .financas-item-value {
        color: white;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }

    .financas-remove {
        background: transparent;
        border: 1px solid #383838;
        border-radius: 8px;
        width: 35px;
        height: 35px;
        color: #777;
        cursor: pointer;
        transition: .2s;
    }
    .financas-remove:hover {
        color: #ff7777;
        border-color: #884444;
        background: #2a1919;
    }

  

    .financas-empty {
        text-align: center;
        padding: 55px 15px;
        border-top: 1px solid #303030;
    }
    .financas-empty>i {
        font-size: 34px;
        color: #777;
    }
    .financas-empty h3 {
        font-size: 17px;
        margin-top: 15px;
    }
    .financas-empty p {
        color: #888;
        font-size: 13px;
    }
    @media (max-width: 768px) {
        .financas-header {
            align-items: flex-start;
            flex-direction: column;
        }
        .financas-header h1 {
            font-size: 28px;
        }
        .financas-card {
            padding: 20px;
        }
        .financas-list-heading {
            align-items: flex-start;
            flex-direction: column;
        }
        .financas-item {
            flex-wrap: wrap;
        }
}
</style>
@endpush
