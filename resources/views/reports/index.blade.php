@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <div class="page-title">Reports</div>
        <div class="page-subtitle">Quick summary of workforce and leave activity.</div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Employees</div>
            <div class="stat-value">{{ $report['total_employees'] }}</div>
            <div class="stat-change">All active records</div>
        </div>

        <div class="stat-card" style="border-left-color: #48bb78;">
            <div class="stat-label">Active Employees</div>
            <div class="stat-value">{{ $report['active_employees'] }}</div>
            <div class="stat-change">Currently active</div>
        </div>

        <div class="stat-card" style="border-left-color: #38b000;">
            <div class="stat-label">Present Today</div>
            <div class="stat-value">{{ $report['present_today'] }}</div>
            <div class="stat-change">Attendance summary</div>
        </div>

        <div class="stat-card" style="border-left-color: #f6ad55;">
            <div class="stat-label">Late Today</div>
            <div class="stat-value">{{ $report['late_today'] }}</div>
            <div class="stat-change">Needs follow-up</div>
        </div>

        <div class="stat-card" style="border-left-color: #ed64a6;">
            <div class="stat-label">Pending Leaves</div>
            <div class="stat-value">{{ $report['pending_leaves'] }}</div>
            <div class="stat-change">Awaiting review</div>
        </div>

        <div class="stat-card" style="border-left-color: #10b981;">
            <div class="stat-label">Approved Leaves</div>
            <div class="stat-value">{{ $report['approved_leaves'] }}</div>
            <div class="stat-change">Completed approvals</div>
        </div>

        <div class="stat-card" style="border-left-color: #ef4444;">
            <div class="stat-label">Rejected Leaves</div>
            <div class="stat-value">{{ $report['rejected_leaves'] }}</div>
            <div class="stat-change">Requires attention</div>
        </div>
    </div>

    <div class="menu-section">
        <div class="menu-title">Attendance Summary</div>
        <div class="menu-links">
            <div class="menu-link" style="cursor: default;">Present: {{ $report['present_today'] }}</div>
            <div class="menu-link" style="cursor: default;">Late: {{ $report['late_today'] }}</div>
            <div class="menu-link" style="cursor: default;">Pending Leave: {{ $report['pending_leaves'] }}</div>
        </div>
    </div>
@endsection
