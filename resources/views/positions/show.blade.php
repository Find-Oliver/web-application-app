@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <div>
                <div class="page-title">Position Details</div>
                <div class="page-subtitle">{{ $position->position_name }}</div>
            </div>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <a href="{{ route('positions.edit', $position) }}" class="btn-secondary">Edit</a>
                <a href="{{ route('positions.index') }}" class="btn-primary">Back to Positions</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label>Position Name</label>
                <div class="input" style="background: #f8fafc;">{{ $position->position_name }}</div>
            </div>

            <div class="form-group">
                <label>Description</label>
                <div class="input" style="background: #f8fafc; min-height: 80px;">{{ $position->description ?: '—' }}</div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <div class="input" style="background: #f8fafc;">{{ $position->is_active ? 'Active' : 'Inactive' }}</div>
            </div>
        </div>
    </div>
@endsection
