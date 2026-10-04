<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'EMS') · Employee Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #f3f5f8;
            --surface: #ffffff;
            --ink: #111827;
            --ink-soft: #64748b;
            --ink-faint: #94a3b8;
            --sidebar-bg: #0f172a;
            --sidebar-text: #94a3b8;
            --sidebar-text-active: #ffffff;
            --accent: #0d9488;
            --accent-dark: #0f766e;
            --accent-soft: #e6f6f4;
            --danger: #ef4444;
            --danger-soft: #fef2f2;
            --warning: #f59e0b;
            --warning-soft: #fffbeb;
            --border: #e5e9f0;
            --radius: 14px;
            --shadow: 0 1px 2px rgba(15, 23, 42, .04), 0 8px 24px -12px rgba(15, 23, 42, .10);
            font-family: 'Inter', -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body { background: var(--bg); color: var(--ink); font-size: 14.5px; line-height: 1.5; }

        h1, h2, h3, .brand { font-family: 'Poppins', 'Inter', sans-serif; }

        a { text-decoration: none; color: inherit; }

        .app-shell { display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: 248px;
            flex-shrink: 0;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            padding: 22px 14px;
            position: sticky;
            top: 0;
            height: 100vh;
        }
        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px 10px 26px;
        }
        .brand img {
            display: block;
            width: 190px;
            max-width: 100%;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 8px 18px rgba(13, 148, 136, 0.12));
        }
        .nav-group-label {
            font-size: 11px; text-transform: uppercase; letter-spacing: .07em;
            color: #475569; padding: 16px 12px 6px;
            font-weight: 600;
        }
        .nav-link {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 9px;
            font-size: 13.5px; font-weight: 500;
            color: var(--sidebar-text);
            margin-bottom: 2px;
            border-left: 3px solid transparent;
            transition: background .15s, color .15s;
        }
        .nav-link:hover { background: rgba(255,255,255,.05); color: #fff; }
        .nav-link.active {
            background: rgba(13, 148, 136, .16);
            color: var(--sidebar-text-active);
            border-left-color: var(--accent);
        }
        .nav-link .dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: currentColor; opacity: .55; flex-shrink: 0;
        }

        /* Main */
        .main { flex: 1; min-width: 0; display: flex; flex-direction: column; }
        .topbar {
            height: 64px; background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 28px; position: sticky; top: 0; z-index: 5;
        }
        .page-title { font-size: 18px; font-weight: 600; margin: 0; }
        .page-eyebrow { font-size: 12px; color: var(--ink-faint); font-weight: 500; }

        .content { padding: 28px; flex: 1; }

        /* Alerts */
        .alert {
            padding: 12px 16px; border-radius: 10px; margin-bottom: 18px;
            display: flex; align-items: center; justify-content: space-between;
            font-size: 13.5px; font-weight: 500;
        }
        .alert-success { background: var(--accent-soft); color: var(--accent-dark); border: 1px solid #99e0d6; }
        .alert-danger { background: var(--danger-soft); color: #b91c1c; border: 1px solid #fecaca; }
        .alert button { background: none; border: none; font-size: 15px; cursor: pointer; color: inherit; opacity: .6; }

        /* Card */
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; }
        .card-header {
            padding: 16px 22px; border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;
        }
        .card-body { padding: 22px; }
        .card-footer { padding: 14px 22px; border-top: 1px solid var(--border); }

        /* Buttons */
        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 16px; border-radius: 9px; border: 1px solid transparent;
            font-size: 13.5px; font-weight: 600; cursor: pointer;
            transition: transform .1s ease, background .15s;
        }
        .btn:active { transform: scale(.97); }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--accent-dark); }
        .btn-secondary { background: #fff; color: var(--ink); border-color: var(--border); }
        .btn-secondary:hover { background: #f8fafc; }
        .btn-warning { background: var(--warning-soft); color: #92400e; border-color: #fde68a; }
        .btn-warning:hover { background: #fef3c7; }
        .btn-danger { background: var(--danger-soft); color: #b91c1c; border-color: #fecaca; }
        .btn-danger:hover { background: #fee2e2; }
        .btn-sm { padding: 6px 11px; font-size: 12.5px; }
        .btn-icon { padding: 7px 9px; }

        /* Inputs */
        .input, textarea.input {
            width: 100%; padding: 9px 12px; border-radius: 9px;
            border: 1px solid var(--border); font-size: 13.5px; font-family: inherit;
            background: #fff; color: var(--ink);
        }
        .input:focus, textarea.input:focus { outline: 2px solid var(--accent); outline-offset: 1px; border-color: var(--accent); }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: var(--ink); }
        .form-hint { font-size: 12px; color: var(--ink-faint); margin-top: 5px; }
        .search-box { position: relative; }
        .search-box .input { padding-left: 34px; width: 220px; }
        .search-box svg { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); opacity: .45; }

        /* Table */
        table { width: 100%; border-collapse: collapse; }
        thead th {
            text-align: left; font-size: 11.5px; text-transform: uppercase; letter-spacing: .05em;
            color: var(--ink-faint); font-weight: 600; padding: 10px 22px; border-bottom: 1px solid var(--border);
            background: #fafbfc;
        }
        tbody td { padding: 14px 22px; border-bottom: 1px solid var(--border); font-size: 13.5px; vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #fafcfc; }
        .text-right { text-align: right; }
        .empty-state { text-align: center; padding: 48px 20px; color: var(--ink-faint); }
        .empty-state svg { opacity: .35; margin-bottom: 10px; }
        .empty-state p { margin: 0; font-size: 13.5px; }

        /* Role identity chip — signature element */
        .role-avatar {
            width: 34px; height: 34px; border-radius: 10px;
            display: inline-flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 13px; flex-shrink: 0;
        }
        .role-cell { display: flex; align-items: center; gap: 11px; }
        .role-name { font-weight: 600; color: var(--ink); }
        .role-desc { color: var(--ink-faint); font-size: 12.5px; }

        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 999px;
            font-size: 12px; font-weight: 600;
            background: var(--accent-soft); color: var(--accent-dark);
        }

        /* Permission checkbox grid */
        .perm-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
            gap: 10px; margin-top: 6px;
        }
        .perm-item {
            display: flex; align-items: center; gap: 9px;
            padding: 10px 12px; border: 1px solid var(--border); border-radius: 9px;
            font-size: 13px; font-weight: 500; cursor: pointer; transition: border-color .15s, background .15s;
        }
        .perm-item:hover { border-color: #a7d4cf; background: var(--accent-soft); }
        .perm-item input { accent-color: var(--accent); width: 15px; height: 15px; }

        .pagination-wrap { display: flex; justify-content: flex-end; }
    </style>
    @stack('styles')
</head>
<body>
<div class="app-shell">

    <aside class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/emsLogo.png') }}" alt="EMS Logo" style="width: 190px; height: auto; object-fit: contain; display: block;">
        </div>

        <div class="nav-group-label">Overview</div>
        <a href="{{ Route::has('employees.index') ? route('employees.index') : '#' }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}"><span class="dot"></span> Employees</a>
        <a href="{{ Route::has('departments.index') ? route('departments.index') : '#' }}" class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}"><span class="dot"></span> Departments</a>
        <a href="{{ Route::has('positions.index') ? route('positions.index') : '#' }}" class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}"><span class="dot"></span> Positions</a>

        <div class="nav-group-label">Attendance</div>
        <a href="{{ Route::has('attendance.index') ? route('attendance.index') : '#' }}" class="nav-link {{ request()->routeIs('attendance.*') ? 'active' : '' }}"><span class="dot"></span> Attendance</a>
        <a href="{{ Route::has('leave_requests.index') ? route('leave_requests.index') : '#' }}" class="nav-link {{ request()->routeIs('leave_requests.*') ? 'active' : '' }}"><span class="dot"></span> Leave Requests</a>
        <a href="{{ Route::has('leave_types.index') ? route('leave_types.index') : '#' }}" class="nav-link {{ request()->routeIs('leave_types.*') ? 'active' : '' }}"><span class="dot"></span> Leave Types</a>

        <div class="nav-group-label">Communication</div>
        <a href="{{ Route::has('announcements.index') ? route('announcements.index') : '#' }}" class="nav-link {{ request()->routeIs('announcements.*') ? 'active' : '' }}"><span class="dot"></span> Announcements</a>
        <a href="{{ Route::has('notifications.index') ? route('notifications.index') : '#' }}" class="nav-link {{ request()->routeIs('notifications.*') ? 'active' : '' }}"><span class="dot"></span> Notifications</a>

        <div class="nav-group-label">System</div>
        <a href="{{ Route::has('profile.show') ? route('profile.show') : '#' }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"><span class="dot"></span> Profile</a>
        <a href="{{ Route::has('roles.index') ? route('roles.index') : '#' }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}"><span class="dot"></span> Roles</a>
        <a href="{{ Route::has('activity_logs.index') ? route('activity_logs.index') : '#' }}" class="nav-link {{ request()->routeIs('activity_logs.*') ? 'active' : '' }}"><span class="dot"></span> Activity Logs</a>
    </aside>

    <div class="main">
        <div class="topbar">
            <div>
                <div class="page-eyebrow">@yield('eyebrow', 'System')</div>
                <h1 class="page-title">@yield('title', 'Dashboard')</h1>
            </div>
        </div>

        <div class="content">
            @if (session('success'))
                <div class="alert alert-success">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    <span>{{ session('error') }}</span>
                    <button type="button" onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
