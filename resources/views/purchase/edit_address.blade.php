@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_address.css') }}">
@endsection

@section('content')
<main class="address-edit-container">
    <h2 class="page-title">住所の変更</h2>

    <form action="{{ route('purchase.address.update', $item->id) }}" method="post" class="h-adr address-form">
        @csrf
        <span class="p-country-name" style="display:none;">Japan</span>

        <div class="form-group">
            <label for="zip_code" class="input-label">郵便番号</label>
            <input type="text" name="zip_code" id="zip_code" class="form-input p-postal-code" value="{{ old('zip_code', $user->zip_code) }}" required>
        </div>

        <div class="form-group">
            <label for="address" class="input-label">住所</label>
            <input type="text" name="address" id="address" class="form-input p-region p-locality p-street-address p-extended-address" value="{{ old('address', $user->address) }}" required>
        </div>

        <div class="form-group">
            <label for="building" class="input-label">建物名</label>
            <input type="text" name="building" id="building" class="form-input" value="{{ old('building', $user->building) }}">
        </div>

        <button type="submit" class="btn-update">更新する</button>
    </form>
</main>
@endsection