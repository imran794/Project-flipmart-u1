@extends('layouts.dashboard')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('add.category') }}">Category</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit category</li>
    </ol>
  </nav>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
         <div class="card">
             <div class="card-header">Edit Brand</div>
             <div class="card-body">
                   <form method="POST" action="{{ route('category.edit.post') }}">
                       <input type="hidden" name="id" value='{{ $edit_data->id }}'>
                  @csrf
               
                      <div class="form-group">
                      <label for="exampleInputEmail1">Category Icon</label>
                      <input type="text" class="form-control" name="category_icon" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $edit_data->category_icon }}">
                      @error('category_icon')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                      <div class="form-group">
                      <label for="exampleInputEmail1">Category Name</label>
                      <input type="text" class="form-control" name="category_name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $edit_data->category_name }}">
                      @error('category_name')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror

                    </div>
                    <button type="submit" style="cursor: pointer" class="btn btn-primary">Update Category</button>
                  </form>
             </div>
         </div>
        </div>
    </div>
</div>
</div>

@endsection
