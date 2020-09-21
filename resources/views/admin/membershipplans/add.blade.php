@extends('admin.layouts.cmlayout')

@section('body')
                <div class="container-fluid">
                    <div class="row page-title  no-display">
                        <div class="col-md-12">
                            <h4 class="mb-1 mt-0">Membership Plans</h4>
                        </div>
                    </div>

                    <div class="row mt-4">
						<div class="col-md-12">
                            <div class="card">
                                <div class="card-body pt-2 pb-3 manageClinicSection">
                                    <h5 class="mt-3 mb-4">
										Create Membership Plan
										<a href="{{route('membershipplan.list')}}" class="float-right"><i data-feather="x"></i></a>					
									</h5>
									<form action="{{route('membershipplan.create')}}" method="post" class="user" id="add_genre_form" enctype="multipart/form-data">
										@csrf												
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Name<span class="required">*</span></label>
														<input type="text" name="name" id="name" class="form-control form-control-user" required />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Details<span class="required">*</span></label>
														<textarea  name="details" class="form-control form-control-user" required /></textarea>
													</div>
												</div>
												
											
											</div>										
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Currency<span class="required">*</span></label>
														<input type="text" name="currency" id="currency" class="form-control form-control-user" required />
													</div>
												</div>
											</div>									
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Price<span class="required">*</span></label>
														<input type="number" name="price" id="price" class="form-control form-control-user" required />
													</div>
												</div>
											</div>									
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Duration<span class="required">*</span></label>
														<select name="duration" id="duration" class="form-control form-control-user" required>
															<option value="">Select Duration</option>
															<option value="Monthly">Monthly</option>
															<option value="Quaterly">Quaterly</option>
															<option value="HalfYearly">HalfYearly</option>
															<option value="Annually">Annually</option>
														</select>
														
													</div>
												</div>
											</div>					
											<div class="mt-1 mb-1">
												<div class="text-left d-print-none mt-4">
													<button type="submit" id="save-membershipplan-btn" class="btn btn-primary">Save</button>
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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea'});</script>
@stop