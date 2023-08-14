<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'area_management';
    public $timestamps = false;
    protected $fillable = [
'state_id','city_id','area_name','area_code','short_name','created_at','created_by','modified_at','modified_by'
        ];
}
