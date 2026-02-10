@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/setup.css') }}">
@endsection

@section('content')
<div class="profile-setup-container">
    <h1 class="page-title">プロフィール設定</h1>

    <form method="post" action="/profile/setup" enctype="multipart/form-data" class="profile-form">
        @csrf

        <div class="form-group profile-image-section">
            <div class="image-preview">
                <div class="preview-circle"></div>
            </div>
            <label for="image" class="select-image-btn">画像を選択する</label>
            <input type="file" name="image" id="image" class="hidden-file-input">
        </div>

        <div class="form-group">
            <label class="input-label">ユーザー名</label>
            <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label class="input-label">郵便番号</label>
            <input type="text" name="zip_code" class="form-input" value="{{ old('zip_code') }}" required>
        </div>

        <div class="form-group">
            <label class="input-label">住所</label>
            <input type="text" name="address" class="form-input" value="{{ old('address') }}" required>
        </div>

        <div class="form-group">
            <label class="input-label">建物名</label>
            <input type="text" name="building" class="form-input" value="{{ old('building') }}">
        </div>

        <button type="submit" class="submit-btn">更新する</button>
    </form>
</div>
<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.querySelector('.preview-circle');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.style.backgroundImage = `url(${e.target.result})`;
                preview.style.backgroundSize = 'cover';
                preview.style.backgroundPosition = 'center';
                preview.textContent = '';
            }

            reader.readAsDataURL(file);
        }
    });
</script>
@endsection