<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Multipleimage extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    function get_multiple_photo(){
        return $this ->hasMany('App\MultipleImage','product_id','id');
    }

   
   }