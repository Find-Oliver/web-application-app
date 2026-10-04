@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <div>
                <div class="page-title">Manage Departments</div>
                <div class="page-subtitle">Create, update, and manage company departments.</div>
            </div>
            <a href="{{ route('departments.create') }}" class="btn-primary">➕ Add Department</a>
        </div>
    </div>

    <div style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
        <form method="GET" action="{{ route('departments.index') }}" style="display: flex; gap: 10px; flex-wrap: wrap; width: 100%;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search departments..." style="flex: 1; min-width: 220px; padding: 10px 12px; border: 1px solid #dbe3ec; border-radius: 8px;">
            <button type="submit" class="btn-secondary">Search</button>
            @if (request('search'))
                <a href="{{ route('departments.index') }}" class="btn-secondary">Clear</a>
            @endif
        </form>
    </div>

    @if ($departments->count() > 0)
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Description</th>
                        <th>Employees</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td><strong>{{ $department->department_name }}</strong></td>
                            <td>{{ $department->description ?: '—' }}</td>
                            <td>{{ $department->employees_count ?? 0 }}</td>
                            <td>
                                <span class="status-badge {{ $department->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $department->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                    <a href="{{ route('departments.edit', $department) }}" class="btn-secondary">Edit</a>
                                    <form method="POST" action="{{ route('departments.destroy', $department) }}" onsubmit="return confirm('Delete this department?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
            {{ $departments->links() }}
        </div>
    @else
        <div class="card" style="padding: 40px; text-align: center; color: #64748b;">
            No departments found.
        </div>
    @endif
@endsection
