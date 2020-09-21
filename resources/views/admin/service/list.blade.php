@extends('admin.layouts.cmlayout')

@section('body')
<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Services</h1>
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
				<div class="card-header py-3">
					<div class="buttons-right">
						<a class="m-0 font-weight-bold btn-department-add pull-right hover-white" href="{{route('service.add')}}">Add Service</a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered yajra-datatable">
							<thead>
								<tr>
									<th>S.No</th>
									<th>Name</th>
									<th>Status</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
        </div>
	</div>
</div>

<script>
  jQuery(function () {
    var table = jQuery('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        Filter: true,
 
        ajax: {
          url: "{{ route('services.list') }}",
          data: function (d) {
                d.search = jQuery('input[type="search"]').val()
            }
        },
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'status', name: 'status',orderable: false, searchable: false,},
                    { data: 'created_at', name: 'created_at' },
                    {
                      data: 'action', 
                      name: 'action', 
                      orderable: false, 
                      searchable: false
                  },
                 ]
        });
     });
  </script>

<script type="text/javascript">
  function deleteservice(obj, pid) {
      var result = confirm("Are you sure you want to delete this Service ?");
      if (result) {
          jQuery.ajax({
              method: 'POST',
              url: '/admin/service/del',
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
<!-- /.container-fluid -->
@endsection