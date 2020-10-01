@extends('admin.layouts.cmlayout')

@section('body')
<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Users List</h1>
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
									<th>Image</th>
									<th>Person's Details</th>
									<th>Role</th>
									<th>From</th>
									<th>Status</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; ?>
								@foreach($data as $row)
								<tr>
									<td>{{$i}}</td>
									<td>
									@if($row->user_detail && $row->user_detail->profile_picture)
										<img  class="img-profile rounded-circle" src="{{ 'data:image/' .$row->user_detail->imagetype. ';base64,' .base64_encode($row->user_detail->profile_picture) }}"style="height: 65px;">
									@endif
									</td>
									<td><p class="no-margin"><strong>Name: </strong>{{$row->first_name.' '.$row->last_name}}</p><p class="no-margin"><strong>Email: </strong>{{$row->email}}</p>@if($row->user_detail && $row->user_detail->mobile)<p class="no-margin"><strong>Mobile: </strong>{{$row->user_detail->mobile}}</p>@endif</td>
									<td>{{$row->role->name}}</td>
									<td>{{$row->social_type}}</td>
									<td>
									@if($row->status == 0)
										<a title="Click to Enable" href="{{route('user.status', ['g' => $row->id, 's' => 1])}}" class="tableLink"><img alt="Click to Enable" src="/assets/images/off.png" /></a>&nbsp;Disabled
									@else
										<a title="Click to Disable" href="{{route('user.status', ['g' => $row->id, 's' => 0])}}" class="tableLink"><img title="Click to Disable" src="/assets/images/on.png" /></a>&nbsp;Enabled
									@endif
									</td>
									<td>{{date('d F Y', strtotime($row->created_at))}}</td>
									<td>
									<a class="anchorLess">
									   <a title="Click to Edit" href="{{route('user.edit',[$row->id])}}" class="anchorLess"><i class="fas fa-edit info" aria-hidden="true" ></i></a>
									   <a title="Click to Change Password" class="anchorLess" href="{{route('user.changepassword',[$row->id])}}" ><i class="fas fa-key success" aria-hidden="true" ></i></a>
									   <a title="Click to Delete" href="javascript:void(0)" class="anchorLess" onclick="deleteuser(this,'{{$row->id}}');"><i class="fas fa-trash danger" aria-hidden="true" ></i></a>
									</a>    
									</td>
								</tr>
								<?php $i++; ?>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th>S.No</th>
									<th>Image</th>
									<th>Person's Details</th>
									<th>Role</th>
									<th>From</th>
									<th>Status</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
        </div>
	</div>
</div>

<script type="text/javascript">
  function deleteuser(obj, pid) {
      var result = confirm("Are you sure you want to delete this user ?");
      if (result) {
          jQuery.ajax({
              method: 'POST',
              url: '/admin/user/del',
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