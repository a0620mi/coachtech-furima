@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile_edit.css') }}">
@endsection

@section('content')
<div class="profile-edit-container">
    <h1 class="page-title">プロフィール設定</h1>

    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class="profile-form">
        @csrf

        <div class="form-group profile-image-section">
            <div class="image-preview">
                @if($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" id="preview" class="preview-circle">
                @else
                <div id="preview" class="preview-circle default-bg"></div>
                @endif
            </div>
            <label class="btn-upload">
                画像を選択する
                <input type="file" name="image" onchange="previewImage(this)" style="display: none;">
            </label>
        </div>

        <div class="form-group">
            <label class="input-label" for="name">ユーザー名</label>
            <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label class="input-label" for="zip_code">郵便番号</label>
            <input type="text" name="zip_code" id="zip_code" class="form-input" value="{{ old('zip_code', $user->zip_code) }}" required>
        </div>

        <div class="form-group">
            <label class="input-label" for="address">住所</label>
            <input type="text" name="address" id="address" class="form-input" value="{{ old('address', $user->address) }}" required>
        </div>

        <div class="form-group">
            <label class="input-label" for="building">建物名</label>
            <input type="text" name="building" id="building" class="form-input" value="{{ old('building', $user->building) }}">
        </div>

        <button type="submit" class="btn-submit">更新する</button>
    </form>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    preview.style.backgroundImage = `url(${e.target.result})`;
                    preview.style.backgroundSize = 'cover';
                    preview.style.backgroundPosition = 'center';
                    preview.classList.remove('default-bg');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection