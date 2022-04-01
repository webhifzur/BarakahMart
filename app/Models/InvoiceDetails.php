<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetails extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['invoice_id','product_id','unit_price','product_qty','product_total'];
}
