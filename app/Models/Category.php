<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    public $timestamps = false;
    protected $fillable = [
            'vendor_id',
            'category_name',
            'parent_id',
            'category_image',
            'modified_by',
            'modified_date',
            'created_at',
            'created_date',
        ];

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id', 'id');
    }

    public function _nLevelCat(){
        return $this->hasMany(Category::class, 'parent_id')->select('id','vendor_id','category_name','parent_id','category_image')->where('deleted_at',NULL)->with('_nLevelCat');
    }
    
    
}

