<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded = [];
    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withTrashed();
    }

    public function product_info()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
}
