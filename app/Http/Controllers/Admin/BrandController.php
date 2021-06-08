<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;
use Carbon\Carbon;
use Str;

class BrandController extends Controller
{
    public function brand()
    {

    	return view('backend.brand.index',[
    	   'brands'		=> Brand::latest()->get(),
           'trashed'    => Brand::onlyTrashed()->get()

    	]);
    }

    public function brandstore(Request $request)
    {
    	$request->validate([
    		'brand_name' 	=> 'required',
    		'brand_image'	=> 'required'
    	]);

    	$brand_image = $request->file('brand_image');
    	$new_name 	 = hexdec(uniqid()).'.'.$brand_image->extension();
    	Image::make($brand_image)->resize(400,400)->save('upload/brandimage/'.$new_name);
    	$save_url = 'upload/brandimage/'.$new_name;

        $slug = Str::slug( $request->brand_name.'-'.carbon::now()->timestamp);

    	Brand::insert([
    		'brand_name' 	=> $request->brand_name,
    		'brand_image'	=> $save_url,
    		'brand_slug'	=> $slug,
    		'created_at'	=> carbon::now()

    	]);

    	  $notification=array(
            'message'=>'Brand Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

      public function adminactive($id)
    {
    	Brand::findOrFail($id)->update(['status'=> 1]);

    	$notification=array(
            'message'=>'Brand Active Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function admininactive($id)
    {
    	Brand::findOrFail($id)->update(['status'=> 0]);

    	$notification=array(
            'message'=>'Brand Inactive Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function brandsoft($id)
    {
     
        Brand::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Brand Soft Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function restore($id)
    {
        Brand::withTrashed()->where('id','=',$id)->restore();
            $notification=array(
            'message'=>'Data Restore Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
         
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
         // $image = $brand->brand_image;
         // unlink($image);
        Brand::withTrashed()->where('id','=',$id)->forcedelete();

       
        
           $notification=array(
            'message'=>'Data Delete Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

     public function edit($id)
    {
        return view('backend.brand.edit',[
            'edit_data'     => Brand::findOrFail($id)
        ]);
    }

    public function brandeditpost(Request $request)
    {
        $brand_id  = $request->id;
        $old_image = $request->old_image;

        if ($request->has('brand_image')) {
            unlink($old_image);
            $brand_image       = $request->file('brand_image');
            $new_name          = hexdec(uniqid()).'.'.$brand_image->extension();
            Image::make($brand_image)->resize(300,300)->save('upload/brandimage/'.$new_name);
            $save_url          = 'upload/brandimage/'.$new_name;

            Brand::findOrFail($brand_id)->update([
                'brand_name'    => $request->brand_name,
                'brand_image'   => $save_url,
                'updated_at'    => carbon::now()
            ]);
              
            $notification=array(
            'message'=>'Brand Data Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('brand')->with($notification);
        }

        else{
            $brand_image       = $request->file('brand_image');
            $new_name          = hexdec(uniqid().'.'.$brand_image->extension());
            Image::make($brand_image)->resize(300,300)->save('upload/brandimage/'.$new_name);
            $save_url          = 'upload/brandimage/'.$new_name;

            Brand::findOrFail($brand_id)->update([
                'brand_name'    => $request->brand_name,
                'brand_image'   => $save_url,
                'updated_at'    => carbon::now()
            ]);
              $notification=array(
            'message'=>'Brand Data Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('brand')->with($notification);

        }


    }
}
