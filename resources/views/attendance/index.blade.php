@extends('dashboard.layout')

@section('content')
    @include('attendance._styles')

    <div class="attendance-toolbar">
        <div class="page-header" style="margin: 0;">
            <div class="page-title">Attendance</div>
            <div class="page-subtitle">Review and manage employee attendance records.</div>
        </div>
        <a href="{{ route('attendance.create') }}" class="attendance-button primary">Add attendance</a>
    </div>

    <div class="attendance-table-wrap">
        <table class="attendance-table">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Employee</th>
                    <th scope="col">Time in</th>
                    <th scope="col">Time out</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendanceRecords as $record)
                    <tr>
                        <td>{{ $record->attendance_date->format('M j, Y') }}</td>
                        <td>
                            <strong>{{ $record->employee->full_name_with_suffix }}</strong><br>
                            <span style="color: var(--muted);">{{ $record->employee->employee_code }}</span>
                        </td>
                        <td>{{ $record->time_in?->format('H:i') ?? '—' }}</td>
                        <td>{{ $record->time_out?->format('H:i') ?? '—' }}</td>
                        <td><span class="attendance-status {{ \Illuminate\Support\Str::slug($record->status) }}">{{ $record->status }}</span></td>
                        <td>
                            <div class="attendance-actions">
                                <a class="attendance-button" href="{{ route('attendance.edit', $record) }}">Edit</a>
                                <form method="POST" action="{{ route('attendance.destroy', $record) }}" onsubmit="return confirm('Delete this attendance record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="attendance-button danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 32px; text-align: center; color: var(--muted);">No attendance records have been added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="attendance-pagination" style="margin-top: 18px;">{{ $attendanceRecords->links() }}</div>
@endsection
