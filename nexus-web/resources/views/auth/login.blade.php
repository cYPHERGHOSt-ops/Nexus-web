
<x-guest-layout>

    <h5 class="mb-4 text-center">Entrar na sua conta</h5>

    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>

            <input
                type="email"
                name="email"
                id="email"
                class="form-control"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
            >

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>

            <input
                type="password"
                name="password"
                id="password"
                class="form-control"
                required
                autocomplete="current-password"
            >

            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <label class="d-flex align-items-center gap-2">
                <input type="checkbox" name="remember" class="form-check-input m-0">
                <span class="small text-secondary">Lembrar de mim</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link small" wire:navigate>
                    Esqueci minha senha
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-borus w-100 py-2">
            Entrar
        </button>

        @if (Route::has('register'))
            <p class="text-center text-secondary small mt-4 mb-0">
                Não possui uma conta?
                <a href="{{ route('register') }}"  class="auth-link fw-semibold" wire:navigate>
                    Criar conta
                </a>
            </p>
        @endif
    </form>

</x-guest-layout>
