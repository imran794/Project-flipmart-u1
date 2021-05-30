@extends('layouts.dashboard')

@section('categories')
 active show-sub 
 @endsection

 @section('Add Sub Category')
 active  
 @endsection


@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Sub Category</li>
    </ol>
  </nav>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
           <div class="card">
               <div class="card-body">Add Sub Category</div>
               <div class="card-header">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                      <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                         
                            <th class="wd-25p">SubCategory Name</th>
                            <th class="wd-25p">Category Name</th>
                            <th class="wd-25p">status</th>
                            <th class="wd-25p">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($subcategories as $subcategory)
                          <tr>
                            <td>{{ $subcategory->subcategory_name }}</td>
                            <td>{{ $subcategory->get_relation_category->category_name }}</td>
                            <td>
                              @if ($subcategory->status == 1)
                               <span class="badge badge-pill badge-success">Active</span>
                               @else
                                 <span class="badge badge-pill badge-danger">Deactive</span>
                              @endif
                          </td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ url('admin/subcategory/edit') }}/{{ $subcategory->id }}" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="{{ url('admin/subcategory/soft') }}/{{ $subcategory->id }}"  type="button" class="btn btn-danger btn-sm" title="Soft Delete"><i class="fa fa-trash"></i></a>
                                @if ($subcategory->status == 1)
                                 <a href="{{ url('admin/subcategory/inactive') }}/{{ $subcategory->id }}"  type="button" class="btn btn-danger btn-sm" title="Inactive"><i class="fa fa-arrow-down"></i></a>
                                 @else  
                                  <a href="{{ url('admin/subcategory/active') }}/{{ $subcategory->id }}"  type="button" class="btn btn-info btn-sm" title="Active"><i class="fa fa-arrow-up"></i></a>
                                   @endif 
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
               </div>
           </div>
           <br>
           <div class="card">
            <div class="card-body">Trash Data</div>
            <div class="card-header">
             <div class="card pd-20 pd-sm-40">
                 <div class="table-wrapper">
                   <table id="datatable2" class="table display responsive nowrap">
                     <thead>
                       <tr>
                           <th class="wd-25p">SubCategory Name</th>
                            <th class="wd-25p">Category Name</th>
                            <th class="wd-25p">status</th>
                            <th class="wd-25p">Action</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach ($trashed as $trash)
                       <tr>
                        <td>{{ $trash->subcategory_name }}</td>
                            <td>{{ $trash->get_relation_category->category_name }}</td>
                         <td>
                           @if ($trash->status == 1)
                             <span class="badge badge-pill badge-success">Active</span>
                               @else
                                 <span class="badge badge-pill badge-danger">Deactive</span>
                           @endif
                         </td>
                         <td>
                           <div class="btn-group" role="group" aria-label="Basic example">
                             <a href="{{ url('admin/subcategory/restore') }}/{{ $trash->id }}" class="btn btn-info btn-sm" title="restore"><i class="fa fa-arrow-up"></i></a>
                             <a href="{{ url('admin/subcategory/delete') }}/{{ $trash->id }}" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></a>
                           </div>
                         </td>
                       </tr>
                       @endforeach
                     </tbody>
              
                   </table>
                 </div>
               </div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
         <div class="card">
             <div class="card-header">Add Brand</div>
             <div class="card-body">
                <form method="POST" action="{{ route('subcategory.post') }}">
                  @csrf
                  <div class="form-group">
                      <label for="exampleInputEmail1">Category Name</label>
                      <select name="category_id" class="form-control">
                        <option value="">-Select One-</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ ucwords($category->category_name) }}</option>
                        @endforeach
                      </select>
                      @error('category_id')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror

                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Sub Category Name</label>
                      <input type="text" class="form-control" name="subcategory_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Sub Category Name">
                      @error('subcategory_name')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror

                    </div>
                    
                    <button type="submit" style="cursor: pointer" class="btn btn-primary">Add Sub Category</button>
                  </form>
             </div>
         </div>
        </div>
    </div>
</div>

@endsection