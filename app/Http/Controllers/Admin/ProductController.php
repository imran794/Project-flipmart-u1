<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Category;
use App\models\SubCategory;
use App\models\Brand;
use App\models\SubsubCategory;
use App\models\Product;
use carbon\carbon;
use Image;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
     return view('backend.product.index',[
     	'categories'		=> Category::latest()->get(),
     	'brands'			=> Brand::latest()->get()
     ]);
    }

    public function productpost(Request $request)
    {
    	print_r($request->all());

    	$request->validate([
    		'brand_id'		  	 	 => 'required',
    		'category_id'			 => 'required',
    		'subcategory_id'		 => 'required',
    		'subsubcategory_id'		 => 'required',
    		'product_name'			 => 'required',
    		'price'					 => 'required',
    		'product_code'	      	 => 'required',
    		'product_qty'	    	 => 'required',
    		'product_tag'	    	 => 'required',
    		'shot_des'		         => 'required',
    		'long_des'				 => 'required',
    	]);

    	Product::insert([
    		'brand_id'		  	 	 => $requesrt->brand_id,
    		'category_id'			 => $requesrt->brand_id,
    		'subcategory_id'		 => $requesrt->brand_id,
    		'subsubcategory_id'		 => $requesrt->brand_id,
    		'product_name'			 => $requesrt->product_name,
    		'price'					 => 'required',
    		'product_code'	      	 => 'required',
    		'product_qty'	    	 => 'required',
    		'product_tag'	    	 => 'required',
    		'shot_des'		         => 'required',
    		'long_des'				 => 'required',

    	]);

    }
}
