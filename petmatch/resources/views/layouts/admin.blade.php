<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') - Admin - PetMatch</title>

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
            background: #4A7C59; 
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
                background-color: #4A7C59;
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
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none text-white">
                <span class="fs-3 fw-bold">🐾 PetMatch Admin</span>
            </a>
        </div>

        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li>
                    <span class="menu-title">Gestão de Usuários</span>
                    <ul class="submenu nav flex-column">
                        <li><a href="{{ route('admin.usuarios.index') }}" class="nav-link">👥 Listar Usuários</a></li>
                    </ul>
                </li>

                <li>
                    <span class="menu-title">Gestão de Pets</span>
                    <ul class="submenu nav flex-column">
                        <li><a href="{{ route('admin.pets.index') }}" class="nav-link">📋 Listar Pets</a></li>
                    </ul>
                </li>

                <li>
                    <span class="menu-title">Postagens</span>
                    <ul class="submenu nav flex-column">
                        <li><a href="{{ route('admin.postagens.index') }}" class="nav-link">📄 Listar Postagens</a></li>
                        <li><a href="{{ route('admin.postagens.create') }}" class="nav-link">📝 Criar Postagem</a></li>
                    </ul>
                </li>

                <li>
                    <span class="menu-title">Eventos</span>
                    <ul class="submenu nav flex-column">
                        <li><a href="{{ route('admin.eventos.index') }}" class="nav-link">📅 Listar Eventos</a></li>
                        <li><a href="{{ route('admin.eventos.create') }}" class="nav-link">➕ Criar Evento</a></li>
                    </ul>
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
