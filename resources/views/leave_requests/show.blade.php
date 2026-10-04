@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Leave Request Details</h1>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('leave_requests.edit', $leaveRequest) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Employee</dt>
                <dd class="col-sm-9">{{ $leaveRequest->employee?->full_name_with_suffix ?? 'Employee #' . $leaveRequest->employee_id }}</dd>

                <dt class="col-sm-3">Leave type</dt>
                <dd class="col-sm-9">{{ $leaveRequest->leaveType?->leave_type_name ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Dates</dt>
                <dd class="col-sm-9">{{ $leaveRequest->start_date->format('M d, Y') }} to {{ $leaveRequest->end_date->format('M d, Y') }}</dd>

                <dt class="col-sm-3">Reason</dt>
                <dd class="col-sm-9">{{ $leaveRequest->reason }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">{{ $leaveRequest->status }}</dd>

                <dt class="col-sm-3">Remarks</dt>
                <dd class="col-sm-9">{{ $leaveRequest->remarks ?? 'No remarks provided.' }}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection
