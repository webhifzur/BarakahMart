<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expence extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['type','taka', 'created_by'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }
}
