@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage-container">
    <div class="profile-header">
        <div class="profile-info">
            <div class="user-icon">
                @if ($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" alt="ユーザーアイコン">
                @else
                <div class="default-avatar"></div>
                @endif
            </div>
            <h2 class="user-name">{{ $user->name }}</h2>
        </div>
        <a href="{{ route('profile.edit') }}" class="btn-edit">プロフィールを編集</a>
    </div>

    <div class="tabs">
        <a href="{{ route('mypage', ['tab' => 'sell' ]) }}"
            class="tab-item {{ request('tab') != 'buy' ? 'active' : '' }}">
            出品した商品
        </a>
        <a href="{{ route('mypage', ['tab' => 'buy' ]) }}"
            class="tab-item {{ request('tab') == 'buy' ? 'active' : '' }}">
            購入した商品
        </a>
    </div>

    <div class="item-grid">
        @forelse($items as $item)
        <div class="item-card">
            <div class="item-image">
                <img src="{{ str_starts_with($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}" alt="{{ $item->item_name }}">
            </div>
            <p class="item-name">{{ $item->item_name }}</p>
        </div>
        @empty
        <div class="empty-message">表示する商品はありません。</div>
        @endforelse
    </div>
</div>
@endsection