<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;

class MypageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tab = $request->query('tab', 'sell');

        if ($tab === 'buy') {
            $items = $user->purchasedItems()->get();
        } else {
            $items = $user->items()->get();
        }

        return view('item.mypage', compact('user', 'items', 'tab'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.profile_edit', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profiles', 'public');
            $user->image = $imagePath;
        }

        $user->name = $request->name;
        $user->zip_code = $request->zip_code;
        $user->address = $request->address;
        $user->building = $request->building;

        $user->save();

        return redirect()->route('mypage');
    }
}
