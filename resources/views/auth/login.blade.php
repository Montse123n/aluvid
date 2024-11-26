@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="text-center mb-4">
    <h3>{{ __('Aluvid') }}</h3>
    <p>{{ __('Inicia sesion') }}</p>
</div>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email -->
    <div class="mb-4">
        <label for="email" class="form-label fw-bold">{{ __('Email Address') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-4">
        <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="mb-3 form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label small text-secondary" for="remember">{{ __('Remember Me') }}</label>
    </div>

    <!-- Submit Button -->
    <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg">{{ __('Login') }}</button>
    </div>

    <!-- Forgot Password -->
    @if (Route::has('password.request'))
        <div class="auth-footer mt-3">
            <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
        </div>
    @endif
</form>

<div class="auth-footer mt-4">
    <p class="mb-0">{{ __("Don't have an account?") }} 
        <a href="{{ route('register') }}">{{ __('Sign up') }}</a>
    </p>
</div>
@endsection
