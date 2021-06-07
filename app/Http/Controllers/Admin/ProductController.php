<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Category;
use App\models\SubCategory;
use App\models\Brand;
use App\models\SubsubCategory;
use App\models\Product;
use App\models\Multipleimage;
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
    		'long_des'				 => 'required'
    	]);

    	$image     = $request->file('thumbnail_image');
    	$new_name  = hexdec(uniqid()).'.'.$image->extension();
    	Image::make($image)->resize(917,1000)->save('upload/productimage/'.$new_name);
    	$save_url = 'upload/productimage/'.$new_name;


    	$product_id = Product::insertGetId([
    		'brand_id'		  	 	 => $request->brand_id,
    		'category_id'			 => $request->category_id,
    		'subcategory_id'		 => $request->subcategory_id,
    		'subsubcategory_id'		 => $request->subsubcategory_id,
    		'product_name'			 => $request->product_name,
    		'price'					 => $request->price,
    		'discount_price'	     => $request->discount_price,
    		'product_code'	      	 => $request->product_code,
    		'product_qty'	    	 => $request->product_qty,
    		'product_tag'	    	 => $request->product_tag,
    		'product_size'	    	 => $request->product_size,
    		'shot_des'		         => $request->shot_des,
    		'long_des'				 => $request->long_des,
    		'thumbnail_image'	     => $save_url,
    		'hot_deals'			     => $request->hot_deals,
    		'featured'			     => $request->featured,
    		'special_offer'			 => $request->special_offer,
    		'special_deals'			 => $request->special_deals,
    		'created_at'	         => carbon::now()

    	]);

    	 $images = $request->file('multi_img');
         foreach ($images as $img) {
        $make_name = hexdec(uniqid()).'.'.$img->extension();
        Image::make($img)->resize(917,1000)->save('upload/multiimage/'.$make_name);
        $uplodPath = 'upload/multiimage/'.$make_name;

        Multipleimage::insert([
            'product_id' => $product_id,
            'multi_img' => $uplodPath,
            'created_at' => Carbon::now(),
        ]);
    }

    	  $notification=array(
            'message'=>'Products Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('manage.product')->with($notification);

    }

    public function productshow()
    {
    	return view('backend.product.manage',[
    		'products'		=> Product::latest()->get()
    	]);
    }

    public function productview($id)
    {
    	return view('backend.product.view',[
    		'edit_data'			=> Product::findOrFail($id),
    		'brands'	    	=> Brand::latest()->get(),
    	    'categories'		=> Category::latest()->get(),
   
    		
    	]);
    }



   







}
