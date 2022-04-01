<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminSell extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['admin', 'subTotal', 'cash', 'due'];

    public function adminName()
    {
        return $this->hasOne(User::class, 'id', 'admin')->withTrashed();
    }
}
