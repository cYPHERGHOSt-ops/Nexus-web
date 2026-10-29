
@extends('layouts.app')

@section('title', 'Perfil | Borus')

@section('content')

<div class="perfil borus-dragon-bg">

    <!-- Cabeçalho -->
    <div class="perfil-header">
        <div>
            <span class="perfil-eyebrow">CONFIGURAÇÕES DA CONTA</span>
            <h1>Meu perfil<span class="perfil-dot">.</span></h1>
            <p>Gerencie suas informações e segurança.</p>
        </div>
    </div>

    <!-- Identificação -->
    <section class="perfil-card perfil-identity">
        <div class="perfil-avatar">
            <i class="bi bi-person"></i>
        </div>

        <div>
            <h2>{{ auth()->user()->name }}</h2>
            <p>{{ auth()->user()->email }}</p>
            <small>Conta Borus</small>
        </div>
    </section>

    <div class="row g-3 mt-1">

        <!-- Dados pessoais -->
        <div class="col-12 col-lg-6">
            <section class="perfil-card h-100">

                <div class="perfil-section-heading">
                    <i class="bi bi-person-gear"></i>
                    <h2>Informações pessoais</h2>
                </div>

                <p class="perfil-description">
                    Atualize seu nome e endereço de e-mail.
                </p>

                @if(session('status') === 'profile-updated')
                    <p class="perfil-success">Perfil atualizado com sucesso!</p>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="perfil-field">
                        <label for="name">Nome</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            class="form-control perfil-input"
                            value="{{ old('name', auth()->user()->name) }}"
                            required
                            maxlength="255"
                        >
                        @error('name')
                            <small class="perfil-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="perfil-field">
                        <label for="email">E-mail</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="form-control perfil-input"
                            value="{{ old('email', auth()->user()->email) }}"
                            required
                        >
                        @error('email')
                            <small class="perfil-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="perfil-submit">
                        <i class="bi bi-check2"></i>
                        Salvar alterações
                    </button>

                </form>
            </section>
        </div>

        <!-- Segurança -->
        <div class="col-12 col-lg-6">
            <section class="perfil-card h-100">

                <div class="perfil-section-heading">
                    <i class="bi bi-shield-lock"></i>
                    <h2>Segurança</h2>
                </div>

                <p class="perfil-description">
                    Altere sua senha de acesso.
                </p>

                @if(session('status') === 'password-updated')
                    <p class="perfil-success">Senha alterada com sucesso!</p>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="perfil-field">
                        <label for="current_password">Senha atual</label>
                        <input
                            id="current_password"
                            name="current_password"
                            type="password"
                            class="form-control perfil-input"
                            autocomplete="current-password"
                            required
                        >
                        @error('current_password', 'updatePassword')
                            <small class="perfil-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="perfil-field">
                        <label for="password">Nova senha</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="form-control perfil-input"
                            autocomplete="new-password"
                            required
                        >
                        @error('password', 'updatePassword')
                            <small class="perfil-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="perfil-field">
                        <label for="password_confirmation">Confirmar senha</label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="form-control perfil-input"
                            autocomplete="new-password"
                            required
                        >
                    </div>

                    <button type="submit" class="perfil-submit">
                        <i class="bi bi-lock"></i>
                        Atualizar senha
                    </button>

                </form>
            </section>
        </div>

    </div>

</div>

@endsection


@push('styles')
<style>
.perfil {
    max-width: 1400px;
    margin: 0 auto;
}

/* Cabeçalho */
.perfil-header {
    margin-bottom: 32px;
}

.perfil-eyebrow {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 2px;
    color: #777;
}

.perfil-header h1 {
    font-size: 34px;
    font-weight: 700;
    letter-spacing: -1px;
    margin: 8px 0;
}

.perfil-dot {
    color: #888;
}

.perfil-header p {
    color: #888;
    margin: 0;
}

/* Cartões */
.perfil-card {
    background: #171717;
    border: 1px solid #303030;
    border-radius: 16px;
    padding: 24px;
}

.perfil-identity {
    display: flex;
    align-items: center;
    gap: 20px;
}

.perfil-avatar {
    width: 76px;
    height: 76px;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    border-radius: 50%;
    background: #292929;
    color: #ddd;
    font-size: 36px;
}

.perfil-identity h2 {
    font-size: 21px;
    font-weight: 600;
    margin-bottom: 5px;
}

.perfil-identity p {
    color: #aaa;
    margin-bottom: 5px;
    overflow-wrap: anywhere;
}

.perfil-identity small {
    color: #777;
}

/* Seções */
.perfil-section-heading {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
}

.perfil-section-heading i {
    font-size: 21px;
    color: #aaa;
}

.perfil-section-heading h2 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.perfil-description {
    font-size: 13px;
    color: #888;
    margin-bottom: 24px;
}

/* Formulários */
.perfil-field {
    margin-bottom: 18px;
}

.perfil-field label {
    display: block;
    font-size: 13px;
    color: #aaa;
    margin-bottom: 8px;
}

.perfil-input,
.perfil-input:focus {
    background: #222;
    border: 1px solid #383838;
    border-radius: 9px;
    color: white;
    padding: 11px 13px;
    box-shadow: none;
}

.perfil-input:focus {
    border-color: #888;
}

.perfil-submit {
    width: 100%;
    background: #f0f0f0;
    color: #111;
    border: none;
    border-radius: 9px;
    padding: 12px;
    font-size: 14px;
    font-weight: 600;
    transition: background .2s;
}

.perfil-submit:hover {
    background: #ccc;
}

/* Mensagens */
.perfil-success {
    color: #8dd7a0;
    background: #16251b;
    border: 1px solid #2a5035;
    padding: 10px 12px;
    border-radius: 8px;
    font-size: 13px;
}

.perfil-error {
    display: block;
    color: #ff8888;
    margin-top: 6px;
}

@media (max-width: 768px) {
    .perfil-header h1 {
        font-size: 28px;
    }

    .perfil-card {
        padding: 20px;
    }

    .perfil-avatar {
        width: 60px;
        height: 60px;
        font-size: 28px;
    }
}
</style>
@endpush
