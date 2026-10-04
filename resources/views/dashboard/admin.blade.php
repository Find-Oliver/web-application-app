@extends('dashboard.layout')

@section('content')
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-end; gap: 16px; flex-wrap: wrap;">
        <div>
            <div class="page-title">Admin Dashboard</div>
            <div class="page-subtitle">Welcome back, {{ Auth::user()->name }}. Here is the current overview of your workforce.</div>
        </div>
        <a href="{{ route('employees.create') }}" class="btn-primary">＋ Add Employee</a>
    </div>

    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--panel);
            border: 1px solid var(--panel-border);
            border-left: 5px solid var(--primary);
            border-radius: 18px;
            padding: 20px 18px;
            box-shadow: var(--shadow);
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: var(--text);
            margin-bottom: 8px;
        }

        .stat-change {
            font-size: 13px;
            color: var(--muted);
            font-weight: 600;
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .quick-panel {
            background: var(--panel);
            border: 1px solid var(--panel-border);
            border-radius: 18px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .quick-panel-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--panel-border);
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }

        .quick-panel-body {
            padding: 18px 20px 20px;
            display: grid;
            gap: 12px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #f8fafc;
            color: var(--text);
            text-decoration: none;
            font-weight: 600;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .menu-link:hover {
            background: #fff;
            border-color: #e2e8f0;
            transform: translateY(-1px);
        }

        @media (max-width: 640px) {
            .stat-value { font-size: 1.7rem; }
        }
    </style>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Employees</div>
            <div class="stat-value">{{ $stats['total_employees'] }}</div>
            <div class="stat-change">System active</div>
        </div>

        <div class="stat-card" style="border-left-color: #16a34a;">
            <div class="stat-label">Active Employees</div>
            <div class="stat-value">{{ $stats['active_employees'] }}</div>
            <div class="stat-change">{{ round(($stats['active_employees'] / max($stats['total_employees'], 1)) * 100) }}% of total</div>
        </div>

        <div class="stat-card" style="border-left-color: #d97706;">
            <div class="stat-label">Inactive</div>
            <div class="stat-value">{{ $stats['inactive_employees'] }}</div>
            <div class="stat-change">Needs review</div>
        </div>

        <div class="stat-card" style="border-left-color: #2563eb;">
            <div class="stat-label">Departments</div>
            <div class="stat-value">{{ $stats['departments'] }}</div>
            <div class="stat-change">Organizational units</div>
        </div>

        <div class="stat-card" style="border-left-color: #16a34a;">
            <div class="stat-label">Present Today</div>
            <div class="stat-value">{{ $stats['present_today'] }}</div>
            <div class="stat-change">As of today</div>
        </div>

        <div class="stat-card" style="border-left-color: #d97706;">
            <div class="stat-label">Late Today</div>
            <div class="stat-value">{{ $stats['late_today'] }}</div>
            <div class="stat-change">Monitor productivity</div>
        </div>

        <div class="stat-card" style="border-left-color: #f16024;">
            <div class="stat-label">Pending Leave</div>
            <div class="stat-value">{{ $stats['pending_leaves'] }}</div>
            <div class="stat-change">Action required</div>
        </div>
    </div>

    <div class="quick-grid">
        <div class="quick-panel">
            <div class="quick-panel-header">Employee Management</div>
            <div class="quick-panel-body">
                <a href="{{ route('employees.index') }}" class="menu-link">👥 Manage Employees</a>
                <a href="{{ route('employees.create') }}" class="menu-link">➕ Add Employee</a>
                <a href="{{ route('departments.index') }}" class="menu-link">🏢 Departments</a>
                <a href="{{ route('positions.index') }}" class="menu-link">💼 Positions</a>
            </div>
        </div>

        <div class="quick-panel">
            <div class="quick-panel-header">Administration</div>
            <div class="quick-panel-body">
                <a href="{{ route('roles.index') }}" class="menu-link">🔐 Manage Roles</a>
                <a href="{{ route('reports.index') }}" class="menu-link">📊 Reports</a>
                <a href="{{ route('activity_logs.index') }}" class="menu-link">📋 Activity Log</a>
                <a href="#" class="menu-link" style="opacity: 0.55; cursor: not-allowed;">⚡ Settings</a>
            </div>
        </div>
    </div>
@endsection
