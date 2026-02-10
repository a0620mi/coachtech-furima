<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtech-furima</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <div class="header-container">
            <a href="/" class="header-logo">
                <img src="{{ asset('logo.png') }}" alt="COACHTECH FURIMA" width="200">
            </a>

            @if (!Route::is('login', 'register', 'verification.notice'))
            <form action="{{ route('index') }}" method="get" class="search-form">
                @csrf
                <input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="なにをお探しですか？">
            </form>

            <nav class="header-nav">
                <ul class="nav-list">
                    @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link-btn">ログアウト</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('mypage') }}" class="nav-link">マイページ</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">ログイン</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">会員登録</a>
                    </li>
                    @endauth

                    {{-- 出品ボタン (誰でも表示されるが、リンク先を調整) --}}
                    <li class="nav-item">
                        <a href="{{ auth()->check() ? route('item.create') : route('login') }}" class="btn-sell">出品</a>
                    </li>
                </ul>
            </nav>
            @endif
        </div>
    </header>
    @yield('content')
</body>

</html>