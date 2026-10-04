@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <div class="page-title">Edit Announcement</div>
        <div class="page-subtitle">Update the announcement content and visibility.</div>
    </div>

    <form action="{{ route('announcements.update', $announcement) }}" method="POST" class="form-card">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input id="title" name="title" type="text" value="{{ old('title', $announcement->title) }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="6" required>{{ old('content', $announcement->content) }}</textarea>
        </div>

        <div class="form-group checkbox-row">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Update Announcement</button>
            <a href="{{ route('announcements.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>

    <style>
        .form-card { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(15,23,42,.08); }
        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 8px; color: #334155; font-weight: 600; }
        input, textarea { width: 100%; border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px 12px; font-size: 14px; }
        textarea { resize: vertical; }
        .checkbox-row { display: flex; align-items: center; }
        .checkbox-row input { width: auto; margin-right: 8px; }
        .form-actions { display: flex; gap: 12px; flex-wrap: wrap; }
        .btn-primary, .btn-secondary { display: inline-block; padding: 10px 16px; border-radius: 8px; text-decoration: none; border: none; cursor: pointer; font-weight: 600; }
        .btn-primary { background: #4f46e5; color: white; }
        .btn-secondary { background: #e2e8f0; color: #0f172a; }
    </style>
@endsection
