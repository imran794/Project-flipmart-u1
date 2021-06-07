@extends('layouts.dashboard')

@section('Products')
active show-sub
@endsection

@section('Manage Products')
active
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('add.product') }}">Add Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage Products</li>
    </ol>
</nav>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">Add Brand</div>
                <div class="card-header">
                    <div class="card pd-20 pd-sm-40">
                        <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th class="wd-10p">Image</th>
                                        <th class="wd-10p">Brand</th>
                                        <th class="wd-10p">Category</th>
                                        <th class="wd-10p">Subcategory</th>
                                        <th class="wd-10p">Subsubcategory</th>
                                        <th class="wd-10p">Product</th>
                                        <th class="wd-10p">Price</th>
                                        <th class="wd-10p">Status</th>
                                        <th class="wd-10p">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <img width="100" src="{{ asset($product->thumbnail_image) }}" alt="">
                                        </td>
                                        <td>{{ $product->brand->brand_name }}</td>
                                        <td>{{ $product->category->category_name }}</td>
                                        <td>{{ $product->subcategory->subcategory_name }}</td>
                                        <td>{{ $product->subsubcategory->subsubcategory_name }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            @if ($product->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Deactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('admin/edit') }}/{{ $product->id }}" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>

                                                <a href="{{ url('admin/product/view') }}/{{ $product->id }}" type="button" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye"></i></a>

                                                <a href="{{ url('admin/brand/soft') }}/{{ $product->id }}" type="button" class="btn btn-danger btn-sm" title="Soft Delete"><i class="fa fa-trash"></i></a>
                                                @if ($product->status == 1)
                                                <a href="{{ url('admin/inactive') }}/{{ $product->id }}" type="button" class="btn btn-danger btn-sm" title="Inactive"><i class="fa fa-arrow-down"></i></a>
                                                @else
                                                <a href="{{ url('admin/active') }}/{{ $product->id }}" type="button" class="btn btn-info btn-sm" title="Active"><i class="fa fa-arrow-up"></i></a>
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
                                        <th class="wd-25p">Brand Image</th>
                                        <th class="wd-25p">Brand Name</th>
                                        <th class="wd-25p">status</th>
                                        <th class="wd-25p">Action</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                       @foreach ($trashed as $trash)
                       <tr>
                         <td>
                           <img width="100" src="{{ asset($trash->brand_image) }}" alt="$trash->brand_image">
                                </td>
                                <td>{{ $trash->brand_name }}</td>
                                <td>
                                    @if ($trash->status == 1)
                                    <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                    <span class="badge badge-pill badge-danger">Deactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('admin/restore') }}/{{ $trash->id }}" class="btn btn-info btn-sm" title="restore">restore</a>
                                        <a href="{{ url('admin/delete') }}/{{ $trash->id }}" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                                </tr>
                                @endforeach
                                </tbody> --}}

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
