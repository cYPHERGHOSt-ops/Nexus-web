
<x-guest-layout>

    <h5 class="mb-4">Criar minha conta</h5>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name') }}" required autofocus
                   autocomplete="name">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required
                   autocomplete="username">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="password" class="form-control"
                   required autocomplete="new-password">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Confirmar senha</label>
            <input type="password" name="password_confirmation"
                   class="form-control" required
                   autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-borus w-100 py-2">
            Criar conta
        </button>

        <p class="text-center text-secondary small mt-4 mb-0">
            Já possui uma conta?
            <a href="{{ route('login') }}" class="auth-link" wire:navigate>
                Entrar
            </a>
        </p>
    </form>

</x-guest-layout>
