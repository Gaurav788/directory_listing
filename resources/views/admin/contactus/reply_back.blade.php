@extends('admin.layouts.cmlayout')

@section('body')
                <div class="container-fluid">
                    <div class="row page-title  no-display">
                        <div class="col-md-12">
                            <h4 class="mb-1 mt-0">Contact Us</h4>
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
										Reply Back
										<a href="{{route('contactus.list')}}" class="float-right"><i data-feather="x"></i></a>					
									</h5>
									<form action="{{route('contactus.replied')}}" method="post" class="user" id="add_genre_form" enctype="multipart/form-data">
										@csrf						
											<input type="hidden" name="edit_record_id" value="{{$data->id}}">								
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>User's Name<span class="required">*</span></label>
														<input type="text" name="name" id="name" value="{{$data->name}}" class="form-control form-control-user" readonly />
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>User's Email<span class="required">*</span></label>
														<input type="text" name="toemail" id="toemail" value="{{$data->email}}" class="form-control form-control-user" readonly />
													</div>
												</div>
											</div>										
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Reason to Contact<span class="required">*</span></label>
														<textarea class="form-control form-control-user" name="reason_to_contact" readonly >{{$data->reason_to_contact}}</textarea>
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>User's Message<span class="required">*</span></label>
														<textarea class="form-control form-control-user" readonly name="message">{{$data->message}}</textarea>
													</div>
												</div>
											</div>											
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>From Email<span class="required">*</span></label>
														<input type="email" name="fromemail" id="fromemail" value="{{old('fromemail')}}" class="form-control form-control-user" required />
														@if ($errors->has('fromemail'))
															<span class="text-danger">{{ $errors->first('fromemail') }}</span>
														@endif
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Subject<span class="required">*</span></label>
														<input type="text" name="subject" id="subject" value="{{old('subject')}}" class="form-control form-control-user" required />
														@if ($errors->has('subject'))
															<span class="text-danger">{{ $errors->first('subject') }}</span>
														@endif
													</div>
												</div>
											</div>	
											<div class="row">
												<div class="col-lg-8 col-md-6 col-12">
													<div class="form-group">
														<label>Reply Message<span class="required">*</span></label>
														<textarea  name="reply_message" class="form-control form-control-user editor" required /> {{old('reply_message')}}</textarea>
														@if ($errors->has('reply_message'))
															<span class="text-danger">{{ $errors->first('reply_message') }}</span>
														@endif
													</div>
												</div>
												
											
											</div>							
											<div class="mt-1 mb-1">
												<div class="text-left d-print-none mt-4">
													<button type="submit" id="save-category-btn" class="btn btn-primary">Save</button>
													<a href="{{route('contactus.list')}}" class="btn btn-light">Cancel</a>
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
      selector: 'textarea.editor'
    });
  </script>
@stop