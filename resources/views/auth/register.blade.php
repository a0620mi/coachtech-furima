@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-container">
    <div class="register-title">会員登録</div>
    <form method="post" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <div class="input-label">ユーザー名</div>
            <input type="text" class="input-field" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <div class="input-label">メールアドレス</div>
            <input type="email" class="input-field" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <div class="input-label">パスワード</div>
            <input type="password" class="input-field" name="password" required>
        </div>

        <div class="form-group">
            <label class="input-label">確認用パスワード</label>
            <input type="password" class="input-field" name="password_confirmation" required>
        </div>

        <button type="submit" class="register-button">登録する</button>
        <a href="{{ route('login') }}" class="login-link">
            ログインはこちら
        </a>
    </form>
    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection