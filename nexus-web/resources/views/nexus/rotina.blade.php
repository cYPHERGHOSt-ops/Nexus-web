
@extends('layouts.app')

@section('title', 'Rotina | Borus')

@section('content')

<div class="rotina borus-dragon-bg">

    <!-- Cabeçalho -->
    <div class="rotina-header ">
        <div>
            <span class="rotina-eyebrow">ORGANIZAÇÃO PESSOAL</span>
            <h1>Minha rotina<span class="rotina-dot">.</span></h1>
            <p>Construa hábitos. Organize seu dia.</p>
        </div>

        <div class="rotina-date">
            <i class="bi bi-calendar3"></i>
            {{ now()->format('d/m/Y') }}
        </div>
    </div>

    <div class="row g-3">

        <!-- Formulário -->
        <div class="col-12 col-lg-4">

            <section class="rotina-card">

                <div class="rotina-card-heading">
                    <i class="bi bi-plus-circle"></i>
                    <h2>Nova atividade</h2>
                </div>

                <p class="rotina-description">
                    Adicione uma tarefa ou um hábito à sua rotina.
                </p>

                <form method="POST"
                      action="{{ url('/atividades') }}"
                      data-borus-form>

                    @csrf

                    <div class="rotina-field">
                        <label for="titulo">Título</label>
                        <input
                            id="titulo"
                            name="titulo"
                            type="text"
                            required
                            maxlength="255"
                            placeholder="Ex.: Estudar programação"
                            class="form-control rotina-input"
                        >
                    </div>

                    <div class="rotina-field">
                        <label for="tipo">Tipo de atividade</label>
                        <select
                            id="tipo"
                            name="tipo"
                            class="form-select rotina-input"
                        >
                            <option value="habito">Hábito diário</option>
                            <option value="tarefa">Tarefa única</option>
                        </select>
                    </div>

                    <div class="rotina-field">
                        <label for="data_inicio">Data</label>
                        <input
                            id="data_inicio"
                            name="data_inicio"
                            type="date"
                            value="{{ now()->toDateString() }}"
                            required
                            class="form-control rotina-input"
                        >
                    </div>

                    <div class="rotina-field">
                        <label for="horario">Horário (opcional)</label>
                        <input
                            id="horario"
                            name="horario"
                            type="time"
                            class="form-control rotina-input"
                        >
                    </div>

                    <button type="submit" class="rotina-submit">
                        <i class="bi bi-plus-lg"></i>
                        Adicionar atividade
                    </button>

                </form>

            </section>

        </div>

        <!-- Lista de atividades -->
        <div class="col-12 col-lg-8">

            <section class="rotina-card">

                <div class="rotina-list-heading">
                    <div>
                        <h2>Atividades de hoje</h2>
                        <p>Seu progresso começa com pequenas ações.</p>
                    </div>

                    <span class="rotina-counter">
                        {{ $atividades->count() }}
                        {{ $atividades->count() === 1 ? 'atividade' : 'atividades' }}
                    </span>
                </div>

                <div class="rotina-list">

                    @forelse($atividades as $atividade)

                        @php
                            $feita = $atividade->conclusoes->isNotEmpty();
                        @endphp

                        <div class="rotina-item">

                            <form
                                method="POST"
                                action="{{ url('/atividades/'.$atividade->id.'/conclusoes') }}"
                                data-borus-form
                                class="m-0"
                            >
                                @csrf

                                @if($feita)
                                    @method('DELETE')
                                @endif

                                <button
                                    type="submit"
                                    class="rotina-check {{ $feita ? 'done' : '' }}"
                                    aria-label="{{ $feita ? 'Desmarcar' : 'Concluir' }} atividade"
                                >
                                    <i class="bi {{ $feita ? 'bi-check-circle-fill' : 'bi-circle' }}"></i>
                                </button>

                            </form>

                            <div class="rotina-item-info">

                                <div class="rotina-item-title {{ $feita ? 'completed' : '' }}">
                                    {{ $atividade->titulo }}
                                </div>

                                <div class="rotina-item-meta">

                                    <span>
                                        <i class="bi bi-arrow-repeat"></i>
                                        {{ $atividade->tipo === 'habito' ? 'Hábito diário' : 'Tarefa' }}
                                    </span>

                                    <span>
                                        <i class="bi bi-clock"></i>
                                        {{ $atividade->horario ? substr($atividade->horario, 0, 5) : 'Sem horário' }}
                                    </span>

                                </div>

                            </div>

                            <form
                                method="POST"
                                action="{{ url('/atividades/'.$atividade->id) }}"
                                data-borus-form
                                class="m-0"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="rotina-remove"
                                    aria-label="Remover atividade"
                                    title="Remover atividade"
                                >
                                    <i class="bi bi-trash3"></i>
                                </button>

                            </form>

                        </div>

                    @empty

                        <div class="rotina-empty">
                            <i class="bi bi-calendar-plus"></i>
                            <h3>Seu dia está livre</h3>
                            <p>Adicione uma atividade para começar.</p>
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
.rotina {
    max-width: 1400px;
    margin: 0 auto;
}

/* Cabeçalho */
.rotina-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 32px;
}

.rotina-eyebrow {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 2px;
    color: #777;
}

.rotina-header h1 {
    font-size: 34px;
    font-weight: 700;
    letter-spacing: -1px;
    margin: 8px 0;
}

.rotina-dot {
    color: #888;
}

.rotina-header p {
    color: #888;
    margin: 0;
}

.rotina-date {
    background: #181818;
    border: 1px solid #303030;
    color: #aaa;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 13px;
    white-space: nowrap;
}

.rotina-date i {
    margin-right: 8px;
}

/* Cartões */
.rotina-card {
    background: #171717;
    border: 1px solid #303030;
    border-radius: 16px;
    padding: 24px;
    height: 100%;
     transition: border-color .2s;
}

.rotina-card:hover {

    border: 1px solid #505050;

}

.rotina-card-heading {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
}

.rotina-card-heading i {
    font-size: 21px;
    color: #aaa;
}

.rotina-card-heading h2,
.rotina-list-heading h2 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.rotina-description {
    font-size: 13px;
    color: #888;
    margin-bottom: 24px;
}

/* Formulário */
.rotina-field {
    margin-bottom: 18px;
}

.rotina-field label {
    display: block;
    color: #aaa;
    font-size: 13px;
    margin-bottom: 8px;
}

.rotina-input,
.rotina-input:focus {
    background: #222;
    border: 1px solid #383838;
    border-radius: 9px;
    color: #fff;
    padding: 11px 13px;
    box-shadow: none;
}

.rotina-input:focus {
    border-color: #888;
}

.rotina-input::placeholder {
    color: #777;
}

.rotina-input option {
    background: #222;
    color: white;
}

.rotina-input::-webkit-calendar-picker-indicator {
    filter: invert(1);
}

.rotina-submit {
    width: 100%;
    background: #f0f0f0;
    border: none;
    color: #111;
    border-radius: 9px;
    padding: 12px;
    font-size: 14px;
    font-weight: 600;
    margin-top: 6px;
    transition: background .2s;
}

.rotina-submit:hover {
    background: #ccc;
}

.rotina-submit i {
    margin-right: 8px;
}

/* Lista */
.rotina-list-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-bottom: 22px;
}

.rotina-list-heading p {
    font-size: 13px;
    color: #888;
    margin: 7px 0 0;
}

.rotina-counter {
    background: #252525;
    color: #aaa;
    border: 1px solid #383838;
    padding: 7px 11px;
    border-radius: 8px;
    font-size: 12px;
    white-space: nowrap;
}

.rotina-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 18px 0;
    border-top: 1px solid #303030;
}

.rotina-check {
    background: none;
    border: none;
    color: #777;
    font-size: 23px;
    cursor: pointer;
    padding: 0;
}

.rotina-check:hover,
.rotina-check.done {
    color: white;
}

.rotina-item-info {
    flex: 1;
    min-width: 0;
}

.rotina-item-title {
    font-size: 14px;
    color: white;
    overflow-wrap: anywhere;
}

.rotina-item-title.completed {
    text-decoration: line-through;
    color: #777;
}

.rotina-item-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    color: #888;
    font-size: 12px;
    margin-top: 6px;
}

.rotina-item-meta i {
    margin-right: 4px;
}

.rotina-remove {
    background: transparent;
    color: #777;
    border: 1px solid #383838;
    border-radius: 8px;
    width: 35px;
    height: 35px;
    cursor: pointer;
    transition: .2s;
}

.rotina-remove:hover {
    color: #ff7777;
    border-color: #884444;
    background: #2a1919;
}

/* Lista vazia */
.rotina-empty {
    text-align: center;
    padding: 55px 15px;
    border-top: 1px solid #303030;
}

.rotina-empty > i {
    font-size: 34px;
    color: #777;
}

.rotina-empty h3 {
    font-size: 17px;
    margin-top: 15px;
}

.rotina-empty p {
    font-size: 13px;
    color: #888;
}

@media (max-width: 768px) {
    .rotina-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .rotina-header h1 {
        font-size: 28px;
    }

    .rotina-card {
        padding: 20px;
    }

    .rotina-list-heading {
        align-items: flex-start;
        flex-direction: column;
    }
}
</style>
@endpush
