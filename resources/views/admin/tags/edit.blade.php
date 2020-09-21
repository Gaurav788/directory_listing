@extends('admin.layouts.cmlayout')

@section('body')
                <div class="container-fluid">
                    <div class="row page-title  no-display">
                        <div class="col-md-12">
                            <h4 class="mb-1 mt-0">Tags</h4>
                        </div>
                    </div>

                    <div class="row mt-4">
                      <div class="col-md-12">
                            <div class="card">
                                <div class="card-body pt-2 pb-3 manageClinicSection">
                                    <h5 class="mt-3 mb-4">
										Update Tag
										<a href="{{route('tags.list')}}" class="float-right"><i data-feather="x"></i></a>					
									</h5>
									<form action="{{route('tag.update')}}" method="post" class="user" id="edit_genre_form" enctype="multipart/form-data">
										@csrf
											<input type="hidden" name="edit_record_id" value="{{$record->id}}">	
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Name<span class="required">*</span></label>
														<input type="text" name="name" id="name" class="form-control form-control-user" value="{{$record->name}}" required />
													</div>
												</div>
											</div>
							
											<div class="mt-1 mb-1">
												<div class="text-left d-print-none mt-4">
													<button type="submit" id="edit-tag-btn" class="btn btn-primary">Update</button>
													<a href="{{route('tags.list')}}" class="btn btn-light">Cancel</a>
												</div>
												
											</div>
									</form>
                            </div>
                          
                        </div>
                        
                        


                    </div>
                    <!-- end row -->
                </div> <!-- container-fluid -->
@endsection