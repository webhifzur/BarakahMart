<?php

namespace App\Models;

use App\Models\ShopCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->hasOne(ShopCategory::class, 'id', 'shop_type')->withTrashed();
    }
}