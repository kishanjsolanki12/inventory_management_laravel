<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'country_master';
    public $timestamps = false;
    protected $fillable = [
'country_name','country_code','short_name','created_at','created_by','modified_at','modified_by'
        ];
}
