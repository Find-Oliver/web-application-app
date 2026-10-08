@extends('auth.layout')

@section('title', 'Register')
@section('body-class', 'auth-page-register')

@section('content')
    <div class="auth-header">
        <img src="{{ asset('images/emsLogo.png') }}" alt="EMS Logo" class="auth-logo">
        <h1 class="auth-title">Create Account</h1>
        <p class="auth-subtitle">Join our organization and manage employee operations with confidence.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form id="register-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Full Name</label>
            <div class="input-wrap">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 12.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-6 7a6 6 0 0 1 12 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="John Doe"
                    autocomplete="name"
                    aria-describedby="@error('name') name-error @enderror"
                    @error('name') aria-invalid="true" @enderror
                    required
                    autofocus
                >
            </div>
            @error('name')
                <div class="form-error" id="name-error">{{ $message }}</div>
            @enderror
        </div>

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
                    placeholder="john@example.com"
                    autocomplete="email"
                    aria-describedby="@error('email') email-error @enderror"
                    @error('email') aria-invalid="true" @enderror
                    required
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
                    placeholder="Create a strong password"
                    autocomplete="new-password"
                    aria-describedby="@error('password') password-error @enderror"
                    @error('password') aria-invalid="true" @enderror
                    required
                >
                <button type="button" class="password-toggle" data-target="password" aria-label="Show password" aria-pressed="false">
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

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <div class="input-wrap">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <rect x="4.5" y="10" width="15" height="10" rx="2" stroke="currentColor" stroke-width="1.7"/>
                    <path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                    <circle cx="12" cy="15" r="1" fill="currentColor"/>
                </svg>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="password-input"
                    placeholder="Re-enter your password"
                    autocomplete="new-password"
                    required
                >
                <button type="button" class="password-toggle" data-target="password_confirmation" aria-label="Show password" aria-pressed="false">
                    <svg viewBox="0 0 24 24" width="19" height="19" fill="none" aria-hidden="true">
                        <path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.7"/>
                    </svg>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" id="register-button">
            <span class="button-label">Create Account</span>
        </button>
    </form>

    <div class="divider">OR</div>

    <div class="auth-link register-link">
        Already have an account? <a href="{{ route('login') }}">Sign in</a>
    </div>

    <footer class="auth-footer">Employee Management System &middot; &copy; {{ date('Y') }}</footer>

    <script>
        document.querySelectorAll('.password-toggle').forEach((toggle) => {
            toggle.addEventListener('click', () => {
                const targetId = toggle.dataset.target;
                const input = document.getElementById(targetId);
                const isVisible = input.type === 'text';
                input.type = isVisible ? 'password' : 'text';
                toggle.setAttribute('aria-pressed', String(!isVisible));
                toggle.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');
            });
        });
    </script>
@endsection
