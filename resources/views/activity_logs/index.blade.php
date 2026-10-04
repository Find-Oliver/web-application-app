@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <div>
            <div class="page-title">Activity Logs</div>
            <div class="page-subtitle">Recent system activity and administrative actions.</div>
        </div>
    </div>

    <div class="table-container">
        @if ($activityLogs->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Subject</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activityLogs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('M d, Y h:i A') }}</td>
                            <td>{{ $log->user?->name ?? 'System' }}</td>
                            <td>
                                <span class="action-badge">{{ ucfirst($log->action) }}</span>
                            </td>
                            <td>{{ $log->subject }}</td>
                            <td>{{ $log->description ?? 'No description provided.' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-wrap">
                {{ $activityLogs->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📝</div>
                <div class="empty-state-title">No activity recorded yet</div>
                <div>System actions will appear here once staff start using the application.</div>
            </div>
        @endif
    </div>

    <style>
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            color: #475569;
            padding: 14px 16px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            padding: 14px 16px;
            border-top: 1px solid #e2e8f0;
            vertical-align: top;
        }

        tr:hover {
            background: #f8fafc;
        }

        .action-badge {
            display: inline-block;
            background: #e0f2fe;
            color: #075985;
            border-radius: 999px;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .pagination-wrap {
            padding: 12px 16px;
            display: flex;
            justify-content: flex-end;
        }

        .empty-state {
            padding: 48px 20px;
            text-align: center;
            color: #64748b;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .empty-state-title {
            color: #0f172a;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
        }
    </style>
@endsection
