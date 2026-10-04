@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <div class="page-title">Add Department</div>
        <div class="page-subtitle">Create a new department for the employee system.</div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('departments.store') }}">
                @csrf

                <div class="form-group">
                    <label for="department_name">Department Name</label>
                    <input id="department_name" name="department_name" type="text" class="input" value="{{ old('department_name') }}" required>
                    @error('department_name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="input" rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="is_active">
                        <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        Active department
                    </label>
                </div>

                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button type="submit" class="btn-primary">Save Department</button>
                    <a href="{{ route('departments.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
