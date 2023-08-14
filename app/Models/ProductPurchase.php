<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    use HasFactory;
    
    protected $table = 'product_purchase';
    public $timestamps = false;
    protected $fillable = [
            'supplier_id',
            'product_id',
            'vendor_id',
            'purchase_date',
            'qty',
            'size',
            'color',
            'variation_type',
            'purchase_total_price',
            'purchase_price',
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
