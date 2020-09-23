@extends('admin.layouts.cmlayout')

@section('body')

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Membership Plan List</h1>
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
              <a class="m-0 font-weight-bold btn-department-add pull-right hover-white" href="{{route('membershipplan.add')}}">Add Membership Plan</a>
            </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table id="artistlisting-datatable" class="table table-hover dt-responsive nowrap">
                    <thead>

                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th>Price</th>
                            <th>Currency</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; ?>
                        @forelse($plans as $row)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{strip_tags($row->details)}}</td>
                            <td>{{$row->price}}</td>
                            <td>{{$row->currency}}</td>
                            <td>{{$row->duration}}</td>
                            <td>
							@if($row->status == 0)
								<a title="Click to Enable" href="{{route('membershipplan.status', ['g' => $row->id, 's' => 1])}}" class="tableLink"><img alt="Click to Enable" src="/assets/images/off.png" /></a> Disabled
							@else
								<a title="Click to Disable" href="{{route('membershipplan.status', ['g' => $row->id, 's' => 0])}}" class="tableLink"><img title="Click to Disable" src="/assets/images/on.png" /></a> Enabled
							@endif
							</td>
                            <td>{{$row->created_at}}</td>
                            <td>
                            <a class="anchorLess">
                               <a title="Click to Edit" href="{{route('membershipplan.edit',[$row->id])}}" class="anchorLess"><i class="fas fa-edit info" aria-hidden="true" ></i></a>
                               <a title="Click to Delete" href="javascript:void(0)" class="anchorLess" onclick="deletemembershipplan(this,'{{$row->id}}');"><i class="fas fa-trash danger" aria-hidden="true" ></i></a>
                            </a>      
                            </td>
                        </tr>
                      <?php $i++; ?>
                        @empty
                       <tr>
                            <td colspan="9" class="text-center">No record found</td>
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


@endsection



<script type="text/javascript">
function deletemembershipplan(obj, pid) {
    var result = confirm("Are you sure you want to delete this membership plan ?");
    if (result) {
        jQuery.ajax({
            method: 'POST',
            url: '/admin/membershipplan/del',
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