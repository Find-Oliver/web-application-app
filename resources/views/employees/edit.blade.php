@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <a href="{{ route('employees.show', $employee) }}" style="color: var(--primary-dark); text-decoration: none;">Back to employee</a>
        <div class="page-title" style="margin-top: 10px;">Edit employee</div>
        <div class="page-subtitle">Update {{ $employee->full_name_with_suffix }}'s record.</div>
    </div>

    @include('employees._form')
@endsection
