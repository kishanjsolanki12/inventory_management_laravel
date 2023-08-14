<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    public $timestamps = false;
    protected $fillable = [
            'vendor_id',
            'first_name',
            'last_name',
            'email',
            'mobile',
            'address',
            'image',
            'created_by',
            'created_date',
            'modified_by',
            'modified_date',
            'status',
            
        ];


}
