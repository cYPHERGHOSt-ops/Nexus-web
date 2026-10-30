<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Borus')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Fonte do título -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manufacturing+Consent&display=swap" rel="stylesheet">

    @livewireStyles
    @stack('styles')

    <style>
        body {
            background: #090909;
            color: white;
            margin: 0;
        }

        .borus-layout {
            display: flex;
            min-height: 100dvh;
        }

        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background: #111;
            border-right: 1px solid #292929;
            padding: 25px 16px;
            display: flex;
            flex-direction: column;
            gap: 25px;
            position: sticky;
            top: 0;
            height: 100dvh;
        }

        .sidebar .title {
            font-family: 'Manufacturing Consent', serif;
            font-size: 60px;
            font-weight: light;
            line-height: 1;
            padding-left: 12px;
            margin: 0;
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .sidebar nav a {
            color: #aaa;
            padding: 12px;
            border-radius: 9px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar nav a:hover,
        .sidebar nav a.active {
            background: #242424;
            color: white;
        }

        .sidebar .logout {
            margin-top: auto;
        }

        .borus-main {
            flex: 1;
            min-width: 0;
            padding: 30px;
        }

    
/* RESPONSIVIDADE */
@media (max-width: 768px) {
    .borus-layout {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        height: auto;
        position: static;
        padding: 15px;
        gap: 12px;
    }

    .sidebar nav {
        flex-direction: row;
        overflow-x: auto;
    }

    .sidebar nav a {
        white-space: nowrap;
    }

    .sidebar .logout {
        margin-top: 0;
    }

    .borus-main {
        padding: 20px 15px;
    }
}

/* DRAGÃO DE FUNDO */
.borus-dragon-bg {
    position: relative;
    isolation: isolate;
    height: 110vh;
}

.borus-dragon-bg::before {
    content: "";
    position: absolute;
    inset: 0;

    background-image: url('/images/borus.png');
    background-position: center;
    background-repeat: no-repeat;
    background-size: min(800px, 90%);

    opacity: 0.05;
    filter: invert(1);

    pointer-events: none;
    z-index: 0;
}

/* Conteúdo fica na frente do dragão */
.borus-dragon-bg > * {
    position: relative;
    z-index: 1;
}

        
    </style>
</head>

<body>
    <div class="borus-layout">

        <aside class="sidebar">

            <h4 class="title">Borus</h4>

            <nav>
                <a href="{{ route('dashboard') }}"
                    wire:navigate
                    class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i>
                    Dashboard
                </a>

                <a href="{{ route('nexus.rotina') }}"
                    wire:navigate
                    class="{{ request()->routeIs('nexus.rotina') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check"></i>
                    Rotina
                </a>

                <a href="{{ route('nexus.financas') }}"
                    wire:navigate
                    class="{{ request()->routeIs('nexus.financas') ? 'active' : '' }}">
                    <i class="bi bi-wallet2"></i>
                    Finanças
                </a>

                <a href="{{ route('nexus.perfil') }}"
                    wire:navigate
                    class="{{ request()->routeIs('nexus.perfil') ? 'active' : '' }}">
                    <i class="bi bi-person"></i>
                    Perfil
                </a>
            </nav>

            <form method="POST"
                action="{{ route('logout') }}"
                class="logout">
                @csrf

                <button type="submit" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-box-arrow-left me-2"></i>
                    Sair
                </button>
            </form>

        </aside>

        <main class="borus-main">

            @hasSection('heading')
            <h1 class="h3 mb-4">@yield('heading')</h1>
            @endif

            @isset($header)
            {{ $header }}
            @endisset

            @yield('content')

            @isset($slot)
            {{ $slot }}
            @endisset

        </main>

    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>