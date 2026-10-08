@extends('auth.layout')

@section('title', 'Login')
@section('body-class', 'auth-page-login')

@section('content')
    <div class="auth-header">
        <img src="{{ asset('images/emsLogo.png') }}" alt="EMS Logo" class="auth-logo">
        <h1 class="auth-title">Welcome Back</h1>
        <p class="auth-subtitle">Sign in to your EMS account</p>
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

    <form id="login-form" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <div class="input-wrap">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <rect x="3.5" y="5.5" width="17" height="13" rx="2.5" stroke="currentColor" stroke-width="1.7"/>
                    <path d="m5 7 7 5.5L19 7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email address"
                    autocomplete="username"
                    aria-describedby="@error('email') email-error @enderror"
                    @error('email') aria-invalid="true" @enderror
                    required
                    autofocus
                >
            </div>
            @error('email')
                <div class="form-error" id="email-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrap">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <rect x="4.5" y="10" width="15" height="10" rx="2" stroke="currentColor" stroke-width="1.7"/>
                    <path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                    <circle cx="12" cy="15" r="1" fill="currentColor"/>
                </svg>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="password-input"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    aria-describedby="@error('password') password-error @enderror"
                    @error('password') aria-invalid="true" @enderror
                    required
                >
                <button
                    type="button"
                    class="password-toggle"
                    id="password-toggle"
                    aria-label="Show password"
                    aria-pressed="false"
                >
                    <svg viewBox="0 0 24 24" width="19" height="19" fill="none" aria-hidden="true">
                        <path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.7"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <div class="form-error" id="password-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="login-options">
            <div class="form-checkbox">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember">Remember me</label>
            </div>
            <div class="auth-link">
                <a href="{{ route('password.request') }}">Forgot password?</a>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" id="sign-in-button">
            <span class="button-label">Sign In</span>
        </button>
    </form>

    <div class="divider">OR</div>

    <div class="auth-link register-link">
        Don't have an account? <a href="{{ route('register') }}">Create one</a>
    </div>

    {{-- <details class="demo-access">
        <summary>Demo access</summary>
        <p>
            Admin: admin@example.com<br>
            Employee: employee@example.com<br>
            Password: ChangeThisPassword123!
        </p>
    </details> --}}

    <footer class="auth-footer">Employee Management System &middot; &copy; {{ date('Y') }}</footer>

    <script>
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.getElementById('password-toggle');
        const loginForm = document.getElementById('login-form');
        const signInButton = document.getElementById('sign-in-button');

        passwordToggle.addEventListener('click', () => {
            const isPasswordVisible = passwordInput.type === 'text';
            passwordInput.type = isPasswordVisible ? 'password' : 'text';
            passwordToggle.setAttribute('aria-pressed', String(!isPasswordVisible));
            passwordToggle.setAttribute('aria-label', isPasswordVisible ? 'Show password' : 'Hide password');
        });

        loginForm.addEventListener('submit', (event) => {
            if (signInButton.disabled) {
                event.preventDefault();
                return;
            }

            signInButton.disabled = true;
            signInButton.setAttribute('aria-busy', 'true');
            signInButton.querySelector('.button-label').textContent = 'Signing in…';

            const spinner = document.createElement('span');
            spinner.className = 'loading-spinner';
            spinner.setAttribute('aria-hidden', 'true');
            signInButton.append(spinner);
        });
    </script>
@endsection
