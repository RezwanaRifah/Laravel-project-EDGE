@extends('dashboard')

 @section('content')

 <script src='{{asset("js/jquery.js")}}'></script>
<script src='{{asset("js/jquery.dataTables.min.js")}}'></script> 
<script src='{{asset("js/bootstrap.js")}}'></script>
<script src='{{asset("js/dataTables.bootstrap5.min.js")}}'></script>

<div class="container">
<ol class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Receptionist</li>
    </ol> 
  
    <div class="row mt-3">
        <div class="col-md-12">
             <div class="card">
                <div class="card-header ">
<a href="{{route('receptionist.add')}}" class="btn btn-primary float-end">Add Receptionist</a>
                </div>
                <div class="table-responsives">
                <table class="table table-bordered" id="receptionist_table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Created At</th>
							<th>Updated At</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
                </div>
             </div>
        </div>
    </div>
</div>



    
<script>
$(function(){

	var table = $('#receptionist_table').DataTable({
		processing:true,
		serverSide:true,
		ajax:"{{ route('receptionist.fetchall') }}",
		columns:[
			{
				data:'name',
				name:'name'
			},
			{
				data:'email',
				name:'email'
			},
			{
				data:'created_at',
				name:'created_at'
			},
			{
				data:'updated_at',
				name:'updated_at'
			},
			{
				data:'action',
				name:'action',
				orderable:false
			}
		]
	});

	$(document).on('click', '.delete', function(){

		var id = $(this).data('id');

		if(confirm("Are you sure you want to remove it?"))
		{
			window.location.href = "/receptionist/delete/" + id;
		}

	});

})
</script>
@endsection
