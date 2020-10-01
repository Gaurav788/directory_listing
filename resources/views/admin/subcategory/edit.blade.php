@extends('admin.layouts.cmlayout')

@section('body')
                <div class="container-fluid">
                    <div class="row page-title  no-display">
                        <div class="col-md-12">
                            <h4 class="mb-1 mt-0">SubCategories</h4>
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
										Create SubCategory
										<a href="{{route('subcategories.list')}}" class="float-right"><i data-feather="x"></i></a>					
									</h5>
									<form action="{{route('subcategory.update')}}" method="post" class="user" id="add_genre_form" enctype="multipart/form-data">
										@csrf				
											<input type="hidden" name="edit_record_id" value="{{$record->id}}">				
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Category<span class="required">*</span></label>
														<select name="category" id="duration" class="form-control form-control-user" required>
															<option value="">Select Category</option>
															@foreach($categories as $row)
															<option value="{{$row->id}}" {{ old('category', $record->category_id) == $row->id  ? 'selected' : ''}}>{{$row->name}}</option>
															@endforeach
														</select>
														@if ($errors->has('category'))
															<span class="text-danger">{{ $errors->first('category') }}</span>
														@endif
														
													</div>
												</div>
											</div>												
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Name<span class="required">*</span></label>
														<input type="text" name="name" id="name" value="{{old('name', $record->name)}}" class="form-control form-control-user" required />
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
														<textarea  name="description" class="form-control form-control-user" required /> {{old('description', $record->description)}}</textarea>
														@if ($errors->has('description'))
															<span class="text-danger">{{ $errors->first('description') }}</span>
														@endif
													</div>
												</div>
												
											
											</div>							
											<div class="mt-1 mb-1">
												<div class="text-left d-print-none mt-4">
													<button type="submit" id="save-category-btn" class="btn btn-primary">Update</button>
													<a href="{{route('subcategories.list')}}" class="btn btn-light">Cancel</a>
												</div>
												
											</div>
									</form>
								</div>                          
							</div>
						</div>
						<!-- end row -->
					</div> 
					<!-- container-fluid -->
@endsection
@section('scripts')
    <script src="https://cdn.tiny.cloud/1/g2adjiwgk9zbu2xzir736ppgxzuciishwhkpnplf46rni4g8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: 'textarea'
    });
  </script>
@stop