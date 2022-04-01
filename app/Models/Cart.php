<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    use HasFactory;

    function relationship_with_cart()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
