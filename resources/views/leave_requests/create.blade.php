@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Submit Leave Request</h1>
        </div>
        <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('leave_requests.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="employee_id" class="form-label">Employee</label>
                        <select id="employee_id" name="employee_id" class="form-select" required aria-describedby="employee_id_error">
                            <option value="" disabled @selected(old('employee_id', '') === '')>
                                {{ $employees->isEmpty() ? 'No employees available' : 'Select an employee' }}
                            </option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" @selected((string) old('employee_id') === (string) $employee->id)>
                                    {{ $employee->full_name_with_suffix }}
                                </option>
                            @endforeach
                        </select>
                        @if ($employees->isEmpty())
                            <div class="text-danger mt-1">
                                {{ auth()->user()->isAdmin()
                                    ? 'No employee records are available.'
                                    : 'No employee record is linked to your account. Contact an administrator.' }}
                            </div>
                        @endif
                        @error('employee_id')
                            <div id="employee_id_error" class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="leave_type_id" class="form-label">Leave type</label>
                        <select id="leave_type_id" name="leave_type_id" class="form-select" required aria-describedby="leave_type_id_error">
                            <option value="" disabled @selected(old('leave_type_id', '') === '')>
                                {{ $leaveTypes->isEmpty() ? 'No leave types available' : 'Select a leave type' }}
                            </option>
                            @foreach ($leaveTypes as $leaveType)
                                <option value="{{ $leaveType->id }}" @selected((string) old('leave_type_id') === (string) $leaveType->id)>
                                    {{ $leaveType->leave_type_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('leave_type_id')
                            <div id="leave_type_id_error" class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="start_date" class="form-label">Start date</label>
                        <input id="start_date" type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required aria-describedby="start_date_error">
                        @error('start_date')
                            <div id="start_date_error" class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="end_date" class="form-label">End date</label>
                        <input id="end_date" type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required aria-describedby="end_date_error">
                        @error('end_date')
                            <div id="end_date_error" class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="reason" class="form-label">Reason</label>
                        <textarea id="reason" name="reason" class="form-control" rows="4" required aria-describedby="reason_error">{{ old('reason') }}</textarea>
                        @error('reason')
                            <div id="reason_error" class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea id="remarks" name="remarks" class="form-control" rows="3" aria-describedby="remarks_error">{{ old('remarks') }}</textarea>
                        @error('remarks')
                            <div id="remarks_error" class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Submit request</button>
                    <a href="{{ route('leave_requests.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
