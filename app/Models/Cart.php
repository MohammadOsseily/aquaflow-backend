<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function cart_item(): HasMany
    {
        return $this->hasMany(Cart_Item::class);
    }
}
