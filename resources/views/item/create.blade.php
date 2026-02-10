@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="create-container">
    <h1 class="page-title">商品の出品</h1>

    <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data" class="create-form">
        @csrf

        <div class="form-section">
            <h2 class="input-label-main">商品画像</h2>
            <div class="image-upload-box">
                <div id="preview-container">
                    <img id="image-preview" src="" style="display: none;">
                </div>
                <label class="btn-select-image">
                    画像を選択する
                    <input type="file" name="image" id="item-image" onchange="previewItemImage(this)" style="display: none;">
                </label>
            </div>
        </div>

        <div class="form-section">
            <h2 class="section-title">商品の詳細</h2>

            <div class="form-group">
                <label class="input-label">カテゴリー</label>
                <div class="category-grid">
                    @foreach($categories as $cat)
                    <div class="category-item">
                        <input type="radio" name="category" value="{{ $cat }}" id="cat-{{ $loop->index }}" class="category-input">
                        <label for="cat-{{ $loop->index }}" class="category-label">{{ $cat }}</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label class="input-label" for="condition">商品の状態</label>
                <div class="select-wrapper">
                    <select name="condition" id="condition" class="form-select">
                        <option value="" disabled selected>選択してください</option>
                        @foreach($conditions as $cond)
                        <option value="{{ $cond }}">{{ $cond }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2 class="section-title">商品名と説明</h2>

            <div class="form-group">
                <label class="input-label">商品名</label>
                <input type="text" name="item_name" class="form-input" placeholder="商品名を入力してください">
            </div>

            <div class="form-group">
                <label class="input-label">ブランド名</label>
                <input type="text" name="brand" class="form-input" placeholder="ブランド名を入力してください">
            </div>

            <div class="form-group">
                <label class="input-label">商品の説明</label>
                <textarea name="description" class="form-textarea" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label class="input-label">販売価格</label>
                <div class="price-input-container">
                    <span class="currency-unit">¥</span>
                    <input type="number" name="price" class="form-input price-input" placeholder="0">
                </div>
            </div>
        </div>

        <button type="submit" class="btn-submit">出品する</button>
    </form>
</div>

<script>
    function previewItemImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection