<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    public function count()
    {
        return $this->products->count();
    }

    public function amount()
    {
        return $this->products->sum('price');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('id');
    }
}
