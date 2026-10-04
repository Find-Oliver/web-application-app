@extends('auth.layout')

@section('title', 'Register')

@section('content')
    <div class="auth-header">
        <img src="{{ asset('images/emsLogo.png') }}" alt="EMS Logo" class="auth-logo" style="width: 260px; max-width: 100%; height: auto; object-fit: contain; display: block; margin: 0 auto 18px;">
        <div class="auth-title">Create Account</div>
        <div class="auth-subtitle">Join our organization</div>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Full Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="John Doe"
                required
                autofocus
            >
            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="john@example.com"
                required
            >
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
            >
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="••••••••"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">Create Account</button>
    </form>

    <div class="divider">OR</div>

    <div class="auth-link">
        Already have an account? <a href="{{ route('login') }}">Sign in</a>
    </div>
@endsection
