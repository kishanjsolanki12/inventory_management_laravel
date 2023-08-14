<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $table = 'product_review';
    public $timestamps = false;
    protected $fillable = [
            'product_id',
            'user_id',
            'rate',
            'review',
            'created_by',
            'created_date',
            'modified_by',
            'modified_date',
            'status',
            
            
        ];
}
