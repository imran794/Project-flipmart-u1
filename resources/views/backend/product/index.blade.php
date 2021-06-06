@extends('layouts.dashboard')
@section('Products')
active show-sub
@endsection
@section('Add Product')
active
@endsection
@section('breadcrumb')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Add Product</li>
	</ol>
</nav>
@endsection
@section('content')
<div class="sl-pagebody">
	<div class="sl-page-title">
		<div class="card pd-20 pd-sm-40">
			<h6 class="card-body-title"> Add Product</h6>
			<div class="form-layout">
				<form action="{{ route('product.post') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="row mg-b-25">
						
						<div class="col-lg-4">
							<div class="form-group">
								<label class="form-control-label">Brand Name: <span class="tx-danger">*</span></label>
								
								<select class="form-control select2" placeholder="Brand Name" name="brand_id">
									<option label="Choose Category"></option>
									@foreach ($brands as $brand)
									<option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
									@endforeach
								</select>
							</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">category Name: <span class="tx-danger">*</span></label>
									<select class="form-control select2" placeholder="Category Name" name="category_id">
										<option label="Choose Category"></option>
										@foreach ($categories as $category)
										<option value="{{ $category->id }}">{{ $category->category_name }}</option>
										@endforeach
									</select>
									
								</div>
								</div><!-- col-4 -->
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label">Sub Category Name: <span class="tx-danger">*</span></label>
										<select class="form-control select2" placeholder="Category Name" name="subcategory_id">
											<option label="Choose country"></option>
											<option value="USA">United States of America</option>
											
										</select>
										
									</div>
									</div><!-- col-4 -->
									<div class="col-lg-4">
										<div class="form-group">
											<label class="form-control-label">Sub Sub Category Name: <span class="tx-danger">*</span></label>
											<select class="form-control select2" placeholder="Sub Sub Category Name" name="subsubcategory_id">
												<option label="Choose country"></option>
												<option value="USA">United States of America</option>
												
											</select>
											
										</div>
										</div><!-- col-4 -->
										<div class="col-lg-4">
											<div class="form-group">
												<label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
												<input class="form-control" type="text" name="product_name" placeholder="Product Name">
											</div>
											</div><!-- col-4 -->
											<div class="col-lg-4">
												<div class="form-group">
													<label class="form-control-label">Product Price: <span class="tx-danger">*</span></label>
													<input class="form-control" type="text" name="price" placeholder="Product Price">
												</div>
												</div><!-- col-4 -->
												<div class="col-lg-4">
													<div class="form-group">
														<label class="form-control-label">Discount Price: <span class="tx-danger">*</span></label>
														<input class="form-control" type="text" name="discount_price" placeholder="Discount Price">
													</div>
													</div><!-- col-4 -->
													<div class="col-lg-4">
														<div class="form-group">
															<label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
															<input class="form-control" type="text" name="product_code" placeholder="Product Code">
														</div>
														</div><!-- col-4 -->
														<div class="col-lg-4">
															<div class="form-group">
																<label class="form-control-label">Product QTY: <span class="tx-danger">*</span></label>
																<input class="form-control" type="text" name="product_qty" placeholder="Product Qty">
															</div>
															</div><!-- col-4 -->
															<div class="col-lg-4">
																<div class="form-group">
																	<label class="form-control-label">Product Tag: <span class="tx-danger">*</span></label>
																	<input class="form-control" type="text" name="product_tag" placeholder="Product Tag">
																</div>
																</div><!-- col-4 -->
																<div class="col-lg-4">
																	<div class="form-group">
																		<label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
																		<input class="form-control" type="text" name="product_size" placeholder="Product Size">
																	</div>
																	</div><!-- col-4 -->
																	<div class="col-lg-6">
																		<div class="form-group mg-b-10-force">
																			<label class="form-control-label">Thumbnail Image: <span class="tx-danger">*</span></label>
																			<input class=" dropify form-control" type="file" name="thumbnail_image"  placeholder="Thumbnail Image">
																		</div>
																		</div><!-- col-8 -->
																		<div class="col-lg-6">
																			<div class="form-group mg-b-10-force">
																				<label class=" form-control-label">Multiple Image: <span class="tx-danger">*</span></label>
																				<input class="dropify form-control" type="file" name="multiple_image"  placeholder='Multiple Image' multiple>
																			</div>
																			</div><!-- col-8 -->
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="form-control-label">Short Description: <span class="tx-danger">*</span></label>
																					<textarea name="shot_des" id="summernote"></textarea>
																					@error('shot_des')
																					<span class="text-danger">{{ $message }}</span>
																					@enderror
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<label class="form-control-label">Long Description: <span class="tx-danger">*</span></label>
																					<textarea name="long_des" id="summernote2"></textarea>
																					@error('long_des')
																					<span class="text-danger">{{ $message }}</span>
																					@enderror
																				</div>
																			</div>
																			<div class="col-md-4">
																				<label class="ckbox">
																					<input type="checkbox" name="hot_deals" value="1"><span>Hot Deals</span>
																				</label>
																			</div>
																			<div class="col-md-4">
																				<label class="ckbox">
																					<input type="checkbox" name="featured" value="1"><span>Featured</span>
																				</label>
																			</div>
																			<div class="col-md-4">
																				<label class="ckbox">
																					<input type="checkbox" name="special_offer" value="1"><span>special_offer</span>
																				</label>
																			</div>
																			<div class="col-md-4">
																				<label class="ckbox">
																					<input type="checkbox" name="special_deals" value="1"><span>special_deals</span>
																				</label>
																			</div>
																			
																			</div><!-- row -->
																			<div class="form-layout-footer">
																				<button style="cursor: pointer;" class="btn btn-info mg-r-5">Add Product</button>
																				<button class="btn btn-secondary">Cancel</button>
																			</form>
																			</div><!-- form-layout-footer -->
																			</div><!-- form-layout -->
																			</div><!-- card -->
																		</div>
																		</div><!-- d-flex -->
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
																		$(document).ready(function() {
																		$('select[name="subcategory_id"]').on('change', function(){
																		var subcategory_id = $(this).val();
																		if(subcategory_id) {
																		$.ajax({
																		url: "{{  url('/admin/subsubcategory/ajax') }}/"+subcategory_id,
																		type:"GET",
																		dataType:"json",
																		success:function(data) {
																		var d =$('select[name="subsubcategory_id"]').empty();
																		$.each(data, function(key, value){
																		$('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name + '</option>');
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