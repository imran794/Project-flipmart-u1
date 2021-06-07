<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

        public function brand(){
       return $this->belongsTo(Brand::class);
   }
    
       public function category(){
       return $this->belongsTo(Category::class);
   }

   public function subcategory(){
    return $this->belongsTo(Subcategory::class);
    }
    public function subsubcategory(){
    return $this->belongsTo(Subsubcategory::class);
    }

     function Multipleimage(){
        return $this ->hasMany(Multipleimage::clsss);
    }
}
