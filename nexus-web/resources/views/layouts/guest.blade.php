
<!DOCTYPE html>
<html lang="pt-BR">
<head>

@livewireStyles

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Borus | Autenticação</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonte do título -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manufacturing+Consent&display=swap" rel="stylesheet">

    <style>
        body {
            background: #090909;
            color: #fff;
            overflow-x: hidden;
        }

        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 40px 8%;
            position: relative;
            overflow: hidden;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 2;
        }

        .borus-title {
            font-family: 'Manufacturing Consent', serif;
            font-size: 78px;
            line-height: 1;
            letter-spacing: 2px;
        }

        .ouroboros {
            position: absolute;
            width: min(65vw, 850px);
            right: -130px;
            bottom: -180px;
            opacity: 0.65;
            filter: invert(1);
            mix-blend-mode: screen;
            pointer-events: none;
            user-select: none;
        }

        .form-control {
            background: #202020;
            border: 1px solid #333;
            color: #fff;
        }

        .form-control:focus {
            background: #202020;
            color: #fff;
            border-color: #777;
            box-shadow: none;
        }

        .btn-borus {
            background: #fff;
            color: #000;
            font-weight: 600;
        }

        .btn-borus:hover {
            background: #d8d8d8;
            color: #000;
        }

        .auth-link {
            color: #aaa;
            text-decoration: none;
        }

        .auth-link:hover {
            color: #fff;
        }

        @media (max-width: 768px) {
            .auth-page {
                justify-content: center;
                padding: 30px 20px;
            }

            .ouroboros {
                width: 500px;
                right: -300px;
                bottom: -130px;
                opacity: 0.15;
            }

            .borus-title {
                font-size: 64px;
            }
        }
    </style>
</head>

<body>
   <main class="auth-page" style="height: 100vh; padding: 10px 8%;">

        <div class="auth-card">
            <div class="mb-5">
                <h1 class="borus-title mb-2">Borus</h1>
                <p class="text-secondary">
                    Organize. Evolua. Conquiste.
                </p>
            </div>

            {{ $slot }}
        </div>

        <!-- Ouroboros decorativo -->
        <img
            src="{{ asset('images/borus.png') }}"
            alt=""
            class="ouroboros"
            aria-hidden="true"
        >

    </main>

@livewireScripts

</body>
</html>
