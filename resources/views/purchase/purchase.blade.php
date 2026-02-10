@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<main class="purchase-container">
    <form action="{{ route('purchase.checkout', $item->id) }}" method="POST" id="checkout-form">
        @csrf
        <div class="purchase-grid">
            <div class="item-summary">
                <div class="product-info">
                    <div class="product-image">
                        <img src="{{ str_starts_with($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}" alt="{{ $item->item_name }}">
                    </div>
                    <div class="product-details">
                        <h2 class="product-name">{{ $item->item_name }}</h2>
                        <p class="product-price">¥{{ number_format($item->price) }}</p>
                    </div>
                </div>

                <div class="purchase-section">
                    <h3 class="section-title">支払い方法</h3>
                    <div class="select-wrapper">
                        <select name="payment_method" id="payment_method" required onchange="updatePaymentMethod()">
                            <option value="" disabled selected>選択してください</option>
                            <option value="コンビニ払い">コンビニ払い</option>
                            <option value="カード支払い">カード支払い</option>
                        </select>
                    </div>
                </div>

                <div class="purchase-section">
                    <div class="section-header">
                        <h3 class="section-title">配送先</h3>
                        <a href="{{ route('purchase.address.edit', $item->id) }}" class="link-edit">変更する</a>
                    </div>
                    <div class="address-info">
                        <p class="zip-code">〒 {{ $user->zip_code }}</p>
                        <p class="address-text">{{ $user->address }} {{ $user->building }}</p>
                    </div>
                </div>
            </div>

            <div class="order-action">
                <div class="status-table">
                    <div class="status-row">
                        <span class="status-label">商品代金</span>
                        <span class="status-value">¥{{ number_format($item->price) }}</span>
                    </div>
                    <div class="status-row">
                        <span class="status-label">支払い方法</span>
                        <span class="status-value" id="display-method">未選択</span>
                    </div>
                </div>

                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <button type="submit" class="btn-purchase-submit">購入する</button>
            </div>
        </div>
    </form>
</main>

<script>
    function updatePaymentMethod() {
        const select = document.getElementById('payment_method');
        const display = document.getElementById('display-method');
        display.innerText = select.value;
    }
</script>
@endsection