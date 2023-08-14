<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductManager extends Model
{
    use HasFactory;
    protected $table = 'product_management';
    public $timestamps = false;
    protected $fillable = [
            'vendor_id',
            'product_name',
            'rack',
            'category_id',
            'variation_type',
            'size',
            'color',
            'purchase_price',
            'sell_price',
            'product_desc',
            'product_weight',
            'product_image',
            'created_by',
            'created_date',
            'modified_by',
            'modified_date',
            'status',
            
        ];
}
