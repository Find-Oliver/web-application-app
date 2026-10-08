<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Employee Management System</title>
    <style>
        :root {
            --primary: #0f766e;
            --primary-dark: #115e59;
            --primary-soft: #e7f9f7;
            --sidebar-bg: #0f172a;
            --sidebar-muted: #94a3b8;
            --sidebar-text: #dfe7f3;
            --sidebar-text-active: #ffffff;
            --sidebar-hover: #162437;
            --panel: #ffffff;
            --panel-border: #dfe7f1;
            --bg: #f3f6fb;
            --bg-strong: #edf3f9;
            --text: #0f172a;
            --muted: #66758a;
            --success: #047857;
            --success-soft: #eafaf3;
            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --warning: #c97706;
            --warning-soft: #fff7ed;
            --info: #2563eb;
            --info-soft: #edf4ff;
            --shadow: 0 16px 32px rgba(15, 23, 42, 0.08);
            --radius-lg: 18px;
            --radius-md: 12px;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            min-height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        body {
            display: flex;
        }

        .sidebar {
            width: 264px;
            min-height: 100vh;
            background: linear-gradient(180deg, #0f172a 0%, #111c2f 100%);
            color: var(--sidebar-text);
            padding: 20px 14px 24px;
            position: sticky;
            top: 0;
            border-right: 1px solid rgba(148, 163, 184, 0.15);
            box-shadow: inset -1px 0 0 rgba(255,255,255,0.04);
        }

        .mobile-nav-toggle {
            display: none;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border: 1px solid var(--panel-border);
            border-radius: 8px;
            background: var(--panel);
            color: var(--text);
            font: inherit;
            font-weight: 600;
            cursor: pointer;
        }

        .sidebar-backdrop {
            display: none;
        }

        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
            padding: 14px 12px 18px;
            border-radius: 14px;
            background: rgba(148, 163, 184, 0.04);
            border: 1px solid rgba(148, 163, 184, 0.08);
        }

        .brand img {
            display: block;
            width: 185px;
            max-width: 100%;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 10px 20px rgba(15, 118, 110, 0.18));
        }

        .nav-group {
            display: grid;
            gap: 6px;
        }

        .nav-label {
            display: block;
            margin: 18px 12px 8px;
            font-size: 11px;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: var(--sidebar-muted);
            font-weight: 700;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 12px;
            border-radius: 10px;
            text-decoration: none;
            color: var(--sidebar-text);
            font-weight: 600;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            background: rgba(148, 163, 184, 0.08);
            color: var(--sidebar-text-active);
            transform: translateX(1px);
        }

        .nav-link.active {
            background: rgba(15, 118, 110, 0.14);
            color: var(--sidebar-text-active);
            border-left-color: var(--primary);
            box-shadow: inset 0 0 0 1px rgba(15,118,110,0.1);
        }

        .main-panel {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--panel-border);
            padding: 18px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 20;
            box-shadow: 0 1px 0 rgba(15, 23, 42, 0.04);
        }

        .page-header-tag {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            border: 1px solid var(--panel-border);
            border-radius: 999px;
            padding: 8px 12px;
            font-weight: 600;
            color: var(--text);
        }

        .role-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: var(--primary-dark);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .role-badge.admin {
            background: rgba(168, 85, 247, 0.12);
            color: #7c3aed;
        }

        .btn-logout {
            padding: 10px 16px;
            background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 8px 16px rgba(220, 38, 38, 0.12);
        }

        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 28px 24px 48px;
        }

        .page-header {
            margin-bottom: 24px;
            padding: 0;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 8px;
            color: var(--text);
            letter-spacing: -0.04em;
        }

        .page-subtitle {
            font-size: 0.95rem;
            color: var(--muted);
            line-height: 1.6;
        }

        .card,
        .table-card,
        .invite-card {
            background: var(--panel);
            border: 1px solid var(--panel-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .card-body {
            padding: 24px;
        }

        .btn-primary,
        .btn-secondary,
        .btn-danger,
        .btn-warning {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid transparent;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            box-shadow: 0 10px 18px rgba(15, 118, 110, 0.12);
        }
        .btn-primary:hover { background: var(--primary-dark); }

        .btn-secondary {
            background: #fff;
            border-color: var(--panel-border);
            color: var(--text);
        }
        .btn-secondary:hover { background: #f8fafc; }

        .btn-danger {
            background: var(--danger-soft);
            border-color: #fecaca;
            color: #b91c1c;
        }
        .btn-danger:hover { background: #fee2e2; }

        .btn-warning {
            background: var(--warning-soft);
            border-color: #fde68a;
            color: #92400e;
        }
        .btn-warning:hover { background: #fef3c7; }

        .input,
        .employee-field input,
        .employee-field select,
        .employee-field textarea,
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            min-height: 42px;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #dfe5ec;
            background: #fff;
            color: var(--text);
            font: inherit;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .input:focus,
        .employee-field input:focus,
        .employee-field select:focus,
        .employee-field textarea:focus,
        textarea:focus,
        select:focus,
        input:focus {
            outline: none;
            border-color: rgba(241, 96, 36, 0.6);
            box-shadow: 0 0 0 4px rgba(241, 96, 36, 0.08);
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: inline-block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
        }

        .form-error {
            margin-top: 6px;
            color: var(--danger);
            font-size: 12px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.01em;
        }

        .status-badge.success,
        .status-active,
        .status-badge.status-active {
            background: var(--success-soft);
            color: var(--success);
        }

        .status-badge.warning,
        .status-badge.status-inactive,
        .status-badge.inactive {
            background: var(--warning-soft);
            color: var(--warning);
        }

        .status-badge.danger,
        .status-badge.terminated {
            background: var(--danger-soft);
            color: var(--danger);
        }

        .status-badge.info {
            background: var(--info-soft);
            color: var(--info);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
            background: #f8fafc;
            padding: 14px 16px;
            border-bottom: 1px solid var(--panel-border);
        }

        tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--panel-border);
            vertical-align: middle;
            color: var(--text);
        }

        tbody tr:hover {
            background: rgba(248, 250, 252, 0.7);
        }

        .pagination {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border: 1px solid var(--panel-border);
            border-radius: 8px;
            background: #fff;
            color: var(--text);
            text-decoration: none;
            font-size: 13px;
        }

        .pagination .active span {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .alert {
            padding: 15px 16px;
            border-radius: 12px;
            margin-bottom: 22px;
            display: flex;
            gap: 10px;
            align-items: center;
            border-left: 4px solid transparent;
            font-weight: 600;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.04);
        }

        .alert-success {
            background-color: #eafaf3;
            border-left-color: var(--success);
            color: #166534;
        }

        .alert-error {
            background-color: #fef2f2;
            border-left-color: var(--danger);
            color: #991b1b;
        }

        .alert-warning {
            background-color: #fff7ed;
            border-left-color: var(--warning);
            color: #92400e;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--panel);
            border: 1px solid var(--panel-border);
            border-left-width: 5px;
            border-radius: var(--radius-md);
            padding: 20px 18px;
            box-shadow: var(--shadow);
        }

        .stat-label {
            font-size: 12px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.04em;
        }

        .stat-change {
            font-size: 12px;
            color: var(--success);
            font-weight: 600;
        }

        .menu-section {
            background: var(--panel);
            border: 1px solid var(--panel-border);
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
        }

        .menu-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .menu-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 10px;
        }

        .menu-link {
            display: block;
            padding: 12px 15px;
            background: #f7fafc;
            border: 1px solid var(--panel-border);
            border-radius: 10px;
            text-decoration: none;
            color: var(--primary-dark);
            font-weight: 700;
            text-align: center;
            transition: all 0.2s ease;
        }

        .menu-link:hover {
            background: #edf8f7;
            border-color: rgba(15, 118, 110, 0.25);
            transform: translateY(-1px);
        }

        @media (max-width: 900px) {
            body {
                display: block;
            }

            .sidebar {
                position: fixed;
                inset: 0 auto 0 0;
                z-index: 40;
                width: min(280px, calc(100vw - 48px));
                min-height: 100vh;
                overflow-y: auto;
                transform: translateX(-100%);
                transition: transform 0.2s ease;
            }

            .sidebar.is-open {
                transform: translateX(0);
            }

            .sidebar-backdrop {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 30;
                border: 0;
                background: rgba(17, 24, 39, 0.55);
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.2s ease, visibility 0.2s ease;
            }

            .sidebar-backdrop.is-visible {
                opacity: 1;
                visibility: visible;
            }

            .mobile-nav-toggle {
                display: inline-flex;
            }

            .topbar {
                padding: 16px 18px;
            }

            .content {
                padding: 20px 16px 30px;
            }
        }

        @media (max-width: 600px) {
            .topbar {
                align-items: flex-start;
                gap: 12px;
                flex-wrap: wrap;
            }

            .topbar-user {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .user-pill {
                min-width: 0;
                max-width: 100%;
                flex-wrap: wrap;
                border-radius: 8px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .sidebar,
            .sidebar-backdrop {
                transition: none;
            }
        }
    </style>
</head>
<body>
    @auth
        <aside class="sidebar" id="app-sidebar">
            <div class="brand">
                <img src="{{ asset('images/emsLogo.png') }}" alt="EMS Logo" style="width: 190px; height: auto; object-fit: contain; display: block;">
            </div>

            <nav class="nav-group">
                <span class="nav-label">Main</span>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>

                @if (Auth::user()->isAdmin())
                    <span class="nav-label">Administration</span>
                    <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">Employees</a>
                    <a href="{{ route('attendance.index') }}" class="nav-link {{ request()->routeIs('attendance.*') ? 'active' : '' }}">Attendance</a>
                    <a href="{{ route('departments.index') }}" class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">Departments</a>
                    <a href="{{ route('positions.index') }}" class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}">Positions</a>
                    <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">Roles</a>
                @endif
            </nav>
        </aside>
        <button class="sidebar-backdrop" type="button" aria-label="Close navigation" tabindex="-1"></button>
    @endauth

    <main class="main-panel">
        @auth
            <header class="topbar">
                <button class="mobile-nav-toggle" type="button" aria-controls="app-sidebar" aria-expanded="false">
                    <span aria-hidden="true">&#9776;</span>
                    <span>Menu</span>
                </button>
                <div class="page-header-tag">Employee Management System</div>
                <div class="topbar-user">
                    <div class="user-pill">
                        <span>{{ Auth::user()->name }}</span>
                        <span class="role-badge {{ Auth::user()->isAdmin() ? 'admin' : '' }}">
                            {{ Auth::user()->role?->role_name ?? 'No Role' }}
                        </span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-logout">Logout</button>
                    </form>
                </div>
            </header>
        @endauth

        <div class="content">
            @if (session('success'))
                <div class="alert alert-success">
                    <span>✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    <span>✗</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning">
                    <span>!</span>
                    <span>{{ session('warning') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
    @auth
        <script>
            (() => {
                const sidebar = document.getElementById('app-sidebar');
                const toggle = document.querySelector('.mobile-nav-toggle');
                const backdrop = document.querySelector('.sidebar-backdrop');

                if (!sidebar || !toggle || !backdrop) return;

                const closeSidebar = (restoreFocus = false) => {
                    sidebar.classList.remove('is-open');
                    backdrop.classList.remove('is-visible');
                    toggle.setAttribute('aria-expanded', 'false');
                    if (restoreFocus) toggle.focus();
                };

                toggle.addEventListener('click', () => {
                    const isOpen = sidebar.classList.toggle('is-open');
                    backdrop.classList.toggle('is-visible', isOpen);
                    toggle.setAttribute('aria-expanded', String(isOpen));
                    if (isOpen) sidebar.querySelector('a')?.focus();
                });

                backdrop.addEventListener('click', () => closeSidebar(true));
                sidebar.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => closeSidebar()));
                document.addEventListener('keydown', (event) => {
                    if (!sidebar.classList.contains('is-open')) return;

                    if (event.key === 'Escape') {
                        closeSidebar(true);
                        return;
                    }

                    if (event.key === 'Tab') {
                        const links = sidebar.querySelectorAll('a');
                        const firstLink = links[0];
                        const lastLink = links[links.length - 1];

                        if (event.shiftKey && document.activeElement === firstLink) {
                            event.preventDefault();
                            lastLink.focus();
                        } else if (!event.shiftKey && document.activeElement === lastLink) {
                            event.preventDefault();
                            firstLink.focus();
                        }
                    }
                });
                window.addEventListener('resize', () => {
                    if (window.innerWidth > 900) closeSidebar();
                });
            })();
        </script>
    @endauth
</body>
</html>

