@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <a href="{{ route('roles.index') }}" style="color: #667eea; text-decoration: none; font-weight: 500;">← Back to Roles</a>
        <div class="page-title" style="margin-top: 10px;">{{ $role->role_name }}</div>
        <div class="page-subtitle">View role details and assigned users.</div>
    </div>

    <style>
        .role-header {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .role-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            border-left: 4px solid #667eea;
            padding-left: 15px;
        }

        .info-label {
            font-size: 12px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
        }

        .description-section {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2d3748;
        }

        .description-text {
            font-size: 14px;
            line-height: 1.6;
            color: #4a5568;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

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
            padding: 10px 20px;
            background-color: #e2e8f0;
            color: #2d3748;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #cbd5e0;
        }

        .users-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .users-header {
            background-color: #f7fafc;
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f7fafc;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #4a5568;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        tr:hover {
            background-color: #f7fafc;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #718096;
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

        @media (max-width: 768px) {
            .role-header {
                padding: 20px;
            }

            .role-info-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-primary, .btn-secondary {
                width: 100%;
                text-align: center;
            }

            th, td {
                padding: 10px;
                font-size: 12px;
            }
        }
    </style>

    <div class="role-header">
        <div class="role-info-grid">
            <div class="info-item">
                <div class="info-label">Role Name</div>
                <div class="info-value">{{ $role->role_name }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Status</div>
                <div class="info-value">
                    @if ($role->is_active)
                        <span class="status-badge status-active">✓ Active</span>
                    @else
                        <span class="status-badge status-inactive">✗ Inactive</span>
                    @endif
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Users Assigned</div>
                <div class="info-value">{{ $role->users_count ?? 0 }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Created</div>
                <div class="info-value">{{ $role->created_at->format('M d, Y') }}</div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('roles.edit', $role) }}" class="btn-primary">✏️ Edit Role</a>
            @if ($role->users_count == 0)
                <form method="POST" action="{{ route('roles.destroy', $role) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this role?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-secondary" style="background-color: #fc8181; color: white;">🗑️ Delete Role</button>
                </form>
            @endif
        </div>
    </div>

    <!-- Description Section -->
    @if ($role->description)
        <div class="description-section">
            <div class="section-title">📝 Description</div>
            <div class="description-text">{{ $role->description }}</div>
        </div>
    @endif

    <!-- Users Section -->
    <div class="users-container">
        <div class="users-header">
            <div class="section-title" style="margin: 0;">👥 Users with this Role</div>
        </div>

        @if ($role->users->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th>Last Login</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($role->users as $user)
                        <tr>
                            <td>
                                <strong>{{ $user->name }}</strong>
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td>
                                @if ($user->last_login_at)
                                    {{ $user->last_login_at->format('M d, Y H:i') }}
                                @else
                                    Never
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <div style="font-size: 36px; margin-bottom: 10px;">👤</div>
                <div style="font-size: 16px; font-weight: 600; color: #2d3748; margin-bottom: 5px;">No Users Assigned</div>
                <p>No users have been assigned this role yet.</p>
            </div>
        @endif
    </div>
@endsection
