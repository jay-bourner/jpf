@extends('layouts.login')

@section('content')
<div class="login-section">
    <div class="login-form-section">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            <div class="jp-form-group">
                <label for="email">E-mail address</label>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="jp-form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="jp-form-group submit-btn">
                <button type="submit" class="jp-btn jp-btn--md jp-btn-grn">Login</button>
            </div>
            
            <div class="login-form-footer">
                <div class="jp-form-group">
                    <label for="remember">
                        <input class="jp-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember Me</span>
                    </label>
                </div>
                <div class="jp-form-group">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
