@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <a href="{{ route('employees.index') }}" style="color: var(--primary-dark); text-decoration: none;">Back to employees</a>
        <div class="page-title" style="margin-top: 10px;">Add employee</div>
        <div class="page-subtitle">Enter the employee's personal and job details.</div>
    </div>

    @include('employees._form', ['employee' => null])
@endsection
