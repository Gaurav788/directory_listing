@extends('admin.layouts.cmlayout')

@section('body')
                <div class="container-fluid">
                    <div class="row page-title  no-display">
                        <div class="col-md-12">
                            <h4 class="mb-1 mt-0">Update User Details</h4>
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
									<form action="{{route('user.update')}}" method="post" class="user" id="add_genre_form" enctype="multipart/form-data">
										@csrf				
											<input type="hidden" name="edit_record_id" value="{{$record->id}}">														
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>First Name<span class="required">*</span></label>
														<input type="text" name="first_name" id="first_name" value="{{old('first_name', $record->first_name)}}" class="form-control form-control-user" required />
														@if ($errors->has('first_name'))
															<span class="text-danger">{{ $errors->first('first_name') }}</span>
														@endif
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Last Name<span class="required">*</span></label>
														<input type="text" name="last_name" id="last_name" value="{{old('last_name', $record->last_name)}}" class="form-control form-control-user" required />
														@if ($errors->has('last_name'))
															<span class="text-danger">{{ $errors->first('last_name') }}</span>
														@endif
													</div>
												</div>
											</div>												
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Email<span class="required">*</span></label>
														<input type="text" name="email" id="email" value="{{old('email', $record->email)}}" class="form-control form-control-user" required />
														@if ($errors->has('email'))
															<span class="text-danger">{{ $errors->first('email') }}</span>
														@endif
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Mobile<span class="required">*</span></label>
														<input type="text" name="mobile" id="mobile" @if ($record->user_detail) value="{{old('mobile', $record->user_detail->mobile)}}" @else value="{{old('mobile')}}" @endif class="form-control form-control-user" required />
														@if ($errors->has('mobile'))
															<span class="text-danger">{{ $errors->first('mobile') }}</span>
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
																<a class="btn btn-success btn-sm {{ old('status', $record->status) == '1' ? 'active' : 'notActive'}}" data-toggle="status" data-title="1">Enabled</a>
																<a class="btn btn-danger btn-sm {{ old('status', $record->status) == '0' ? 'active' : 'notActive'}}" data-toggle="status" data-title="0">Disabled</a>
															</div>
															<input type="hidden" name="status" id="status" value="{{ old('status', $record->status) == '1' ? '1' : '0'}}">
														</div>
														@if ($errors->has('status'))
															<span class="text-danger">{{ $errors->first('status') }}</span>
														@endif
													</div>
												</div>									
											</div>					
											<div class="mt-1 mb-1">
												<div class="text-left d-print-none mt-4">
													<button type="submit" id="save-category-btn" class="btn btn-primary">Update</button>
													<a href="{{route('users.list')}}" class="btn btn-light">Cancel</a>
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