@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/success.css') }}">
@endsection

@section('content')
<div class="success-outer">
    <div class="success-container">
        <h2 class="success-title">ご購入ありがとうございます</h2>
        <div class="success-message">
            <p>「<strong>{{ $item->item_name }}</strong>」の決済が完了しました。</p>
        </div>
        <div class="navigation">
            <a href="{{ route('index') }}" class="btn-home">トップページへ戻る</a>
        </div>
    </div>
</div>
@endsection