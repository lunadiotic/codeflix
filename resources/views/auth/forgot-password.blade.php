@extends('layouts.auth')

@section('title', 'Forgot Password')
@section('page-title', 'Reset Password')

@section('content')
    <form class="form" action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-3 f-email">
            <input type="email" name="email" class="form-control form-email @error('email') is-invalid @enderror"
                id="InputEmail" value="{{ old('email') }}" required>
            <label for="InputEmail" class="form-label form-label-email">Email</label>
        </div>
        <button type="submit" class="btn btn-primary btn-sign-in">Send Reset Link</button>
        <div class="mt-3 text-center">
            <span class="register">Remember your password? <a href="{{ route('login') }}">Login</a></span>
        </div>
    </form>
@endsection
