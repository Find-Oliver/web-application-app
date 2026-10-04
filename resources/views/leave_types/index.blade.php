@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Leave Types</h1>
            <p class="text-muted mb-0">Manage available leave categories.</p>
        </div>
        <a href="{{ route('leave_types.create') }}" class="btn btn-primary">Add leave type</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Default Days</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leaveTypes as $leaveType)
                            <tr>
                                <td>{{ $leaveType->leave_type_name }}</td>
                                <td>{{ $leaveType->default_days }}</td>
                                <td>
                                    @if ($leaveType->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('leave_types.show', $leaveType) }}" class="btn btn-sm btn-outline-info">View</a>
                                    <a href="{{ route('leave_types.edit', $leaveType) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('leave_types.destroy', $leaveType) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this leave type?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No leave types found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $leaveTypes->links() }}
    </div>
</div>
@endsection
