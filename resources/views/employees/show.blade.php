@extends('dashboard.layout')

@section('content')
    @include('employees._styles')

    <div class="employee-toolbar">
        <div class="page-header" style="margin: 0;">
            <div class="page-title">{{ $employee->full_name_with_suffix }}</div>
            <div class="page-subtitle">Employee record · {{ $employee->employee_code }}</div>
        </div>
        <div class="employee-actions">
            <a class="employee-button secondary" href="{{ route('employees.index') }}">All employees</a>
            <a class="employee-button" href="{{ route('employees.edit', $employee) }}">Edit employee</a>
        </div>
    </div>

    <section class="employee-details" aria-label="Employee details">
        <div class="employee-detail-grid">
            <dl class="employee-detail"><dt>Email</dt><dd>{{ $employee->email }}</dd></dl>
            <dl class="employee-detail"><dt>Phone</dt><dd>{{ $employee->phone }}</dd></dl>
            <dl class="employee-detail"><dt>Department</dt><dd>{{ $employee->department->department_name }}</dd></dl>
            <dl class="employee-detail"><dt>Position</dt><dd>{{ $employee->position->position_name }}</dd></dl>
            <dl class="employee-detail"><dt>Status</dt><dd><span class="employee-status {{ \Illuminate\Support\Str::slug($employee->employment_status) }}">{{ $employee->employment_status }}</span></dd></dl>
            <dl class="employee-detail"><dt>Date hired</dt><dd>{{ $employee->date_hired->format('M j, Y') }}</dd></dl>
            <dl class="employee-detail"><dt>Date of birth</dt><dd>{{ $employee->date_of_birth->format('M j, Y') }}</dd></dl>
            <dl class="employee-detail"><dt>Gender</dt><dd>{{ $employee->gender }}</dd></dl>
            <dl class="employee-detail"><dt>Emergency contact</dt><dd>{{ $employee->emergency_contact ?: 'Not provided' }}</dd></dl>
            <dl class="employee-detail"><dt>Emergency contact phone</dt><dd>{{ $employee->emergency_contact_phone ?: 'Not provided' }}</dd></dl>
            <dl class="employee-detail" style="grid-column: 1 / -1;"><dt>Address</dt><dd>{{ $employee->address }}</dd></dl>
        </div>
    </section>

    <form method="POST" action="{{ route('employees.destroy', $employee) }}" style="margin-top: 16px;" onsubmit="return confirm('Delete this employee record?')">
        @csrf
        @method('DELETE')
        <button class="employee-button danger" type="submit">Delete employee</button>
    </form>
@endsection
