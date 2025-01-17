@extends('layouts.auth')

@section('title', 'Register')
@section('page-title', 'Create Account')

@section('content')
    <form class="form" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3 f-email">
            <input type="text" name="name" class="form-control form-email @error('name') is-invalid @enderror"
                id="InputEmail" value="{{ old('name') }}" required autofocus>
            <label for="InputEmail" class="form-label form-label-email">Full Name</label>
        </div>
        <div class="mb-3 f-email">
            <input type="email" name="email" class="form-control form-email @error('email') is-invalid @enderror"
                id="InputEmail" value="{{ old('email') }}" required>
            <label for="InputEmail" class="form-label form-label-email">Email</label>
        </div>
        <div class="mb-3 f-password">
            <input type="password" name="password"
                class="form-control form-password @error('password') is-invalid @enderror" id="InputPassword" required>
            <label for="InputPassword" class="form-label form-label-password">Password</label>
            <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i>
        </div>
        <div class="mb-3 f-password">
            <input type="password" name="password_confirmation" class="form-control form-password"
                id="InputPasswordConfirmation" required>
            <label for="InputPassword" class="form-label form-label-password">Confirm Password</label>
            <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i>
        </div>
        <button type="submit" class="btn btn-primary btn-sign-in">Register</button>
        <div class="mt-3 text-center">
            <span class="register">Already have an account? <a href="{{ route('login') }}">Login</a></span>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
@endsection
