@extends('admin.layouts.cmlayout')

@section('body')
                <div class="container-fluid">
                    <div class="row page-title  no-display">
                        <div class="col-md-12">
                            <h4 class="mb-1 mt-0">Currencies</h4>
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
										Update Currency
										<a href="{{route('currencies.list')}}" class="float-right"><i data-feather="x"></i></a>					
									</h5>
									<form action="{{route('currency.update')}}" method="post" class="user" id="edit_genre_form" enctype="multipart/form-data">
										@csrf
											<input type="hidden" name="edit_record_id" value="{{$record->id}}">	
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Name<span class="required">*</span></label>
														<input type="text" name="name" id="name" class="form-control form-control-user" value="{{old('name', $record->name)}}" required />
														@if ($errors->has('name'))
															<span class="text-danger">{{ $errors->first('name') }}</span>
														@endif
													</div>
												</div>
											</div>
							
											<div class="mt-1 mb-1">
												<div class="text-left d-print-none mt-4">
													<button type="submit" id="edit-service-btn" class="btn btn-primary">Update</button>
													<a href="{{route('currencies.list')}}" class="btn btn-light">Cancel</a>
												</div>
												
											</div>
									</form>
                            </div>
                          
                        </div>
                        
                        


                    </div>
                    <!-- end row -->
                </div> <!-- container-fluid -->
@endsection