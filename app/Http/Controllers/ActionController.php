<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Favorite;
use App\Http\Requests\CommentRequest;

class ActionController extends Controller
{
    public function toggle(Request $request, Item $item)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->favoriteItems()->toggle($item->id);

        $redirectUrl = session('original_list_url', route('index'));

        return back();
    }

    public function mylist()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $items = $user->favoriteItems()->get();

        return view('items.mylist', compact('items'));
    }

    public function store(CommentRequest $request, Item $item)
    {
        $item->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back();
    }
}

