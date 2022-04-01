<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseInvoice extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded =[];

    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id')->withTrashed();
    }

    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }
}
