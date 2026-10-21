
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Nexus') — Nexus</title>

    @vite(['resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="nexus-layout">
        <aside class="sidebar" id="sidebar">
            <a href="{{ route('nexus.dashboard') }}" class="brand">
                <span class="brand-icon"><i class="bi bi-command"></i></span>
                <span>NEXUS</span>
            </a>

            <div class="menu-label">MENU PRINCIPAL</div>

            <nav class="sidebar-nav">
                <a wire:navigate href="{{ route('nexus.dashboard') }}"
                   class="nav-link-nexus {{ request()->routeIs('nexus.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i><span>Dashboard</span>
                </a>

                <a wire:navigate href="{{ route('nexus.rotina') }}"
                   class="nav-link-nexus {{ request()->routeIs('nexus.rotina') ? 'active' : '' }}">
                    <i class="bi bi-check2-square"></i><span>Rotina</span>
                </a>

                <a wire:navigate href="{{ route('nexus.treinos') }}"
                   class="nav-link-nexus {{ request()->routeIs('nexus.treinos') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i><span>Treinos</span>
                </a>

                <a wire:navigate href="{{ route('nexus.financas') }}"
                   class="nav-link-nexus {{ request()->routeIs('nexus.financas') ? 'active' : '' }}">
                    <i class="bi bi-wallet2"></i><span>Finanças</span>
                </a>
            </nav>

            <div class="sidebar-bottom">
                <a wire:navigate href="{{ route('nexus.perfil') }}"
                   class="nav-link-nexus {{ request()->routeIs('nexus.perfil') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i><span>Meu perfil</span>
                </a>

                <div class="sidebar-version">
                    <span class="status-dot"></span>
                    Nexus Web
                    <span class="version-number">v1.0</span>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <button class="mobile-menu" id="menuToggle"
                        aria-label="Abrir menu">
                    <i class="bi bi-list"></i>
                </button>

                <div class="topbar-heading">
                    <span class="topbar-label">ESPAÇO PESSOAL</span>
                    <h1>@yield('heading', 'Dashboard')</h1>
                </div>

                <div class="topbar-date">
                    <i class="bi bi-calendar3"></i>
                    <span>{{ now()->translatedFormat('d \d\e F') }}</span>
                </div>
            </header>

            <section class="page-content">
                @yield('content')
            </section>
        </main>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menuToggle');
        const overlay = document.getElementById('sidebarOverlay');

        function toggleMenu() {
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('overlay-visible');
        }

        menuToggle.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);
    </script>
    @livewireScripts
</body>
</html>
