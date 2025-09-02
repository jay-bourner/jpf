@extends('layouts.login')

@section('content')
<div class="login-section">
    <div class="login-form-section">
        <h2>{{ __('Reset Password') }}</h2>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="jp-form-group">
                <label for="email" class="">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="jp-form-group submit-btn">
                <button type="submit" class="jp-btn jp-btn--md jp-btn-grn">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
