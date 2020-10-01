@extends('admin.layouts.cmlayout')

@section('body')
                <div class="container-fluid">
                    <div class="row page-title  no-display">
                        <div class="col-md-12">
                            <h4 class="mb-1 mt-0">CMS Pages</h4>
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
										Edit CMS Page
										<a href="{{route('cmspages.list')}}" class="float-right"><i data-feather="x"></i></a>					
									</h5>
									<form action="{{route('cmspage.update')}}" method="post" class="user" id="add_genre_form" enctype="multipart/form-data">
										@csrf			
											<input type="hidden" name="edit_record_id" value="{{$record->id}}">									
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Title<span class="required">*</span></label>
														<input type="text" name="title" id="title" value="{{old('title', $record->title)}}" class="form-control form-control-user" required />
														@if ($errors->has('title'))
															<span class="text-danger">{{ $errors->first('title') }}</span>
														@endif
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Slug<span class="required">*</span></label>
														<input type="text" name="slug" id="slug" value="{{old('slug', $record->slug)}}" class="form-control form-control-user" required />
														@if ($errors->has('slug'))
															<span class="text-danger">{{ $errors->first('slug') }}</span>
														@endif
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Short Description<span class="required">*</span></label>
														<textarea  name="short_description" class="form-control form-control-user"  /> {{old('short_description', $record->short_description)}}</textarea>
														@if ($errors->has('short_description'))
															<span class="text-danger">{{ $errors->first('short_description') }}</span>
														@endif
													</div>
												</div>
												
											
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Description<span class="required">*</span></label>
														<textarea  name="description" class="form-control form-control-user"  /> {{old('description', $record->description)}}</textarea>
														@if ($errors->has('description'))
															<span class="text-danger">{{ $errors->first('description') }}</span>
														@endif
													</div>
												</div>
											</div>									
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Meta Title<span class="required">*</span></label>
														<input type="text" name="meta_title" value="{{old('meta_title', $record->meta_title)}}" id="meta_title" class="form-control form-control-user" required />
														@if ($errors->has('meta_title'))
															<span class="text-danger">{{ $errors->first('meta_title') }}</span>
														@endif
													</div>
												</div>
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Meta Keyword<span class="required">*</span></label>
														<input type="text" name="meta_keyword" id="meta_keyword" value="{{old('meta_keyword', $record->meta_keyword)}}" class="form-control form-control-user" required />
														@if ($errors->has('meta_keyword'))
															<span class="text-danger">{{ $errors->first('meta_keyword') }}</span>
														@endif
													</div>
												</div>
											</div>									
											<div class="row">
												<div class="col-lg-4 col-md-6 col-12">
													<div class="form-group">
														<label>Meta Content<span class="required">*</span></label>
														<input type="text" name="meta_content" id="meta_content" value="{{old('meta_content', $record->meta_content)}}" class="form-control form-control-user" required />
														@if ($errors->has('meta_content'))
															<span class="text-danger">{{ $errors->first('meta_content') }}</span>
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
													<button type="submit" id="save-cmspage-btn" class="btn btn-primary">Update</button>
													<a href="{{route('cmspages.list')}}" class="btn btn-light">Cancel</a>
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