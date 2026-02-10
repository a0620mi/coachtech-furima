@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="index-container">
    <nav class="tab-nav">
        <a href="{{ route('index', ['tab' => 'recommended']) }}"
            class="tab-item {{ $tab == 'recommended' ? 'active' : '' }}">おすすめ</a>
        <a href="{{ route('index', ['tab' => 'mylist']) }}"
            class="tab-item {{ $tab == 'mylist' ? 'active' : '' }}">マイリスト</a>
    </nav>

    <div class="item-grid">
        @foreach($items as $item)
        <div class="item-card">
            <a href="{{ route('item.show', $item->id) }}">
                <div class="item-image">
                    <img src="{{ str_starts_with($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}" alt="{{ $item->item_name }}">
                </div>
                <div class="item-info">
                    <p class="item-name">{{ $item->item_name }}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection