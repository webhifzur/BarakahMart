<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded = [];
    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withTrashed();
    }
    
    public function billing_details()
    {
        return $this->hasOne(Billing::class, 'id', 'billing_id');
    }

    public function shipping_details()
    {
        return $this->hasOne(Shipping::class, 'id', 'shipping_id');
    }
}
