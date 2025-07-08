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
            margin: 0;
            height: 100vh;
        }

        nav.sidebar {
            width: 260px;
            height: 100vh;
            background: #7CB77B;
            position: fixed;
            top: 0;
            left: 0;
            color: white;
            z-index: 1040;
            display: flex;
            flex-direction: column;
        }

        nav.sidebar .sidebar-header {
            padding: 1rem;
            flex-shrink: 0;
        }

        nav.sidebar .sidebar-menu {
            flex: 1 1 auto;
            overflow-y: auto;
            padding: 0 1rem;
        }

        nav.sidebar .sidebar-footer {
            flex-shrink: 0;
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
        }

        main.content {
            margin-left: 260px;
            padding: 2rem 2.5rem;
            background-color: white;
            min-height: 100vh;
            box-shadow: 0 0 15px rgb(0 0 0 / 0.1);
            color: #3E3E3E;
            transition: margin-left 0.3s ease;
        }

        main.content h1 {
            font-weight: 700;
            color: #D97904;
        }

        .btn-outline-danger {
            border-color: #D97904;
            color: #D97904;
        }

        .btn-outline-danger:hover {
            background-color: #D97904;
            color: white;
        }

        /* Menu links e submenu */

        nav.sidebar ul.nav {
            padding-left: 0;
            list-style: none;
            margin: 0;
        }

        nav.sidebar ul.nav > li {
            margin-bottom: 1.5rem;
        }

        nav.sidebar ul.nav > li > span.menu-title {
            font-weight: 600;
            padding-left: 1rem;
            display: block;
            margin-bottom: 0.5rem;
            cursor: default;
        }

        nav.sidebar ul.submenu {
            padding-left: 1.5rem;
            margin: 0;
        }

        nav.sidebar ul.submenu li {
            margin-bottom: 0.5rem;
        }

        nav.sidebar a.nav-link {
            color: white;
            text-decoration: none;
            display: block;
            padding-left: 0.5rem;
        }

        nav.sidebar a.nav-link:hover {
            color: #D97904;
        }

        @media (max-width: 992px) {
            nav.sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
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

    <button class="sidebar-toggle-btn d-lg-none" aria-label="Toggle sidebar">
        <i class="bi bi-list fs-3"></i>
    </button>

    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('tutor.dashboard') }}" class="d-flex align-items-center text-decoration-none text-white">
                <span class="fs-3 fw-bold">🐾 PetMatch</span>
            </a>
        </div>

        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li>
                    <span class="menu-title">Meus Pets</span>
                    <ul class="submenu nav flex-column">
                        <li>
                            <a href="{{ route('tutor.pets.create') }}" class="nav-link">➕ Cadastrar Pet</a>
                        </li>
                        <li>
                            <a href="{{ route('tutor.pets.index') }}" class="nav-link">📋 Ver Pets</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <span class="menu-title">Feed</span>
                    <ul class="submenu nav flex-column">
                        <li>
                            <a href="{{ route('tutor.postagens.create') }}" class="nav-link">📝 Criar Postagem</a>
                        </li>
                        <li>
                            <a href="{{ route('tutor.postagens.index') }}" class="nav-link">📄 Ver Feed</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('tutor.matches.index') }}" class="nav-link d-flex align-items-center">
                        <i class="bi bi-search-heart me-2"></i> Descobrir Pets
                    </a>
                </li>

                <li>
                    <a href="{{ route('tutor.eventos.index') }}" class="nav-link d-flex align-items-center">
                        <i class="bi bi-calendar-event me-2"></i> Eventos
                    </a>
                </li>

                <li>
                    <a href="{{ route('tutor.chats.index') }}" class="nav-link d-flex align-items-center">
                        <i class="bi bi-chat-dots me-2"></i> Chat
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
                    <i class="bi bi-box-arrow-right me-1"></i> Sair
                </button>
            </form>
        </div>
    </nav>

    <main class="content">
        <h1 class="mb-4">@yield('title')</h1>
        @yield('content')
    </main>

    <script>
        const sidebarToggle = document.querySelector('.sidebar-toggle-btn');
        const sidebar = document.querySelector('nav.sidebar');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });
    </script>

</body>

</html>
