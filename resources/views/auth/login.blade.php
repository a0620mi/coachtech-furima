@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-container">
    <h1 class="login-title">ログイン</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <div class="input-label">メールアドレス</div>
            <input id="email" type="email" class="input-field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="error-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <div class="input-label">パスワード</div>
            <input id="password" type="password" class="input-field @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="error-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="login-button">
            ログインする
        </button>
        <a class="register-link" href="{{ route('register') }}">
            会員登録はこちら
        </a>
    </form>
</div>