<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded = [];

    public function brands()
    {
        return $this->hasOne(Brand::class, 'id', 'brand')->withTrashed();
    }
    public function units()
    {
        return $this->hasOne(Unit::class, 'id', 'unit')->withTrashed();
    }
    public function shop_types()
    {
        return $this->hasOne(ShopCategory::class, 'id', 'shop_type')->withTrashed();
    }
}
