@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="card" style="max-width: 980px; margin: 0 auto;">
    <div class="card-body">
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 32px; flex-wrap: wrap;">
            @if ($user->profile_picture)
                <img src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->name }}" style="width: 88px; height: 88px; border-radius: 50%; object-fit: cover; border: 3px solid #d9f2ef; background: #eefaf7;">
            @else
                <div style="width: 88px; height: 88px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #0d9488, #14b8a6); color: white; font-size: 28px; font-weight: 700;">
                    {{ strtoupper(Str::substr($user->name, 0, 1)) }}
                </div>
            @endif

            <div>
                <div style="font-size: 12px; letter-spacing: .08em; text-transform: uppercase; color: #64748b; font-weight: 700;">Account</div>
                <h2 style="margin: 6px 0 4px; font-size: 30px;">{{ $user->name }}</h2>
                <div style="color: #475569;">{{ $user->email }}</div>
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 18px;">
                <div class="form-group">
                    <label for="name">Full name</label>
                    <input id="name" name="name" type="text" class="input" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" name="email" type="email" class="input" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" type="text" class="input" value="{{ old('phone', $user->phone) }}">
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" class="input">
                        <option value="">Select gender</option>
                        <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" class="input" rows="3">{{ old('address', $user->address) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="date_of_birth">Date of birth</label>
                    <input id="date_of_birth" name="date_of_birth" type="date" class="input" value="{{ old('date_of_birth', optional($user->date_of_birth)->format('Y-m-d')) }}">
                </div>

                <div class="form-group">
                    <label for="profile_picture">Profile photo</label>
                    <input id="profile_picture" name="profile_picture" type="file" class="input" accept="image/*">
                    <div class="form-hint">PNG, JPG, or WEBP up to 2MB.</div>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px;">
                <button type="submit" class="btn btn-primary">Save profile</button>
            </div>
        </form>
    </div>
</div>
@endsection
