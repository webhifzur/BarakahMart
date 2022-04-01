<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['invoice_date','customer_type','customer_id','customer_phone','subTotal','cash','pre_ammount','total', 'return_taka','due','created_by'];

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id')->withTrashed();
    }

    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }
}
