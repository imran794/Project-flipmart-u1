@extends('layouts.dashboard')

@section('categories')
 active show-sub 
 @endsection

 @section('Add Sub Sub Category')
 active  
 @endsection


@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Sub Sub Category</li>
    </ol>
  </nav>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
           <div class="card">
               <div class="card-body">Add Category</div>
               <div class="card-header">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                      <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                            <th class="wd-20p">C Name</th>
                            <th class="wd-20p">S C Name</th>
                            <th class="wd-20p">S s C Name</th>
                            <th class="wd-20p">status</th>
                            <th class="wd-20p">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($subsubcategories as $subsubcategory)
                          <tr>
                            <td>{{ $subsubcategory->category->category_name }}</td>
                            <td>{{ $subsubcategory->subcategory->subcategory_name }}</td>
                            <td>{{ $subsubcategory->subsubcategory_name }}</td>
                            <td>
                              @if ($subsubcategory->status == 1)
                               <span class="badge badge-pill badge-success">Active</span>
                               @else
                                 <span class="badge badge-pill badge-danger">Deactive</span>
                              @endif
                          </td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ url('admin/subsubcategory/edit') }}/{{ $subsubcategory->id }}" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{ url('admin/subsubcategory/soft') }}/{{ $subsubcategory->id }}"  type="button" class="btn btn-danger btn-sm" title="Soft Delete"><i class="fa fa-trash"></i></a>
                                @if ($subsubcategory->status == 1)
                                 <a href="{{ url('admin/subsubcategory/inactive') }}/{{ $subsubcategory->id }}"  type="button" class="btn btn-danger btn-sm" title="Inactive"><i class="fa fa-arrow-down"></i></a>
                                 @else  
                                  <a href="{{ url('admin/subsubcategory/active') }}/{{ $subsubcategory->id }}"  type="button" class="btn btn-info btn-sm" title="Active"><i class="fa fa-arrow-up"></i></a>
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
                              <th class="wd-20p">C Name</th>
                            <th class="wd-20p">S C Name</th>
                            <th class="wd-20p">S s C Name</th>
                            <th class="wd-20p">status</th>
                            <th class="wd-20p">Action</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach ($trashed as $trash)
                       <tr>
                          <td>{{ $trash->category->category_name }}</td>
                            <td>{{ $trash->subcategory->subcategory_name }}</td>
                            <td>{{ $trash->subsubcategory_name }}</td>
                            <td>
                              @if ($trash->status == 1)
                               <span class="badge badge-pill badge-success">Active</span>
                               @else
                                 <span class="badge badge-pill badge-danger">Deactive</span>
                              @endif
                          </td>
                         <td>
                           <div class="btn-group" role="group" aria-label="Basic example">
                             <a href="{{ url('admin/subsubcategory/restore') }}/{{ $trash->id }}" class="btn btn-info btn-sm" title="restore"><i class="fa fa-arrow-up"></i></a>
                             <a href="{{ url('admin/subsubcategory/delete') }}/{{ $trash->id }}" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></a>
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
                <form method="POST" action="{{ route('subsubcategory.post') }}">
                  @csrf
                  <div class="form-group">
                      <label for="exampleInputEmail1">Category Icon</label>
                     <select name="category_id" class="js-example-basic-single form-control">
                         <option value="">-Choose one-</option>
                         @foreach ($categories as $category)
                             <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                         @endforeach
                       
                      </select>
                      @error('category_id')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror

                    </div>
                      <div class="form-group">
                        <label class="form-control-label">Select SubCategory: <span class="tx-danger">*</span></label>
                        <select class="form-control select2-show-search" data-placeholder="Select One" name="subcategory_id">
                          <option label="Choose one"></option>

                        </select>
                        @error('subcategory_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sub Sub Category Name</label>
                      <input type="text" class="form-control" name="subsubcategory_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Sub Sub Category Name">
                      @error('subsubcategory_name')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror

                    </div>
                    <button type="submit" style="cursor: pointer" class="btn btn-primary">Add Sub SubCategory</button>
                  </form>
             </div>
         </div>
        </div>
    </div>
</div>


 <script src="{{asset('backend')}}/lib/jquery-2.2.4.min.js"></script>




    <script type="text/javascript">
      $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/admin/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="subcategory_id"]').empty();
                          $.each(data, function(key, value){

                              $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name + '</option>');

                          });

                    },

                });
            } else {
                alert('danger');
            }

        });

    });

    </script>


@endsection
