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
    		'products'		=> Product::latest()->get(),
        
    	]);
    }

    public function productview($id)
    {
    	return view('backend.product.view',[
    		'edit_data'			=> Product::findOrFail($id),
    		'brands'	    	=> Brand::latest()->get(),
    	    'categories'		=> Category::latest()->get(),
    	    'multiple_images'	=> Multipleimage::where('product_id',$id)->latest()->get()
   
    		
    	]);
    }

    public function productsoft($id)
    {
        Product::findOrFail($id)->delete();
         $notification=array(
            'message'=>'Products Soft Delete Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('manage.product')->with($notification);
    }

    public function productrestore($id)
    {
        Product::withTrashed()->where('id','=',$id)->restore();
        $notification=array(
            'message'=>'Products Restore Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('manage.product')->with($notification);
    }

    public function productdelete($id)
    {
        // $brand = Product::findOrFail($id);
         // $image = $brand->brand_image;
         // unlink($image);
        Product::withTrashed()->where('id','=',$id)->forcedelete();

            $notification=array(
            'message'=>'Products Delete Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function productinactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
          $notification=array(
            'message'=>'Product Inactive Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('manage.product')->with($notification);
    } 

      public function productactive($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
          $notification=array(
            'message'=>'Product Active Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('manage.product')->with($notification);
    }



    public function productedit($id)
    {
        return view('backend.product.edit',[
            'edit_data'         => Product::findOrFail($id),
            'brands'            => Brand::latest()->get(),
            'categories'        => Category::latest()->get(),
            'multiple_images'   => Multipleimage::where('product_id',$id)->latest()->get()
        ]);
    }

    public function productpostedit(Request $request)
    {
        $request->validate([
            'brand_id'               => 'required',
            'category_id'            => 'required',
            'subcategory_id'         => 'required',
            'subsubcategory_id'      => 'required',
            'product_name'           => 'required',
            'price'                  => 'required',
            'product_code'           => 'required',
            'product_qty'            => 'required',
            'product_tag'            => 'required',
            'shot_des'               => 'required',
            'long_des'               => 'required'
        ]);

        $product_id = $request->id;
        

             Product::findOrFail($product_id)->update([
            'brand_id'               => $request->brand_id,
            'category_id'            => $request->category_id,
            'subcategory_id'         => $request->subcategory_id,
            'subsubcategory_id'      => $request->subsubcategory_id,
            'product_name'           => $request->product_name,
            'price'                  => $request->price,
            'discount_price'         => $request->discount_price,
            'product_code'           => $request->product_code,
            'product_qty'            => $request->product_qty,
            'product_tag'            => $request->product_tag,
            'product_size'           => $request->product_size,
            'shot_des'               => $request->shot_des,
            'long_des'               => $request->long_des,
            'hot_deals'              => $request->hot_deals,
            'featured'               => $request->featured,
            'special_offer'          => $request->special_offer,
            'special_deals'          => $request->special_deals,
            'updated_at'             => carbon::now()

        ]);

    }

    public function thumpnilimageupdate(Request $request)
    {  
        $old_image = $request->old_image;
        $id = $request->id;
        $productImage = Product::where('id',$id)->value('thumbnail_image');

        if ($productImage) {
             unlink($old_image);
                 $image = $request->file('thumbnail_image');
                $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(917,1000)->save('upload/productimage/'.$name_gen);
                $save_url = 'upload/productimage/'.$name_gen;

                Product::findOrFail($id)->update([
                    'thumbnail_image' => $save_url,
                'updated_at' => Carbon::now(),

            ]);
            $notification=array(
            'message'=>'Product update Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->route('manage.product')->with($notification);
             }

        
        else{
             $image = $request->file('thumbnail_image');
                $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(917,1000)->save('upload/productimage/'.$name_gen);
                $save_url = 'upload/productimage/'.$name_gen;

                Product::findOrFail($id)->update([
                    'thumbnail_image' => $save_url,
                    'updated_at' => Carbon::now(),

            ]);
                   $notification=array(
            'message'=>'Product insert Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('manage.product')->with($notification);
        }


}

// update multiple images

public function updateproductimage(Request $request)
{
    $images = $request->multiimg;

    foreach ($images as $id => $image) {
         $imgdel = Multipleimage::findOrFail($id);
          unlink($imgdel->multi_img);
       $make_name = hexdec(uniqid()).'.'.$image->extension();
        Image::make($image)->resize(917,1000)->save('upload/multiimage/'.$make_name);
        $uplodPath = 'upload/multiimage/'.$make_name;
         

        Multipleimage::where('id',$id)->update([
            'multi_img' => $uplodPath,
            'updated_at' => Carbon::now(),
        ]);



         $notification=array(
            'message'=>'Product Image Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }
}
   







}
