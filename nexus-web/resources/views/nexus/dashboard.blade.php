
@extends('layouts.app')

@section('title', 'Dashboard')
@section('heading', 'Visão geral')


@push('styles')
<style>
    .dashboard-page {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .dashboard-main-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.7fr) minmax(240px, 1fr);
        align-items: start;
        gap: 20px;
    }

    .dashboard-side-column {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .dashboard-page a {
        transition: background .2s, color .2s, border-color .2s;
    }

    .dashboard-page .text-link,
    .dashboard-page .add-task-link,
    .dashboard-page .shortcut-item {
        text-decoration: none;
        cursor: pointer;
    }

    .dashboard-page .text-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: var(--text);
        font-size: .85rem;
    }

    .dashboard-page .text-link:hover {
        color: var(--accent);
    }

    .dashboard-page .add-task-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 14px;
        padding: 12px;
        border: 1px solid var(--border);
        border-radius: 10px;
        color: var(--text);
        background: var(--bg);
        font-size: .85rem;
    }

    .dashboard-page .add-task-link:hover {
        border-color: var(--accent);
        background: var(--surface);
    }

    .dashboard-page .shortcut-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid var(--border);
    }

    .dashboard-page .shortcut-item:last-child {
        border-bottom: 0;
    }

    .dashboard-page .shortcut-item:hover .shortcut-arrow {
        color: var(--accent);
        transform: translate(2px, -2px);
    }

    .dashboard-page .shortcut-arrow {
        margin-left: auto;
        transition: transform .2s, color .2s;
    }

    @media (max-width: 900px) {
        .dashboard-main-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-side-column {
            display: grid;
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .dashboard-page {
            gap: 18px;
        }

        .dashboard-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .dashboard-main-grid {
            gap: 16px;
        }

        .dashboard-page .panel-heading {
            gap: 10px;
        }

        .dashboard-page .task-time {
            font-size: .7rem;
        }
    }
</style>
@endpush


@section('content')
    @php
        $dataHoje = now()->locale('pt_BR');

        $atividades = [
            [
                'titulo' => 'Estudar programação',
                'categoria' => 'Estudos',
                'horario' => '08:00',
                'icone' => 'bi-code-slash',
                'concluida' => true,
            ],
            [
                'titulo' => 'Treino do dia',
                'categoria' => 'Saúde',
                'horario' => '17:30',
                'icone' => 'bi-activity',
                'concluida' => false,
            ],
            [
                'titulo' => 'Praticar violão',
                'categoria' => 'Pessoal',
                'horario' => '19:00',
                'icone' => 'bi-music-note',
                'concluida' => false,
            ],
            [
                'titulo' => 'Trabalhar no Nexus',
                'categoria' => 'Projetos',
                'horario' => '20:00',
                'icone' => 'bi-laptop',
                'concluida' => false,
            ],
        ];

        $totalAtividades = count($atividades);
        $atividadesConcluidas = count(array_filter($atividades, fn ($atividade) => $atividade['concluida']));
        $progresso = $totalAtividades > 0
            ? round(($atividadesConcluidas / $totalAtividades) * 100)
            : 0;
    @endphp

    <div class="dashboard-page">

        <section class="dashboard-welcome">
            <div>
                <span class="section-eyebrow">SEU ESPAÇO, SEU PROGRESSO</span>
                <h2 class="dashboard-title">Construa seu progresso.</h2>
                <p class="dashboard-subtitle">
                    Um passo de cada vez. Faça o dia valer a pena.
                </p>
            </div>

            <div class="dashboard-date">
                <i class="bi bi-calendar3"></i>
                <span>{{ ucfirst($dataHoje->translatedFormat('l, d \d\e F')) }}</span>
            </div>
        </section>

        <section class="dashboard-stats">
            <article class="stat-card">
                <div class="stat-card-top">
                    <span class="stat-label">Atividades concluídas</span>
                    <span class="stat-icon"><i class="bi bi-check2-circle"></i></span>
                </div>

                <div class="stat-value" id="completed-count">
                    {{ $atividadesConcluidas }}<span class="stat-total">/{{ $totalAtividades }}</span>
                </div>

                <p class="stat-description">Tarefas finalizadas hoje</p>

                <div class="progress-track">
                    <div
                        class="progress-fill"
                        id="dashboard-progress"
                        style="width: {{ $progresso }}%"
                    ></div>
                </div>
            </article>

            <article class="stat-card">
                <div class="stat-card-top">
                    <span class="stat-label">Sequência atual</span>
                    <span class="stat-icon"><i class="bi bi-calendar2-check"></i></span>
                </div>

                <div class="stat-value">
                    3 <span class="stat-unit">dias</span>
                </div>

                <p class="stat-description">Seu ritmo de consistência</p>

                <div class="stat-footer">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span>Recorde: 7 dias</span>
                </div>
            </article>

            <article class="stat-card rank-card">
                <div class="stat-card-top">
                    <span class="stat-label">Patente atual</span>
                    <span class="stat-icon"><i class="bi bi-shield-check"></i></span>
                </div>

                <div class="stat-value rank-value">Soldado</div>

                <p class="stat-description">Sua evolução pela consistência</p>

                <div class="rank-next">
                    <div class="rank-next-label">
                        <span>Próxima patente</span>
                        <strong>4 dias restantes</strong>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" style="width: 43%"></div>
                    </div>
                    <span class="rank-next-name">Cabo · 7 dias consecutivos</span>
                </div>
            </article>
        </section>

        <section class="dashboard-main-grid">

            <div class="panel dashboard-tasks-panel">
                <div class="panel-heading">
                    <div>
                        <span class="section-eyebrow">ORGANIZAÇÃO</span>
                        <h3>Atividades de hoje</h3>
                        <p class="panel-subtitle">Mantenha o ritmo e avance nas suas metas.</p>
                    </div>

                    <a href="{{ route('nexus.rotina') }}" wire:navigate class="text-link">
                        Ver rotina <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>

                <div class="task-progress-summary">
                    <div>
                        <strong id="task-progress-text">{{ $progresso }}% concluído</strong>
                        <span>do planejamento diário</span>
                    </div>
                    <span class="task-count" id="task-count">{{ $atividadesConcluidas }}/{{ $totalAtividades }}</span>
                </div>

                <div class="progress-track task-main-progress">
                    <div
                        class="progress-fill"
                        id="task-main-progress-fill"
                        style="width: {{ $progresso }}%"
                    ></div>
                </div>

                <div class="dashboard-task-list" id="dashboard-task-list">
                    @foreach ($atividades as $indice => $atividade)
                        <label class="dashboard-task {{ $atividade['concluida'] ? 'is-completed' : '' }}">
                            <input
                                type="checkbox"
                                class="task-checkbox"
                                {{ $atividade['concluida'] ? 'checked' : '' }}
                                onchange="toggleDashboardTask(this)"
                                aria-label="Concluir {{ $atividade['titulo'] }}"
                            >

                            <span class="task-check-visual">
                                <i class="bi bi-check2"></i>
                            </span>

                            <span class="task-icon">
                                <i class="bi {{ $atividade['icone'] }}"></i>
                            </span>

                            <span class="task-content">
                                <span class="task-title">{{ $atividade['titulo'] }}</span>
                                <span class="task-category">{{ $atividade['categoria'] }}</span>
                            </span>

                            <span class="task-time">
                                <i class="bi bi-clock"></i>
                                {{ $atividade['horario'] }}
                            </span>
                        </label>
                    @endforeach
                </div>

                <a href="{{ route('nexus.rotina') }}" wire:navigate class="add-task-link">
                    <i class="bi bi-plus-lg"></i>
                    Organizar minha rotina
                </a>
            </div>

            <div class="dashboard-side-column">

                

            </div>
        </section>

        <footer class="dashboard-footer">
            <span><i class="bi bi-circle-fill"></i> Seu progresso começa com uma ação.</span>
            <span>NEXUS · ORGANIZE SUA EVOLUÇÃO</span>
        </footer>

    </div>

    <script>
        if (!window.nexusDashboardTasksReady) {
            window.nexusDashboardTasksReady = true;

            window.toggleDashboardTask = function (checkbox) {
                const task = checkbox.closest('.dashboard-task');
                const list = document.getElementById('dashboard-task-list');

                if (!task || !list) return;

                task.classList.toggle('is-completed', checkbox.checked);

                const checkboxes = list.querySelectorAll('.task-checkbox');
                const total = checkboxes.length;
                const completed = list.querySelectorAll('.task-checkbox:checked').length;
                const percentage = total > 0 ? Math.round((completed / total) * 100) : 0;

                const completedCount = document.getElementById('completed-count');
                const taskCount = document.getElementById('task-count');
                const taskProgressText = document.getElementById('task-progress-text');
                const dashboardProgress = document.getElementById('dashboard-progress');
                const mainProgress = document.getElementById('task-main-progress-fill');

                if (completedCount) {
                    completedCount.innerHTML = `${completed}<span class="stat-total">/${total}</span>`;
                }

                if (taskCount) taskCount.textContent = `${completed}/${total}`;
                if (taskProgressText) taskProgressText.textContent = `${percentage}% concluído`;
                if (dashboardProgress) dashboardProgress.style.width = `${percentage}%`;
                if (mainProgress) mainProgress.style.width = `${percentage}%`;
            };
        }
    </script>
@endsection
