@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <div>
            <div class="page-title">Notifications</div>
            <div class="page-subtitle">Your recent updates and alerts.</div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="notification-list">
        @if ($notifications->count() > 0)
            @foreach ($notifications as $notification)
                <div class="notification-item {{ $notification->read_at ? 'read' : 'unread' }}">
                    <div class="notification-header">
                        <div class="notification-title">{{ $notification->title }}</div>
                        <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="notification-message">{{ $notification->message }}</div>
                    @if (is_null($notification->read_at))
                        <form action="{{ route('notifications.read', $notification) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-primary">Mark as read</button>
                        </form>
                    @else
                        <span class="status-read">Read</span>
                    @endif
                </div>
            @endforeach

            <div class="pagination-wrap">
                {{ $notifications->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">🔔</div>
                <div class="empty-state-title">No notifications yet</div>
                <div>You'll see system alerts here when they arrive.</div>
            </div>
        @endif
    </div>

    <style>
        .notification-list { display: grid; gap: 16px; }
        .notification-item { background: white; border-radius: 12px; padding: 18px 20px; box-shadow: 0 1px 3px rgba(15,23,42,.08); border-left: 4px solid #60a5fa; }
        .notification-item.read { border-left-color: #94a3b8; }
        .notification-item.unread { border-left-color: #4f46e5; }
        .notification-header { display: flex; justify-content: space-between; gap: 12px; align-items: center; margin-bottom: 8px; }
        .notification-title { font-weight: 700; color: #0f172a; }
        .notification-time { font-size: 12px; color: #64748b; }
        .notification-message { color: #334155; margin-bottom: 12px; }
        .btn-primary { display: inline-block; background: #4f46e5; color: white; border: none; border-radius: 8px; padding: 8px 12px; font-weight: 600; cursor: pointer; }
        .status-read { display: inline-block; padding: 4px 10px; border-radius: 999px; background: #e2e8f0; color: #475569; font-size: 12px; font-weight: 600; }
        .pagination-wrap { display: flex; justify-content: flex-end; margin-top: 16px; }
        .empty-state { background: white; border-radius: 12px; padding: 48px 20px; text-align: center; color: #64748b; }
        .empty-state-icon { font-size: 48px; margin-bottom: 12px; }
        .empty-state-title { color: #0f172a; font-size: 22px; font-weight: 700; margin-bottom: 8px; }
    </style>
@endsection
