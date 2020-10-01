@extends('admin.layouts.cmlayout')

@section('body')
                <div class="container-fluid">
                    <div class="row page-title  no-display">
                        <div class="col-md-12">
                            <h4 class="mb-1 mt-0">Membership Plans</h4>
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
										Update Membership Plan
										<a href="{{route('membershipplan.list')}}" class="float-right"><i data-feather="x"></i></a>					
									</h5>
									<form action="{{route('membershipplan.update')}}" method="post" class="user" id="add_genre_form" enctype="multipart/form-data">
										@csrf	
											<input type="hidden" name="edit_record_id" value="{{$record->id}}">
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
														<label>Details<span class="required">*</span></label>
														<textarea  name="details" class="form-control form-control-user" required /> {{old('details', $record->details)}}</textarea>
														@if ($errors->has('details'))
															<span class="text-danger">{{ $errors->first('details') }}</span>
														@endif
													</div>
												</div>
												
											
											</div>										
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Currency<span class="required">*</span></label>
														<select name="currency" id="currency" class="form-control form-control-user" required>
															<option value="">Select Currency</option>
															@foreach($currency_data as $row)
															<option value="{{$row->id}}" {{ old('currency', $record->currency_id) == $row->id ? 'selected' : ''}}>{{$row->name}}</option>
															@endforeach
														</select>
														@if ($errors->has('currency'))
															<span class="text-danger">{{ $errors->first('currency') }}</span>
														@endif
													</div>
												</div>
											</div>									
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Price<span class="required">*</span></label>
														<input type="number" name="price" id="price" value="{{old('price', $record->price)}}" class="form-control form-control-user" required />
														@if ($errors->has('price'))
															<span class="text-danger">{{ $errors->first('price') }}</span>
														@endif
													</div>
												</div>
											</div>									
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Duration<span class="required">*</span></label>
														<select name="duration" id="duration" class="form-control form-control-user" required>
															<option value="">Select Duration</option>
															<option value="Monthly" {{$record->duration == 'Monthly'  ? 'selected' : ''}}>Monthly</option>
															<option value="Quarterly" {{$record->duration == 'Quarterly'  ? 'selected' : ''}}>Quarterly</option>
															<option value="HalfYearly" {{$record->duration == 'HalfYearly'  ? 'selected' : ''}}>HalfYearly</option>
															<option value="Annually" {{$record->duration == 'Annually'  ? 'selected' : ''}}>Annually</option>
														</select>
														@if ($errors->has('duration'))
															<span class="text-danger">{{ $errors->first('duration') }}</span>
														@endif
														
													</div>
												</div>
											</div>					
											<div class="mt-1 mb-1">
												<div class="text-left d-print-none mt-4">
													<button type="submit" id="save-membershipplan-btn" class="btn btn-primary">Update</button>
													<a href="{{route('membershipplan.list')}}" class="btn btn-light">Cancel</a>
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