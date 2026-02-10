@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<main class="item-detail-container">
    <div class="detail-inner">
        <div class="detail-image-box">
            <img src="{{ str_starts_with($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}" alt="{{ $item->item_name }}">
        </div>

        <section class="detail-info-box">
            <div class="info-header">
                <h1 class="item-title">{{ $item->item_name }}</h1>
                <p class="item-brand">{{ $item->brand ?? 'ブランド名' }}</p>
                <p class="item-price">¥{{ number_format($item->price) }}<span>（税込）</span></p>

                <div class="action-stats">
                    <div class="stat-item">
                        @auth
                        <form action="{{ route('action.favorite.toggle', $item) }}" method="post">
                            @csrf
                            <button type="submit" class="icon-btn">
                                <img src="{{ $item->isFavoritedBy(auth()->user()) ? asset('img/favorite.png') : asset('img/favorite_default.png') }}" alt="お気に入り">
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="icon-btn">
                            <img src="{{ asset('img/favorite_default.png') }}" alt="お気に入り">
                        </a>
                        @endauth
                        <span class="stat-count">{{ $item->favoriteItems->count() }}</span>
                    </div>
                    <div class="stat-item">
                        <a href="#comment-section" class="icon-btn">
                            <img src="{{ asset('img/comment.png') }}" alt="コメント">
                        </a>
                        <span class="stat-count">{{ $item->comments ? $item->comments->count() : 0 }}</span>
                    </div>
                </div>
            </div>
            <div class="buy-action">
                @auth
                <a href="{{ route('purchase.show', $item->id) }}" class="btn-purchase">購入手続きへ</a>
                @else
                <a href="{{ route('login') }}" class="btn-purchase">購入手続きへ</a>
                @endauth
            </div>
            <div class="detail-section">
                <h2 class="section-title">商品説明</h2>
                <div class="item-description">{{ $item->description }}</div>
            </div>

            <div class="detail-section">
                <h2 class="section-title">商品の情報</h2>
                <div class="info-table">
                    <div class="info-row">
                        <span class="info-label">カテゴリー</span>
                        <div class="info-content">
                            <span class="category-badge">{{ $item->category }}</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <span class="info-label">商品の状態</span>
                        <div class="info-content">{{ $item->condition }}</div>
                    </div>
                </div>
            </div>

            <div id="comment-section" class="detail-section">
                <h2 class="section-title">コメント ({{ $item->comments ? $item->comments->count() : 0 }})</h2>

                <div class="comment-list">
                    @if($item->comments)
                    @foreach($item->comments as $comment)
                    <div class="comment-item">
                        <div class="comment-user">
                            <div class="user-avatar">
                                @if($comment->user->image)
                                <img src="{{ asset('storage/' . $comment->user->image) }}" alt="ユーザーアイコン">
                                @else
                                <div class="default-avatar"></div>
                                @endif
                            </div>
                            <span class="user-name">{{ $comment->user->name }}</span>
                        </div>
                        <div class="comment-bubble">
                            {{ $comment->content }}
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <div class="comment-form-area">
                    <p class="form-label">商品へのコメント</p>
                    <form action="{{ route('action.store', $item) }}" method="post">
                        @csrf
                        <textarea name="content" class="comment-textarea" required></textarea>
                        <button type="submit" class="btn-comment-submit">コメントを送信する</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection