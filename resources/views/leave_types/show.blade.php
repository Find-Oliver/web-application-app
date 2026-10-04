@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">{{ $leaveType->leave_type_name }}</h1>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('leave_types.edit', $leaveType) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('leave_types.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9">{{ $leaveType->leave_type_name }}</dd>

                <dt class="col-sm-3">Default days</dt>
                <dd class="col-sm-9">{{ $leaveType->default_days }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">{{ $leaveType->is_active ? 'Active' : 'Inactive' }}</dd>

                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9">{{ $leaveType->description ?? 'No description provided.' }}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection
