<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ExhibitionRequest;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tab = $request->query('tab', 'recommended');

        if ($tab === 'buy' || $tab === 'sell') {
            if (!$user) {
                return redirect()->route('login');
            }

            $items = ($tab === 'buy') ? $user->purchasedItems()->get() : $user->items()->get();
            return view('item.mypage', compact('user', 'items', 'tab'));
        }

        $keyword = $request->input('keyword');

        if ($tab === 'mylist' && Auth::check($user)) {
            $query = $user->favoriteItems();
        } else {
            $query = Item::query();
        }

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('item_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('brand', 'LIKE', "%{$keyword}%");
            });
        }

        $items = $query->get();

        return view('item.index', compact('items', 'tab', 'keyword'));
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        if (!str_contains(url()->previous(), 'favorite')) {
            session(['original_list_url' => url()->previous()]);
        }

        return view('item.show', compact('item'));
    }

    public function mylist()
    {
        $items = Auth::user()->favorites;
        return view('item.index', compact('items'));
    }

    public function create()
    {
        $categories = [
            'ファッション',
            '家電',
            'インテリア',
            'レディース',
            'メンズ',
            'コスメ',
            '本',
            'ゲーム',
            'スポーツ',
            'キッチン',
            'ハンドメイド',
            'アクセサリー',
            'おもちゃ',
            'ベビー・キッズ',
        ];

        $conditions = [
            '良好',
            '目立った傷や汚れなし',
            'やや傷や汚れあり',
            '状態が悪い',
        ];

        return view('item.create', compact('categories', 'conditions'));
    }

    public function store(ExhibitionRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img/items', 'public');
        }

        Item::create([
            'user_id' => Auth::user()->id,
            'item_name' => $request->item_name,
            'brand' => $request->brand,
            'price' => $request->price,
            'condition' => $request->condition,
            'category' => $request->category,
            'description' => $request->description,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('index');
    }
}
