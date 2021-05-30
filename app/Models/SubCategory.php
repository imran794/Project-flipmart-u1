<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function get_relation_category()
    {
    	return $this->belongsTo('App\models\Category','category_id');
    	

    }
}
