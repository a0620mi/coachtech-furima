<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\AddressRequest;

class ProfileController extends Controller
{

    public function create()
    {
        $user = Auth::user();
        return view('profile.setup', compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profiles', 'public');
            $user->image = $path;
        }

        $user->update([
            'name' => $request->name,
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('index');
    }

    public function editAddress($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = Auth::user();
        return view('purchase.edit_address', compact('item', 'user'));
    }

    public function updateAddress(AddressRequest $request, $item_id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update([
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('purchase.show', ['item_id' => $item_id]);
    }
}
