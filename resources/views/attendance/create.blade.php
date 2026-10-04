@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <a href="{{ route('attendance.index') }}" style="color: var(--primary-dark); text-decoration: none;">Back to attendance</a>
        <div class="page-title" style="margin-top: 10px;">Add attendance</div>
        <div class="page-subtitle">Record an employee's attendance for a date.</div>
    </div>

    @include('attendance._form', ['attendance' => null])
@endsection
