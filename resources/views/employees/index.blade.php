@extends('dashboard.layout')

@section('content')
    @include('employees._styles')

    <div class="employee-toolbar">
        <div class="page-header" style="margin: 0;">
            <div class="page-title">Employees</div>
            <div class="page-subtitle">Manage employee records, departments, and positions.</div>
        </div>
        <a href="{{ route('employees.create') }}" class="btn-primary">＋ Add Employee</a>
    </div>

    <div class="card" style="padding: 16px; margin-bottom: 20px;">
        <form method="GET" action="{{ route('employees.index') }}" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 220px;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search employees..." class="input">
            </div>
            <button type="submit" class="btn-secondary">Search</button>
            @if (request('search'))
                <a href="{{ route('employees.index') }}" class="btn-secondary">Clear</a>
            @endif
        </form>
    </div>

    <div class="employee-table-wrap">
        <table class="employee-table">
            <thead>
                <tr>
                    <th scope="col">Employee</th>
                    <th scope="col">Code</th>
                    <th scope="col">Department</th>
                    <th scope="col">Position</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                    <tr>
                        <td>
                            <strong>{{ $employee->full_name_with_suffix }}</strong><br>
                            <span style="color: var(--muted); font-size: 12px;">{{ $employee->email }}</span>
                        </td>
                        <td>{{ $employee->employee_code }}</td>
                        <td>{{ $employee->department->department_name }}</td>
                        <td>{{ $employee->position->position_name }}</td>
                        <td><span class="employee-status {{ \Illuminate\Support\Str::slug($employee->employment_status) }}">{{ $employee->employment_status }}</span></td>
                        <td>
                            <div class="employee-actions">
                                <a class="btn-secondary" href="{{ route('employees.show', $employee) }}">View</a>
                                <a class="btn-secondary" href="{{ route('employees.edit', $employee) }}">Edit</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 32px; text-align: center; color: var(--muted);">No employees have been added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
        {{ $employees->links() }}
    </div>
@endsection
