@extends('auth.layout')

@section('title', 'Forgot Password')

@section('content')
    <div class="auth-header">
        <img src="{{ asset('images/emsLogo.png') }}" alt="EMS Logo" class="auth-logo" style="width: 260px; max-width: 100%; height: auto; object-fit: contain; display: block; margin: 0 auto 18px;">
        <div class="auth-title">Forgot Password?</div>
        <div class="auth-subtitle">We'll help you reset it</div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <p style="color: #718096; font-size: 14px; margin-bottom: 20px;">
        Enter your email address and we'll send you a link to reset your password.
    </p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="admin@example.com"
                required
                autofocus
            >
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Send Reset Link</button>
    </form>

    <div class="divider">OR</div>

    <div class="auth-link">
        Remember your password? <a href="{{ route('login') }}">Sign in</a>
    </div>
@endsection
