<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    protected $fillable = [
        'user_id',
        'item_name',
        'price',
        'brand',
        'description',
        'category',
        'image_url',
        'condition',
        'is_sold',
        'category',
    ];

    public function favoriteItems()
    {
        return $this->hasMany(Favorite::class);
    }

    public function isFavoritedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }
        return $this->favoriteItems()->where('user_id', $user->id)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
