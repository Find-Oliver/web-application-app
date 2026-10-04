@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <a href="{{ route('attendance.index') }}" style="color: var(--primary-dark); text-decoration: none;">Back to attendance</a>
        <div class="page-title" style="margin-top: 10px;">Edit attendance</div>
        <div class="page-subtitle">Update {{ $attendance->employee->full_name_with_suffix }}'s record for {{ $attendance->attendance_date->format('M j, Y') }}.</div>
    </div>

    @include('attendance._form')
@endsection
