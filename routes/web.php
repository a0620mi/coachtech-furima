<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\PurchaseController;



Route::get('/', [ItemController::class, 'index'])->name('index');
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::middleware(['auth', 'verified'])->group(
    function ()
    {
        Route::get('/profile/setup', [ProfileController::class, 'create'])->name('profile.setup');
        Route::post('/profile/setup', [ProfileController::class, 'store'])->name('profile.store');

        Route::post('/item/{item}/favorite', [ActionController::class, 'toggle'])->name('action.favorite.toggle');
        Route::post('/item/{item}/comment', [ActionController::class, 'store'])->name('action.store');

        Route::get('/mylist', [ItemController::class, 'mylist'])->name('item.mylist');

        Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
        Route::get('/mypage/profile', [MypageController::class, 'edit'])->name('profile.edit');
        Route::post('/mypage/profile', [MypageController::class, 'update'])->name('profile.update');

        Route::get('/sell', [ItemController::class, 'create'])->name('item.create');
        Route::post('/sell', [ItemController::class, 'store'])->name('item.store');

        Route::post('/logout', function()
        {
            auth()->guard()->logout();
            return redirect()->route('login');
        })->name('logout');

        Route::get('purchase/{item_id}', [PurchaseController::class, 'show'])->name('purchase.show');
        Route::post('/purchase/{item_id}/checkout', [PurchaseController::class, 'checkout'])->name('purchase.checkout');
        Route::get('/purchase/success/{item_id}', [PurchaseController::class, 'success'])->name('purchase.success');
        Route::get('/purchase/cancel/{item_id}', [PurchaseController::class, 'cancel'])->name('purchase.cancel');
        Route::get('/purchase/address/{item_id}', [ProfileController::class, 'editAddress'])->name('purchase.address.edit');
        Route::post('/purchase/address/{item_id}', [ProfileController::class, 'updateAddress'])->name('purchase.address.update');
    }
);
