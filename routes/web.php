<?php

use App\Http\Controllers\User\UserController;
Use App\Http\Controllers\Admin\AdminController;
Use App\Http\Controllers\Admin\IndexController;
Use App\Http\Controllers\Admin\BrandController;
Use App\Http\Controllers\Admin\CategoryController;
Use App\Http\Controllers\Admin\SubcategoryController;
Use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[IndexController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin','middleware' =>['admin','auth'],'namespace'=>'Admin'], function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::post('update/Data',[AdminController::class,'updateData'])->name('update.Data');
    Route::get('image/update',[AdminController::class,'imageupdate'])->name('admin.image.update');
    Route::post('update/Data/post',[AdminController::class,'updateDatapost'])->name('update.Data.post');
    Route::get('change/passwprd',[AdminController::class,'adminchangepasswprd'])->name('admin.change.passwprd');
    Route::post('update/password/data',[AdminController::class,'updatepassworddata'])->name('update.password.data');

    // all user
    Route::get('all/user',[AdminController::class,'alluser'])->name('all.user');
    Route::get('user/soft/{id}',[AdminController::class,'usersoft']);
    Route::get('user/restore/{id}',[AdminController::class,'userrestore']);
    Route::get('user/delete/{id}',[AdminController::class,'userdelete']);

    // barnd part
    Route::get('brand',[BrandController::class,'brand'])->name('brand');
    Route::post('brand/post',[BrandController::class,'brandstore'])->name('brand.post');
    Route::get('inactive/{id}',[BrandController::class,'admininactive']);
    Route::get('active/{id}',[BrandController::class,'adminactive']);
    Route::get('brand/soft/{id}',[BrandController::class,'brandsoft']);
    Route::get('restore/{id}',[BrandController::class,'restore']);
    Route::get('delete/{id}',[BrandController::class,'delete']);
    Route::get('edit/{id}',[BrandController::class,'edit']);
    Route::post('brand/edit/post',[BrandController::class,'brandeditpost'])->name('brand.edit.post');

    // category

   Route::get('add/category',[CategoryController::class, 'indexcategory'])->name('add.category');
   Route::post('category/post',[CategoryController::class,'categorystore'])->name('category.post');
   Route::get('category/soft/{id}',[CategoryController::class,'categorysoft']);
   Route::get('category/restore/{id}',[CategoryController::class,'categoryrestore']);
   Route::get('category/delete/{id}',[CategoryController::class,'categorydelete']);
   Route::get('category/inactive/{id}',[CategoryController::class,'categoryinactive']);
   Route::get('category/active/{id}',[CategoryController::class,'categoryactive']);
   Route::get('category/edit/{id}',[CategoryController::class,'categoryedit']);
   Route::post('category/edit/post',[CategoryController::class,'categoryeditpost'])->name('category.edit.post');

   // Add sub category

   Route::get('add/subcategory',[CategoryController::class,'index'])->name('add.subcategory');
   Route::post('subcategory/post',[CategoryController::class,'subcategorypost'])->name('subcategory.post');
   Route::get('subcategory/soft/{id}',[CategoryController::class,'subcategorysoft']);
   Route::get('subcategory/restore/{id}',[CategoryController::class,'subcategoryrestore']);
   Route::get('subcategory/delete/{id}',[CategoryController::class,'subcategorydelete']);
   Route::get('subcategory/inactive/{id}',[CategoryController::class,'subcategoryinactive']);
   Route::get('subcategory/active/{id}',[CategoryController::class,'subcategoryactive']);
   Route::get('subcategory/edit/{id}',[CategoryController::class,'subcategoryedit']);
   Route::post('subcategory/edit/post',[CategoryController::class,'subcategoryeditpost'])->name('subcategory.edit.post');

   // add sub sub sub category

   Route::get('add/subsubcategory',[CategoryController::class,'subindex'])->name('add.subsubcategory');
   Route::post('subsubcategory/post',[CategoryController::class,'subsubcategorypost'])->name('subsubcategory.post');
   Route::get('subcategory/ajax/{category_id}',[CategoryController::class,'subcategoryajax']);
   Route::get('subsubcategory/ajax/{subcategory_id}',[CategoryController::class,'subsubcategoryajax']);
   Route::get('subsubcategory/soft/{id}',[CategoryController::class,'subsubcategorysoft']);
   Route::get('subsubcategory/restore/{id}',[CategoryController::class,'subsubcategoryrestore']);
   Route::get('subsubcategory/delete/{id}',[CategoryController::class,'subsubcategorydelete']);

   // product

   Route::get('add/product',[ProductController::class,'index'])->name('add.product');
   Route::post('product/post',[ProductController::class,'productpost'])->name('product.post');
   Route::get('manage/product',[ProductController::class,'productshow'])->name('manage.product');
   Route::get('product/view/{id}',[ProductController::class,'productview']);
   Route::get('product/soft/{id}',[ProductController::class,'productsoft']);
   Route::get('product/restore/{id}',[ProductController::class,'productrestore']);
   Route::get('product/delete/{id}',[ProductController::class,'productdelete']);
   Route::get('product/edit/{id}',[ProductController::class,'productedit']);
   Route::get('product/inactive/{id}',[ProductController::class,'productinactive']);
   Route::get('product/active/{id}',[ProductController::class,'productactive']);
   Route::post('product/post/edit',[ProductController::class,'productpostedit'])->name('product.post.edit');
   Route::post('thumpnil/image/update',[ProductController::class,'thumpnilimageupdate'])->name('thumpnil.image.update');
   Route::post('update/product/image',[ProductController::class,'updateproductimage'])->name('update.product.image');




});

Route::group(['prefix'=>'user','middleware' =>['user','auth'],'namespace'=>'User'], function(){
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::post('edit/profile',[UserController::class,'updateData'])->name('edit-profile');
    Route::get('image/update',[UserController::class,'imageupdate'])->name('image.update');
    Route::post('update/image/post',[UserController::class,'updatepost'])->name('update.image.post');
    Route::get('change/passwprd',[UserController::class,'changepasswprd'])->name('change.passwprd');
    Route::post('password/store',[UserController::class,'passwordstore'])->name('password.store');
});

