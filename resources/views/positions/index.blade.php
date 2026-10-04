@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <div>
                <div class="page-title">Manage Positions</div>
                <div class="page-subtitle">Create, update, and manage employee positions.</div>
            </div>
            <a href="{{ route('positions.create') }}" class="btn-primary">➕ Add Position</a>
        </div>
    </div>

    <div style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
        <form method="GET" action="{{ route('positions.index') }}" style="display: flex; gap: 10px; flex-wrap: wrap; width: 100%;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search positions..." style="flex: 1; min-width: 220px; padding: 10px 12px; border: 1px solid #dbe3ec; border-radius: 8px;">
            <button type="submit" class="btn-secondary">Search</button>
            @if (request('search'))
                <a href="{{ route('positions.index') }}" class="btn-secondary">Clear</a>
            @endif
        </form>
    </div>

    @if ($positions->count() > 0)
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Description</th>
                        <th>Employees</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($positions as $position)
                        <tr>
                            <td><strong>{{ $position->position_name }}</strong></td>
                            <td>{{ $position->description ?: '—' }}</td>
                            <td>{{ $position->employees_count ?? 0 }}</td>
                            <td>
                                <span class="status-badge {{ $position->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $position->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                    <a href="{{ route('positions.edit', $position) }}" class="btn-secondary">Edit</a>
                                    <form method="POST" action="{{ route('positions.destroy', $position) }}" onsubmit="return confirm('Delete this position?');">
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
            {{ $positions->links() }}
        </div>
    @else
        <div class="card" style="padding: 40px; text-align: center; color: #64748b;">
            No positions found.
        </div>
    @endif
@endsection
