@extends('auth.layout')

@section('title', 'Login')

@section('content')
    <div class="auth-header">
        <img src="{{ asset('images/emsLogo.png') }}" alt="EMS Logo" style="width: 260px; max-width: 100%; height: auto; object-fit: contain; display: block; margin: 0 auto 18px;">
        <div class="auth-title">Welcome Back</div>
        <div class="auth-subtitle">Sign in to your account</div>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
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

        <div class="form-group form-checkbox">
            <input type="checkbox" id="remember" name="remember" value="1">
            <label for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn btn-primary">Sign In</button>
    </form>

    <div class="auth-link">
        <a href="{{ route('password.request') }}">Forgot your password?</a>
    </div>

    <div class="divider">OR</div>

    <div class="auth-link">
        Don't have an account? <a href="{{ route('register') }}">Create one</a>
    </div>

    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0; font-size: 13px; color: #718096;">
        <p><strong>Demo Credentials:</strong></p>
        <p>Admin: admin@example.com</p>
        <p>Employee: employee@example.com</p>
        <p>Password: ChangeThisPassword123!</p>
    </div>
@endsection
