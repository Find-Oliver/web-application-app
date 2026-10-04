@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <div class="page-title">Add Position</div>
        <div class="page-subtitle">Create a new employee position.</div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('positions.store') }}">
                @csrf

                <div class="form-group">
                    <label for="position_name">Position Name</label>
                    <input id="position_name" name="position_name" type="text" class="input" value="{{ old('position_name') }}" required>
                    @error('position_name')
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
                        Active position
                    </label>
                </div>

                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button type="submit" class="btn-primary">Save Position</button>
                    <a href="{{ route('positions.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
