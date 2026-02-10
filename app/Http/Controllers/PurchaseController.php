<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Http\Request\PurchaseRequest;
use App\Http\Requests\PurchaseRequest as RequestsPurchaseRequest;

class PurchaseController extends Controller
{
    public function show($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = Auth::user();

        return view('purchase.purchase', compact('item', 'user'));
    }

    public function checkout(PurchaseRequest $request, $item_id)
    {
        $item = Item::findOrFail($item_id);

        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentMethods = ($request->payment_method === 'konbini') ? ['konbini', 'card'] : ['card'];

        $session = Session::create([
            'payment_method_types' => $paymentMethods,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->item_name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', $item->id),
            'cancel_url' => route('purchase.cancel', $item->id),
            'metadata' => [
                'user_id' => Auth::id(),
                'item_id' => $item->id,
            ],
        ]);

        return redirect($session->url, 303);
    }

    public function success($item_id)
    {
        $item = Item::findOrFail($item_id);

        $item->update(['is_sold' => true]);

        /** @var \App\Models\User $user */
        $user = auth()->user();
        if (!$user->purchasedItems()->where('item_id', $item->id)->exists()) {
            $user->purchasedItems()->attach($item->id);
        }

        return view('purchase.success', compact('item'));
    }

    public function cancel($item_id)
    {
        return redirect()->route('purchase.show', $item_id)->with('error', '決済がキャンセルされました。');
    }
}
