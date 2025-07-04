<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') - Tutor - PetMatch</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #FAF3E0;
        }

        nav.sidebar {
            width: 260px;
            min-height: 100vh;
            background: #7CB77B;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 1rem;
            transition: transform 0.3s ease;
            z-index: 1040;
            color: white;
        }

        nav.sidebar a.nav-link {
            color: white;
            font-weight: 600;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        nav.sidebar a.nav-link:hover,
        nav.sidebar a.nav-link.active {
            background-color: #5A945A;
            color: #FFF !important;
            border-radius: 0.25rem;
        }

        nav.sidebar .nav-link .bi {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .nav-link.collapsed > .bi-caret-down-fill {
            transform: rotate(-90deg);
            transition: transform 0.2s ease;
        }

        .nav-link:not(.collapsed) > .bi-caret-down-fill {
            transform: rotate(0deg);
        }

        nav.sidebar hr {
            border-color: rgba(255, 255, 255, 0.3);
        }

        main.content {
            margin-left: 260px;
            padding: 2rem 2.5rem;
            background-color: white;
            min-height: 100vh;
            box-shadow: 0 0 15px rgb(0 0 0 / 0.1);
            transition: margin-left 0.3s ease;
            color: #3E3E3E;
        }

        main.content h1 {
            font-weight: 700;
            color: #D97904; /* laranja terroso */
        }

        .btn-outline-danger {
            border-color: #D97904;
            color: #D97904;
        }

        .btn-outline-danger:hover {
            background-color: #D97904;
            color: white;
        }

        @media (max-width: 992px) {
            nav.sidebar {
                position: fixed;
                height: 100%;
                z-index: 1050;
                transform: translateX(-100%);
            }

            nav.sidebar.show {
                transform: translateX(0);
            }

            main.content {
                margin-left: 0;
                padding: 1rem;
            }

            .sidebar-toggle-btn {
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1100;
                background-color: #7CB77B;
                border: none;
                color: white;
                padding: 0.4rem 0.6rem;
                border-radius: 0.25rem;
            }
        }
    </style>
</head>

<body>
    <button class="sidebar-toggle-btn d-lg-none" aria-label="Toggle sidebar" style="background:#7CB77B; color:#fff;">
        <i class="bi bi-list fs-3"></i>
    </button>

    <nav class="sidebar d-flex flex-column p-3">
        <a href="{{ route('tutor.dashboard') }}" class="d-flex align-items-center mb-4 mb-md-0 text-decoration-none text-white">
            <span class="fs-3 fw-bold">🐾 PetMatch</span>
        </a>
        <hr />

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="mb-1">
                <a class="nav-link d-flex justify-content-between align-items-center collapsed" data-bs-toggle="collapse"
                    href="#submenuPets" role="button" aria-expanded="false" aria-controls="submenuPets">
                    <span><i class="bi bi-heart-pulse me-2"></i>Meus Pets</span>
                    <i class="bi bi-caret-down-fill"></i>
                </a>
                <div class="collapse ps-3" id="submenuPets">
                    <a href="{{ route('tutor.pets.create') }}" class="nav-link link-white">Cadastrar Pet</a>
                    <a href="{{ route('tutor.pets.index') }}" class="nav-link link-white">Listar Pets</a>
                </div>
            </li>

            <li class="mb-1">
                <a href="{{ route('tutor.matches.index') }}" class="nav-link link-white">
                    <i class="bi bi-search-heart me-2"></i>Descobrir Pets
                </a>
            </li>

            <li class="mb-1">
                <a class="nav-link d-flex justify-content-between align-items-center collapsed" data-bs-toggle="collapse"
                    href="#submenuFeed" role="button" aria-expanded="false" aria-controls="submenuFeed">
                    <span><i class="bi bi-card-text me-2"></i>Feed</span>
                    <i class="bi bi-caret-down-fill"></i>
                </a>
                <div class="collapse ps-3" id="submenuFeed">
                    <a href="{{ route('tutor.postagens.create') }}" class="nav-link link-white">Criar Postagem</a>
                    <a href="{{ route('tutor.postagens.index') }}" class="nav-link link-white">Ver Feed</a>
                </div>
            </li>

            <li class="mb-1">
                <a href="{{ route('tutor.eventos.index') }}" class="nav-link link-white">
                    <i class="bi bi-calendar-event me-2"></i>Eventos
                </a>
            </li>

            <li class="mb-1">
                <a href="{{ route('tutor.chats.index') }}" class="nav-link link-white">
                    <i class="bi bi-chat-dots me-2"></i>Chat
                </a>
            </li>

            <li class="mt-auto pt-3 border-top">
                <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                    @csrf
                    <button type="submit"
                        class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <main class="content">
        <h1 class="mb-4">@yield('title')</h1>
        @yield('content')
    </main>

    <script>
        document.querySelector('.sidebar-toggle-btn').addEventListener('click', () => {
            document.querySelector('nav.sidebar').classList.toggle('show');
        });
    </script>
</body>

</html>
