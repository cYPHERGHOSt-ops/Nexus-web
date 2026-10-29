
<x-guest-layout>

    <h5 class="mb-3">Recuperar senha</h5>

    <p class="text-secondary mb-4">
        Informe seu e-mail e enviaremos um link para redefinir sua senha.
    </p>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required autofocus>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-borus w-100 py-2">
            Enviar link
        </button>

        <p class="text-center mt-4 mb-0">
            <a href="{{ route('login') }}" class="auth-link" wire:navigate>
                Voltar ao login
            </a>
        </p>
    </form>

</x-guest-layout>
