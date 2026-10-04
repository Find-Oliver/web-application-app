@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Leave Requests</h1>
            <p class="text-muted mb-0">Review leave requests and approvals.</p>
        </div>
        <a href="{{ route('leave_requests.create') }}" class="btn btn-primary">New request</a>
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
                            <th>Employee</th>
                            <th>Type</th>
                            <th>Dates</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leaveRequests as $leaveRequest)
                            <tr>
                                <td>{{ $leaveRequest->employee?->full_name_with_suffix ?? 'Employee #' . $leaveRequest->employee_id }}</td>
                                <td>{{ $leaveRequest->leaveType?->leave_type_name ?? 'N/A' }}</td>
                                <td>{{ $leaveRequest->start_date->format('M d, Y') }} - {{ $leaveRequest->end_date->format('M d, Y') }}</td>
                                <td>
                                    @php
                                        $statusClass = match($leaveRequest->status) {
                                            'Approved' => 'bg-success',
                                            'Rejected' => 'bg-danger',
                                            'Cancelled' => 'bg-secondary',
                                            default => 'bg-warning text-dark',
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $leaveRequest->status }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('leave_requests.show', $leaveRequest) }}" class="btn btn-sm btn-outline-info">View</a>
                                    @if (auth()->user()->isAdmin())
                                        <form action="{{ route('leave_requests.approve', $leaveRequest) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('leave_requests.reject', $leaveRequest) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No leave requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $leaveRequests->links() }}
    </div>
</div>
@endsection
