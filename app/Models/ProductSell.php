<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSell extends Model
{
    use HasFactory;
    protected $table = 'product_sell';
    public $timestamps = false;
    protected $fillable = [
            'product_id',
            'vendor_id',
            'supplier_id',
            'qty',
            'sell_amount',
            'sell_total_amount',
            'variation_type',
            'size',
            'color',
            'product_desc',
            'product_weight',
            'modified_date',
            'status',
            
        ];
}
