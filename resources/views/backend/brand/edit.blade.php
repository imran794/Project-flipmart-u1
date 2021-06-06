@extends('layouts.dashboard')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('brand') }}">Brand</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Brand</li>
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
                   <form method="POST" action="{{ route('brand.edit.post') }}" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value='{{ $edit_data->id }}'>
                  <input type="hidden" name="old_image" value="{{ $edit_data->brand_image }}">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Brand Name</label>
                      <input type="text" class="form-control" name="brand_name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $edit_data->brand_name }}">
                      @error('brand_name')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror

                    </div>
                       <div class="form-group">
                      <label for="exampleInputPassword1">Brnad Image</label>
                      <input type="file" name="brand_image" class="form-control" id="exampleInputPassword1">
                      <div class="py-2">
                        <img width="100" src="{{ asset($edit_data->brand_image) }}">
                      </div>
                      @error('brand_image')
                      <span class="text-danger">{{ $message }}</span>
                     @enderror
                    </div>
                    <button type="submit" style="cursor: pointer" class="btn btn-primary">Update Brand</button>
                  </form>
             </div>
         </div>
        </div>
    </div>
</div>
</div>

@endsection
