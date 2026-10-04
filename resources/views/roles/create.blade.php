@extends('dashboard.layout')

@section('content')
    <div class="page-header">
        <a href="{{ route('roles.index') }}" style="color: #667eea; text-decoration: none; font-weight: 500;">← Back to Roles</a>
        <div class="page-title" style="margin-top: 10px;">Create New Role</div>
        <div class="page-subtitle">Define a new role with its description and status.</div>
    </div>

    <style>
        .form-container {
            max-width: 600px;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2d3748;
            font-size: 14px;
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s ease;
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-checkbox input {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .form-checkbox label {
            cursor: pointer;
            margin: 0;
            font-weight: 500;
        }

        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #fed7d7;
            border: 1px solid #fc8181;
            color: #742a2a;
        }

        .alert-danger ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
        }

        .alert-danger li {
            margin: 4px 0;
        }

        .error {
            color: #c53030;
            font-size: 12px;
            margin-top: 4px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn-submit {
            padding: 10px 20px;
            background-color: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #5568d3;
        }

        .btn-cancel {
            padding: 10px 20px;
            background-color: #e2e8f0;
            color: #2d3748;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #cbd5e0;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit, .btn-cancel {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="form-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>❌ Please fix the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label" for="role_name">Role Name</label>
                <input
                    type="text"
                    id="role_name"
                    name="role_name"
                    class="form-input @error('role_name') border-red-500 @enderror"
                    value="{{ old('role_name') }}"
                    placeholder="e.g., HR Manager, Team Lead"
                    required>
                @error('role_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    class="form-textarea @error('description') border-red-500 @enderror"
                    placeholder="Describe the purpose and responsibilities of this role...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-checkbox">
                    <input
                        type="checkbox"
                        id="is_active"
                        name="is_active"
                        value="1"
                        @if (old('is_active') || !$errors->any()) checked @endif>
                    <label for="is_active">Activate this role immediately</label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">✓ Create Role</button>
                <a href="{{ route('roles.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
@endsection
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="input" rows="2" placeholder="What this role is for">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Permissions</label>
                <div class="perm-grid">
                    @forelse ($permissions as $permission)
                        <label class="perm-item">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                   {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                            {{ $permission->name }}
                        </label>
                    @empty
                        <span class="form-hint">No permissions have been set up yet.</span>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save role</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
