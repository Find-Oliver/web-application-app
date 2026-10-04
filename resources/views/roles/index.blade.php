@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <div>
                <div class="page-title">Manage Roles</div>
                <div class="page-subtitle">Create, update, and manage system roles and permissions.</div>
            </div>
            <a href="{{ route('roles.create') }}" class="btn-primary">➕ Add New Role</a>
        </div>
    </div>

    <style>
        .btn-primary {
            padding: 10px 20px;
            background-color: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #5568d3;
        }

        .btn-secondary {
            padding: 8px 16px;
            background-color: #e2e8f0;
            color: #2d3748;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
            font-size: 13px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #cbd5e0;
        }

        .btn-danger {
            padding: 8px 16px;
            background-color: #fc8181;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
            font-size: 13px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #f56565;
        }

        .search-bar {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }

        .search-input {
            flex: 1;
            max-width: 300px;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 14px;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f7fafc;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #4a5568;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        tr:hover {
            background-color: #f7fafc;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background-color: #c6f6d5;
            color: #22543d;
        }

        .status-inactive {
            background-color: #fed7d7;
            color: #742a2a;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #718096;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .empty-state-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2d3748;
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
            }

            .btn-primary {
                width: 100%;
                text-align: center;
            }

            th, td {
                padding: 10px;
                font-size: 12px;
            }

            .actions {
                flex-direction: column;
            }

            .btn-secondary, .btn-danger {
                width: 100%;
            }
        }
    </style>

    <!-- Search Bar -->
    <div class="search-bar">
        <form method="GET" action="{{ route('roles.index') }}" style="display: flex; gap: 10px; width: 100%;">
            <input type="text" name="search" class="search-input" placeholder="Search roles..." value="{{ request('search') }}">
            <button type="submit" class="btn-secondary">🔍 Search</button>
            @if (request('search'))
                <a href="{{ route('roles.index') }}" class="btn-secondary">✕ Clear</a>
            @endif
        </form>
    </div>

    <!-- Roles Table -->
    @if ($roles->count() > 0)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Role Name</th>
                        <th>Description</th>
                        <th>Users Assigned</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>
                                <strong>{{ $role->role_name }}</strong>
                            </td>
                            <td>
                                {{ $role->description ?? '—' }}
                            </td>
                            <td>
                                <span style="background-color: #ebf8ff; color: #2c5aa0; padding: 4px 8px; border-radius: 4px; font-weight: 600; font-size: 12px;">
                                    {{ $role->users_count ?? 0 }} user{{ ($role->users_count ?? 0) != 1 ? 's' : '' }}
                                </span>
                            </td>
                            <td>
                                @if ($role->is_active)
                                    <span class="status-badge status-active">✓ Active</span>
                                @else
                                    <span class="status-badge status-inactive">✗ Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('roles.show', $role) }}" class="btn-secondary">👁️ View</a>
                                    <a href="{{ route('roles.edit', $role) }}" class="btn-secondary">✏️ Edit</a>
                                    @if ($role->users_count == 0)
                                        <form method="POST" action="{{ route('roles.destroy', $role) }}" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger">🗑️ Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="margin-top: 20px; display: flex; justify-content: center;">
            {{ $roles->links() }}
        </div>
    @else
        <div class="table-container">
            <div class="empty-state">
                <div class="empty-state-icon">🎭</div>
                <div class="empty-state-title">No Roles Found</div>
                <p>Create your first role to get started.</p>
                <a href="{{ route('roles.create') }}" class="btn-primary" style="margin-top: 15px;">➕ Create Role</a>
            </div>
        </div>
    @endif

    @if ($roles->hasPages())
        <div style="margin-top: 20px; display: flex; justify-content: center;">
            {{ $roles->links() }}
        </div>
    @endif
@endsection
