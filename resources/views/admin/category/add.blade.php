@extends('admin.layouts.cmlayout')

@section('body')
                <div class="container-fluid">
                    <div class="row page-title  no-display">
                        <div class="col-md-12">
                            <h4 class="mb-1 mt-0">Categories</h4>
                        </div>
                    </div>
					<div class="flash-message">
						@if(session()->has('status'))
							@if(session()->get('status') == 'error')
								<div class="alert alert-danger  alert-dismissible">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									{{ session()->get('message') }}
								</div>
							@endif
						@endif
					</div> <!-- end .flash-message -->
                    <div class="row mt-4">
						<div class="col-md-12">
                            <div class="card">
                                <div class="card-body pt-2 pb-3 manageClinicSection">
                                    <h5 class="mt-3 mb-4">
										Create Category
										<a href="{{route('categories.list')}}" class="float-right"><i data-feather="x"></i></a>					
									</h5>
									<form action="{{route('category.create')}}" method="post" class="user" id="add_genre_form" enctype="multipart/form-data">
										@csrf													
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Parent Category<span class="required">*</span></label>
														<select name="parent_id" id="parent_id" class="form-control form-control-user" required>
															<option value="">Select Parent Category</option>
															<option value="0">Root</option>
															@foreach($categorylist as $row)
															<option value="{{$row->id}}" {{ old('parent_id') == $row->id ? 'selected' : ''}}>{{$row->name}}</option>
															@endforeach
														</select>
														@if ($errors->has('parent_id'))
															<span class="text-danger">{{ $errors->first('parent_id') }}</span>
														@endif
													</div>
												</div>
											</div>											
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Subcategory Name<span class="required">*</span></label>
														<input type="text" name="name" id="name" value="{{old('name')}}" class="form-control form-control-user" required />
														@if ($errors->has('name'))
															<span class="text-danger">{{ $errors->first('name') }}</span>
														@endif
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Description<span class="required">*</span></label>
														<textarea  name="description" class="form-control form-control-user" required /> {{old('description')}}</textarea>
														@if ($errors->has('description'))
															<span class="text-danger">{{ $errors->first('description') }}</span>
														@endif
													</div>
												</div>
												
											
											</div>											
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Sorting Order<span class="required">*</span></label>
														<input type="text" name="sort_order" id="sort_order" value="{{old('sort_order')}}" class="form-control form-control-user" required />
														@if ($errors->has('sort_order'))
															<span class="text-danger">{{ $errors->first('sort_order') }}</span>
														@endif
													</div>
												</div>
											</div>								
											<div class="row">  
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Status<span class="required">*</span></label>
														<div class="input-group">
															<div id="radioBtn" class="btn-group">
																<a class="btn btn-success btn-sm active {{ old('status') == '1' ? 'active' : 'notActive'}}" data-toggle="status" data-title="1">Enabled</a>
																<a class="btn btn-danger btn-sm {{ old('status') == '0' ? 'active' : 'notActive'}}" data-toggle="status" data-title="0">Disabled</a>
															</div>
															<input type="hidden" name="status" id="status" value="1">
														</div>
														@if ($errors->has('status'))
															<span class="text-danger">{{ $errors->first('status') }}</span>
														@endif
													</div>
												</div>									
											</div>							
											<div class="mt-1 mb-1">
												<div class="text-left d-print-none mt-4">
													<button type="submit" id="save-category-btn" class="btn btn-primary">Save</button>
													<a href="{{route('categories.list')}}" class="btn btn-light">Cancel</a>
												</div>
												
											</div>
									</form>
								</div>                          
							</div>
						</div>
						<!-- end row -->
					</div> 
					<!-- container-fluid -->
					<style>
					
					</style>
@endsection
@section('scripts')
    <script src="https://cdn.tiny.cloud/1/g2adjiwgk9zbu2xzir736ppgxzuciishwhkpnplf46rni4g8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: 'textarea'
    });
  </script>
@stop