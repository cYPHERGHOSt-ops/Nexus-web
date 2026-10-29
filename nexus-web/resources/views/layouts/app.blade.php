
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Borus')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @livewireStyles

    <style>
        body {
            background: #090909;
            color: #fff;
            min-height: 100vh;
        }

        .borus-nav {
            background: #141414;
            border-bottom: 1px solid #292929;
        }

        .borus-nav a {
            color: #aaa;
            text-decoration: none;
        }

        .borus-nav a:hover,
        .borus-nav a.active {
            color: #fff;
        }

        .borus-content {
            max-width: 1200px;
            margin: auto;
            padding: 30px 20px;
        }
    </style>
</head>

<body>

    <nav class="borus-nav px-4 py-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <a href="{{ route('dashboard') }}" class="fw-bold text-white" wire:navigate>
                BORUS
            </a>

            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('dashboard') }}" wire:navigate>Dashboard</a>
                <a href="{{ route('nexus.rotina') }}" wire:navigate>Rotina</a>
                <a href="{{ route('nexus.financas') }}" wire:navigate>Finanças</a>
                <a href="{{ route('nexus.perfil') }}" wire:navigate>Perfil</a>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light">
                    Sair
                </button>
            </form>

        </div>
    </nav>
    
    {{-- Conteúdo da página --}}
    <main class="borus-content">
        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </main>

    @livewireScripts

</body>
</html>
