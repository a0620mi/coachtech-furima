@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
<div class="verify-email-wrapper">
    <div class="verify-email-container">
        <p class="verification-text">
            登録していただいたメールアドレスに認証メールを送付しました。<br>
            メール認証を完了してください。
        </p>
        @if (session('status') == 'verification-link-sent')
        <div class="status-message">
            新しい認証リンクを送信しました。
        </div>
        @endif
        <div class="action-buttons">
            <button class="main-action-btn">認証はこちらから</button>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-resend">認証メールを再送する</button>
            </form>

            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">ログアウト</button>
            </form>
        </div>
    </div>
</div>
@endsection