@extends('admin.layouts.cmlayout')

@section('body')
<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Testimonials List</h1>
	</div>
	<div class="flash-message">
		@if(session()->has('status'))
			@if(session()->get('status') == 'success')
				<div class="alert alert-success  alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session()->get('message') }}
				</div>
			@endif
		@endif
	</div> <!-- end .flash-message -->
	<div class="row">
        <div class="col-xl-12 col-md-12">
			<div class="card shadow mb-4">
				<div class="card-body">
					<div class="table-responsive">
						<table id="artistlisting-datatable" class="table table-hover dt-responsive nowrap">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Person's Details</th>
									<th>Feedback</th>
									<th>Url</th>
									<th>Status</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							  <?php $i=1; ?>
								@forelse($data as $row)
								<tr>
									<td>{{$i}}</td>
									<td><p class="no-margin">{{$row->name}}</p><p class="no-margin">{{$row->email}}</p></td>
									<td>{{strip_tags($row->feedback)}}</td>
									<td>{{$row->url}}</td>
									<td>
									@if($row->status == 0)
										<a title="Click to Enable" href="{{route('testimonial.status', ['g' => $row->id, 's' => 1])}}" class="tableLink"><img alt="Click to Enable" src="/assets/images/off.png" /></a> Disabled
									@else
										<a title="Click to Disable" href="{{route('testimonial.status', ['g' => $row->id, 's' => 0])}}" class="tableLink"><img title="Click to Disable" src="/assets/images/on.png" /></a> Enabled
									@endif
									</td>
									<td>{{$row->created_at}}</td>
									<td>
									<a class="anchorLess">
									   <a title="Click to Delete" href="javascript:void(0)" class="anchorLess" onclick="deletetestimonial(this,'{{$row->id}}');"><i class="fas fa-trash danger" aria-hidden="true" ></i></a>
									</a>      
									</td>
								</tr>
							  <?php $i++; ?>
								@empty
							   <tr>
									<td colspan="6" class="text-center">No record found</td>
								</tr>
							 @endforelse 
							</tbody>
						</table>
					</div>
				</div>
			</div>
        </div>
	</div>
</div>

<script type="text/javascript">
  function deletetestimonial(obj, pid) {
      var result = confirm("Are you sure you want to delete this testimonial ?");
      if (result) {
          jQuery.ajax({
              method: 'POST',
              url: '/admin/paymentmethod/del',
              dataType: 'json',
              data: {
                  'id': pid,
                  '_token': jQuery('meta[name="csrf-token"]').attr('content'),
              },
              success: function(data) {
                  location.reload(true);
              },
              error: function(data) {
                  alert(data.msg);
              },
          });
      } else {
          return false;
      }
  }
</script>
<style>
.no-margin{margin:0px;}
</style>
<!-- /.container-fluid -->
@endsection