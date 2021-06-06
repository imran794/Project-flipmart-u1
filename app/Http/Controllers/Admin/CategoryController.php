<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Category;
use App\models\SubCategory;
use App\models\Subsubcategory;
use Carbon\Carbon;
use Str;

class CategoryController extends Controller
{
    public function indexcategory()
    {
    	return view('backend.category.index',[
    		'categories'	=> Category::latest()->get(),
    		'trashed'		=> Category::onlyTrashed()->get()
    	]);
    }

    public function categorystore(Request $request)
    {

    	$request->validate([
    		'category_icon'		=> 'required',
    		'category_name'		=> 'required|unique:categories,category_name'
 
    	]);


       $slug = Str::slug( $request->category_name.'-'.carbon::now()->timestamp);
    	Category::insert([
    		'category_icon'		=> $request->category_icon,
    		'category_name'		=> $request->category_name,
    		'category_slug'		=> $slug,
    		'created_at'		=> Carbon::now()
    	]);

    	  $notification=array(
            'message'=>'Category Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.category')->with($notification);
    }

    public function categorysoft($id)
    {
    	Category::findOrFail($id)->delete();
    	  	  $notification=array(
            'message'=>'Category soft Delete Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.category')->with($notification);

    }

    public function categoryrestore($id)
    {
    	Category::withTrashed()->where('id','=',$id)->restore();
    	  $notification=array(
            'message'=>'Category Restore Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.category')->with($notification);

    }

    public function categorydelete($id)
    {
    	Category::withTrashed()->where('id','=',$id)->forceDelete();
    	  $notification=array(
            'message'=>'Category Hard Delete Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.category')->with($notification);
    }

    public function categoryinactive($id)
    {
    	Category::findOrFail($id)->update(['status' => 0]);
    	  $notification=array(
            'message'=>'Category Inactive Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.category')->with($notification);
    } 

      public function categoryactive($id)
    {
    	Category::findOrFail($id)->update(['status' => 1]);
    	  $notification=array(
            'message'=>'Category Active Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.category')->with($notification);
    }

    public function categoryedit($id)
    {
    	return view('backend.category.edit',[
    		'edit_data'		=> Category::findOrFail($id)
    	]);
    }

    public function categoryeditpost(Request $request)
    {
    	$id = $request->id;

    	Category::findOrFail($id)->update([
    		'category_icon'		=> $request->category_icon,
    		'category_name'		=> $request->category_name,
    	]);

    		  $notification=array(
            'message'=>'Category Update Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.category')->with($notification);
    }

    // sub category part


     public function index()
    {
        return view('backend.subcategory.index',[
            'categories'    => Category::where('status',1)->latest()->get(),
            'subcategories' => SubCategory::latest()->get(),
            'trashed'       => SubCategory::onlyTrashed()->latest()->get()
        ]);
    }

    public function subcategorypost(Request $request)
    {
        $request->validate([
            'category_id'       => 'required',
            'subcategory_name'  => 'required'
        ],[
            'category_id.required'       => 'Select Category Name',
            'subcategory_name.required'       => 'Select Sub Category Name',
        ]);

        $slug = Str::slug($request->subcategory_name.'-'.carbon::now()->timestamp);

        SubCategory::insert([
             'category_id'       => $request->category_id,
             'subcategory_name'  => $request->subcategory_name,
             'subcategory_slug'  => $slug,
             'created_at'        => carbon::now() 
        ]);

          $notification=array(
            'message'=>'SubCategory Insert Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.subcategory')->with($notification);
    }

    public function subcategorysoft($id)
    {
        SubCategory::findOrFail($id)->delete();
            $notification=array(
            'message'=>'SubCategory Soft Delete Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.subcategory')->with($notification);
    }

    public function subcategoryrestore($id)
    {
        SubCategory::withTrashed()->where('id','=',$id)->restore();
        $notification=array(
            'message'=>'SubCategory Restore Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.subcategory')->with($notification);
    }

    public function subcategorydelete($id)
    {
        SubCategory::withTrashed()->where('id','=',$id)->forceDelete();
          $notification=array(
            'message'=>'SubCategory Delete Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.subcategory')->with($notification);
    }

    public function subcategoryinactive($id)
    {
        SubCategory::findOrFail($id)->update(['status' => 0]);
          $notification=array(
            'message'=>'SubCategory InActive Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.subcategory')->with($notification);
    }

    public function subcategoryactive($id)
    {
        SubCategory::findOrFail($id)->update(['status' => 1]);
          $notification=array(
            'message'=>'SubCategory Active Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.subcategory')->with($notification);
    }

    public function subcategoryedit($id)
    {
        return view('backend.subcategory.edit',[
            'edit_data'     => SubCategory::findOrFail($id),
            'categories'    => Category::latest()->get()
        ]);
    }

    public function subcategoryeditpost(Request $request)
    {
        $sub_id = $request->id;

        $request->validate([
            'category_id'       => 'required',
            'subcategory_name'  => 'required'
        ],[
            'category_id.required'       => 'Select Category Name',
            'subcategory_name.required'       => 'Select Sub Category Name',
        ]);

        SubCategory::findOrFail($sub_id)->update([
            'category_id'       => $request->category_id,
            'subcategory_name'  => $request->subcategory_name,
            'updated_at'        => Carbon::now()

        ]);
           $notification=array(
            'message'=>'SubCategory Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.subcategory')->with($notification);

    }

    // subsub category

    public function subindex()
    {
        return view('backend.subsubcategory.index',[ 
            'subsubcategories'  => Subsubcategory::latest()->get(),
            'categories'        => Category::orderBy('category_name','asc')->get(),
            'trashed'           => Subsubcategory::onlyTrashed()->get()
        ]);
    }

    public function subsubcategorypost(Request $request)
    {
        $request->validate([
            'category_id'               => 'required',
            'subcategory_id'            => 'required',
            'subsubcategory_name'       => 'required',
        ]);

        $slug = Str::slug($request->subsubcategory_name.'-'.carbon::now()->timestamp);
        Subsubcategory::insert([
            'category_id'               => $request->category_id,
            'subcategory_id'            => $request->subcategory_id,
            'subsubcategory_name'       => $request->subsubcategory_name,
            'subsubcategory_slug'       => $slug,
            'created_at'                => Carbon::now()
        ]);

        $notification=array(
            'message'=>'Sub Sub Category insert Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.subsubcategory')->with($notification);
    }


    public function subcategoryajax($category_id)
    {
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','asc')->get();
        return json_encode($subcat);
    }

    public function subsubcategorysoft($id)
    {
        Subsubcategory::findOrFail($id)->delete();
         $notification=array(
            'message'=>'Sub Sub Category Soft Delete Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.subsubcategory')->with($notification);
    }

    public function subsubcategoryrestore($id)
    {
        Subsubcategory::withTrashed()->where('id','=',$id)->restore();
        $notification=array(
            'message'=>'Sub Sub Category Restore Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.subsubcategory')->with($notification);
    }

      public function subsubcategorydelete($id)
    {
        Subsubcategory::withTrashed()->where('id','=',$id)->forceDelete();
        $notification=array(
            'message'=>'Sub Sub Category Delete Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.subsubcategory')->with($notification);
    }
      
}