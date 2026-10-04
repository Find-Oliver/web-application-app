@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <div class="page-title">My Dashboard</div>
        <div class="page-subtitle">Welcome, {{ $stats['employee_name'] }}! Here's your workspace.</div>
    </div>

    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 10px; padding: 30px; margin-bottom: 30px;">
        <div style="font-size: 24px; font-weight: 600; margin-bottom: 10px;">👋 Welcome to EMS</div>
        <div style="font-size: 14px; opacity: 0.9;">Manage your work, track attendance, and stay organized.</div>
    </div>

    <div class="menu-section">
        <div class="menu-title">📋 My Actions</div>
        <div class="menu-links">
            <a href="{{ route('leave_requests.index') }}" class="menu-link">📅 Leave Requests</a>
            <a href="{{ route('profile.show') }}" class="menu-link">👤 My Profile</a>
            <a href="{{ route('dashboard') }}" class="menu-link">📊 Dashboard</a>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card" style="border-left-color: #48bb78;">
            <div class="stat-label">Today's Status</div>
            <div class="stat-value">{{ $stats['today_status'] }}</div>
            <div class="stat-change">{{ $stats['today_status'] === 'Present' ? 'Checked in successfully' : 'Check in to get started' }}</div>
        </div>

        <div class="stat-card" style="border-left-color: #4299e1;">
            <div class="stat-label">My Pending Requests</div>
            <div class="stat-value">{{ $stats['pending_requests'] }}</div>
            <div class="stat-change">View your leave requests</div>
        </div>

        <div class="stat-card" style="border-left-color: #ed64a6;">
            <div class="stat-label">Leave Balance</div>
            <div class="stat-value">{{ $stats['leave_balance'] }}</div>
            <div class="stat-change">Days remaining</div>
        </div>

        <div class="stat-card" style="border-left-color: #a855f7;">
            <div class="stat-label">Approved Requests</div>
            <div class="stat-value">{{ $stats['approved_requests'] }}</div>
            <div class="stat-change">Approved to date</div>
        </div>
    </div>
@endsection
