@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap;">
            <div>
                <div class="page-title">Announcements</div>
                <div class="page-subtitle">Manage company-wide updates and important notices.</div>
            </div>
            <a href="{{ route('announcements.create') }}" class="btn-primary">➕ New Announcement</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        @if ($announcements->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($announcements as $announcement)
                        <tr>
                            <td>
                                <strong>{{ $announcement->title }}</strong>
                                <div class="muted">{{ Str::limit($announcement->content, 80) }}</div>
                            </td>
                            <td>{{ $announcement->creator?->name ?? 'System' }}</td>
                            <td>
                                <span class="status-badge {{ $announcement->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $announcement->created_at->format('M d, Y') }}</td>
                            <td class="actions">
                                <a href="{{ route('announcements.edit', $announcement) }}" class="btn-secondary">Edit</a>
                                <form action="{{ route('announcements.destroy', $announcement) }}" method="POST" onsubmit="return confirm('Delete this announcement?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-wrap">
                {{ $announcements->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📢</div>
                <div class="empty-state-title">No announcements yet</div>
                <div>Create the first announcement for the team.</div>
            </div>
        @endif
    </div>

    <style>
        .btn-primary, .btn-secondary, .btn-danger {
            display: inline-block; padding: 10px 16px; border-radius: 8px; text-decoration: none; border: none; cursor: pointer; font-weight: 600;
        }
        .btn-primary { background: #4f46e5; color: white; }
        .btn-secondary { background: #e2e8f0; color: #0f172a; }
        .btn-danger { background: #ef4444; color: white; }
        .table-container { background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(15,23,42,.08); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8fafc; color: #475569; padding: 14px 16px; text-align: left; font-size: 12px; letter-spacing: .06em; text-transform: uppercase; }
        td { padding: 14px 16px; border-top: 1px solid #e2e8f0; vertical-align: top; }
        .status-badge { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; }
        .status-active { background: #dcfce7; color: #166534; }
        .status-inactive { background: #fee2e2; color: #991b1b; }
        .muted { color: #64748b; margin-top: 6px; }
        .actions { display: flex; align-items: center; gap: 8px; }
        .pagination-wrap { padding: 14px 16px; display: flex; justify-content: flex-end; }
        .empty-state { text-align: center; padding: 48px 24px; color: #64748b; }
        .empty-state-icon { font-size: 48px; margin-bottom: 12px; }
        .empty-state-title { color: #0f172a; font-size: 22px; font-weight: 700; margin-bottom: 8px; }
        @media (max-width: 768px) { .actions { flex-direction: column; align-items: flex-start; } }
    </style>
@endsection
