@include('attendance._styles')

@php($isEditing = isset($attendance) && $attendance->exists)

<form class="attendance-form" action="{{ $isEditing ? route('attendance.update', $attendance) : route('attendance.store') }}" method="POST">
    @csrf
    @if ($isEditing)
        @method('PUT')
    @endif

    <div class="attendance-form-grid">
        <div class="attendance-field wide">
            <label for="employee_id">Employee</label>
            <select id="employee_id" name="employee_id" required>
                <option value="">Select employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" @selected((string) old('employee_id', $attendance?->employee_id) === (string) $employee->id)>
                        {{ $employee->full_name_with_suffix }} ({{ $employee->employee_code }})
                    </option>
                @endforeach
            </select>
            @error('employee_id') <div class="attendance-error">{{ $message }}</div> @enderror
        </div>
        <div class="attendance-field">
            <label for="attendance_date">Attendance date</label>
            <input id="attendance_date" type="date" name="attendance_date" value="{{ old('attendance_date', $attendance?->attendance_date?->format('Y-m-d') ?? today()->toDateString()) }}" max="{{ today()->toDateString() }}" required>
            @error('attendance_date') <div class="attendance-error">{{ $message }}</div> @enderror
        </div>
        <div class="attendance-field">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                @foreach (['Present', 'Absent', 'Late', 'On Leave', 'Half Day'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $attendance?->status ?? 'Present') === $status)>{{ $status }}</option>
                @endforeach
            </select>
            @error('status') <div class="attendance-error">{{ $message }}</div> @enderror
        </div>
        <div class="attendance-field">
            <label for="time_in">Time in</label>
            <input id="time_in" type="time" name="time_in" value="{{ old('time_in', $attendance?->time_in?->format('H:i')) }}">
            @error('time_in') <div class="attendance-error">{{ $message }}</div> @enderror
        </div>
        <div class="attendance-field">
            <label for="time_out">Time out</label>
            <input id="time_out" type="time" name="time_out" value="{{ old('time_out', $attendance?->time_out?->format('H:i')) }}">
            @error('time_out') <div class="attendance-error">{{ $message }}</div> @enderror
        </div>
        <div class="attendance-field wide">
            <label for="remarks">Remarks</label>
            <textarea id="remarks" name="remarks" maxlength="2000">{{ old('remarks', $attendance?->remarks) }}</textarea>
            @error('remarks') <div class="attendance-error">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="attendance-form-actions">
        <button class="attendance-button primary" type="submit">{{ $isEditing ? 'Save changes' : 'Create record' }}</button>
        <a class="attendance-button" href="{{ route('attendance.index') }}">Cancel</a>
    </div>
</form>
