@extends('dashboard')

@section('content')
<script src='{{asset("js/jquery.js")}}'></script>
<script src='{{asset("js/jquery.dataTables.min.js")}}'></script> 
<script src='{{asset("js/bootstrap.js")}}'></script>
<script src='{{asset("js/dataTables.bootstrap5.min.js")}}'></script>


 <nav aria-label="breadcrumb">
 <ol class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Department</li>
    </ol> 
</nav>

<div class="row mt-4">
	<div class="col-md-8">
    @if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>
	@endif
		<div class="card">
			<div class="card-header">Edit Department</div>
			<div class="card-body">
				<form method="POST" action="{{ route('department.edit_validation') }}">
					@csrf
					<div class="form-group mb-3 d-flex">
                    <div class="col-4 text-left"> <label for="name">Department Name</label></div>

 		        		<div>
						 <input type="text" name="department_name" class="form-control" placeholder="Name" value='{{$data->department_name}}'/>
		        		@if($errors->has('department_name'))
		        		<span class="text-danger">{{ $errors->first('department_name') }}</span>
		        		@endif
						</div>
		        	</div>


                <div class="form-group mb-3">
		        		<label><b>Contact Person</b></label>
                        @php
                            $contact_name = explode(',',$data->contact_name)
                        @endphp

                         @for($i = 0; $i < count($contact_name); $i++)

                        <div class="row mt-2" id="person_{{ $i }}">
		        			<div class="col col-md-10">
		        				<input type="text" name="contact_name[]" class="form-control"  value="{{ $contact_name[$i] }}" />
		        			</div>
		        			<div class="col col-md-2">
		        				@if($i == 0)
		        				<button type="button" name="add_person" id="add_person" class="btn btn-success btn-sm">+</button>
		        				@else
		        				<button type="button" class="btn btn-danger btn-sm remove_person" data-id="{{ $i }}">-</button>
		        				@endif
		        			</div>
		        		</div>
                        @endfor
		        		 
		        		<div id="append_person"></div>
		        	</div>



 
		        	<div class="form-group mb-3">
                    <input type="hidden" name="hidden_id" value="{{ $data->id }}" />
		        		<input type="hidden" id="total_contact_name" value="{{ $i }}" />

		        		<input type="submit" class="btn btn-primary" value="Edit Department" />
		        	</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
    
$(document).ready(function(){
	var count_person = $('#total_contact_name').val();

	$(document).on('click', '#add_person', function(){

		count_person++;

		var html = `
		<div class="row mt-2" id="person_`+count_person+`">
			<div class="col-md-10">
				<input type="text" name="contact_name[]" class="form-control department_contact_name" />
			</div>
			<div class="col-md-2">
				<button type="button" name="remove_person" class="btn btn-danger btn-sm remove_person" data-id="`+count_person+`">-</button>
			</div>
		</div>
		`;

		$('#append_person').append(html);

	});



	$(document).on('click', '.remove_person', function(){

		var button_id = $(this).data('id');

		$('#person_'+button_id).remove();

	});
});
</script>
@endsection