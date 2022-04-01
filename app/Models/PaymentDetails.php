<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentDetails extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['customer_id', 'vendor_id','subTotal','cash','due', 'created_by'];

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id')->withTrashed();
    }
    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id')->withTrashed();
    }
    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

}
