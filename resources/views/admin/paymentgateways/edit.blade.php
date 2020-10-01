@extends('admin.layouts.cmlayout')

@section('body')
                <div class="container-fluid">
                    <div class="row page-title  no-display">
                        <div class="col-md-12">
                            <h4 class="mb-1 mt-0">Payment Gateways</h4>
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
										Edit Payment Gateway
										<a href="{{route('paymentgateways.list')}}" class="float-right"><i data-feather="x"></i></a>					
									</h5>
									<form action="{{route('paymentgateway.update')}}" method="post" class="user" id="add_genre_form" enctype="multipart/form-data">
										@csrf						
											<input type="hidden" name="edit_record_id" value="{{$record->id}}">							
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Name<span class="required">*</span></label>
														<input type="text" name="name" id="name" value="{{old('name', $record->name)}}" class="form-control form-control-user" required placeholder="Payment gateway name" />
														@if ($errors->has('name'))
															<span class="text-danger">{{ $errors->first('name') }}</span>
														@endif
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Payment Mode<span class="required">*</span></label>
														<select name="payment_mode" id="payment_mode" class="form-control form-control-user" required>
															<option value="">Select Payment Mode</option>
															<option value="Live" {{ old('payment_mode', $record->payment_mode) == 'Live'  ? 'selected' : ''}}>Live</option>
															<option value="Test" {{ old('payment_mode', $record->payment_mode) == 'Test'  ? 'selected' : ''}}>Test</option>
														</select>
														@if ($errors->has('payment_mode'))
															<span class="text-danger">{{ $errors->first('payment_mode') }}</span>
														@endif
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-8 col-md-6 col-12">
													<div class="form-group">
														<label>Description<span class="required">*</span></label>
														<textarea  name="description" class="form-control form-control-user" required /> {{old('description', $record->description)}}</textarea>
														@if ($errors->has('description'))
															<span class="text-danger">{{ $errors->first('description') }}</span>
														@endif
													</div>
												</div>
											</div>											
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>API Key<span class="required">*</span></label>
														<input type="text" name="api_key" id="api_key" value="{{old('api_key', $record->api_key)}}" class="form-control form-control-user" required/>
														@if ($errors->has('api_key'))
															<span class="text-danger">{{ $errors->first('api_key') }}</span>
														@endif
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Secret Key<span class="required">*</span></label>
														<input type="text" name="secret_key" id="secret_key" value="{{old('secret_key', $record->secret_key)}}" class="form-control form-control-user" required />
														@if ($errors->has('secret_key'))
															<span class="text-danger">{{ $errors->first('secret_key') }}</span>
														@endif
													</div>
												</div>
											</div>									
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Sandbox URL<span class="required">*</span></label>
														<input type="text" name="sandbox_url" id="sandbox_url" value="{{old('sandbox_url', $record->sandbox_url)}}" class="form-control form-control-user" required/>
														@if ($errors->has('sandbox_url'))
															<span class="text-danger">{{ $errors->first('sandbox_url') }}</span>
														@endif
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Live URL<span class="required">*</span></label>
														<input type="text" name="live_url" id="live_url" value="{{old('live_url', $record->live_url)}}" class="form-control form-control-user" required />
														@if ($errors->has('live_url'))
															<span class="text-danger">{{ $errors->first('live_url') }}</span>
														@endif
													</div>
												</div>
											</div>							
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Email<span class="required">*</span></label>
														<input type="email" name="email" id="email" value="{{old('email', $record->email)}}" class="form-control form-control-user" required/>
														@if ($errors->has('email'))
															<span class="text-danger">{{ $errors->first('email') }}</span>
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
													<button type="submit" id="save-paymentgateway-btn" class="btn btn-primary">Update</button>
													<a href="{{route('paymentgateways.list')}}" class="btn btn-light">Cancel</a>
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