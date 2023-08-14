<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'state_master';
    public $timestamps = false;
    protected $fillable = [
'country_id','state_name','state_code','short_name','created_at','created_by','modified_at','modified_by'
        ];
}
