@extends('dashboard')
 
@section('content')

<style>
    .col-4.text-left{
        text-align:left
    }
</style>

<nav aria-label="breadcrumb">
 <ol class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Visitor</li>
    </ol> 
</nav>

<div class="row mt-4">
	<div class="col-md-12">
    @if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>
	@endif
		<div class="card">
			<div class="card-header">Add Visitor</div>
			<div class="card-body">
            <form method="POST" action="{{ route('visitor.edit_validation') }}">
            @csrf

                    <div class="row">
                        <div class="col-6">

                        <div class="form-group mb-3 d-flex">
                    <div class="col-4 text-left"> <label for="name">Visitor Name</label></div>

 		        		<div>
						 <input type="text" name="visitor_name" class="form-control" placeholder="Visitor Name" value='{{$data->visitor_name}}'/>
		        		@if($errors->has('visitor_name'))
		        		<span class="text-danger">{{ $errors->first('visitor_name') }}</span>
		        		@endif
						</div>
		        	</div>







                    
					<div class="form-group mb-3 d-flex">
                    <div class="col-4 text-left"> <label for="name">Visitor Email</label></div>

 		        		<div>
						 <input type="text" name="visitor_email" class="form-control" placeholder="Visitor Email" value='{{$data->visitor_email}}'/>
		        		@if($errors->has('visitor_email'))
		        		<span class="text-danger">{{ $errors->first('visitor_email') }}</span>
		        		@endif
						</div>
		        	</div>



    
					<div class="form-group mb-3 d-flex">
                    <div class="col-4 text-left"> <label for="name">Visitor Phone</label></div>

 		        		<div>
						 <input type="text" name="visitor_mobile_no" class="form-control" placeholder="Visitor Phone" value='{{$data->visitor_mobile_no}}'/>
		        		@if($errors->has('visitor_mobile_no'))
		        		<span class="text-danger">{{ $errors->first('visitor_mobile_no') }}</span>
		        		@endif
						</div>
		        	</div>
                    





                    
                    
					<div class="form-group mb-3 d-flex">
                    <div class="col-4 text-left"> <label for="name">Visitor Address</label></div>

 		        		<div>
						 <input type="text" name="visitor_address" class="form-control" placeholder="Visitor Address" value='{{$data->visitor_address}}'/>
		        		@if($errors->has('visitor_address'))
		        		<span class="text-danger">{{ $errors->first('visitor_address') }}</span>
		        		@endif
						</div>
		        	</div>


                    <div class="form-group mb-3 d-flex">
                    <div class="col-4 text-left"> <label for="name">Department</label></div>

 		        		<div>
						 <input type="text" name="visitor_department" class="form-control" placeholder="Visitor Address" value='{{$data->visitor_department}}'/>
		        		@if($errors->has('visitor_department'))
		        		<span class="text-danger">{{ $errors->first('visitor_department') }}</span>
		        		@endif
						</div>
		        	</div>

                    

      


                        </div>
                        <div class="col-6">

              

                        <div class="form-group mb-3 d-flex">
                    <div class="col-4 text-left"> <label for="name">Meet Person</label></div>

 		        		<div>
						 <input type="text" name="visitor_meet_person_name" class="form-control" placeholder="Visitor Address" value='{{$data->visitor_meet_person_name}}'/>
		        		@if($errors->has('visitor_meet_person_name'))
		        		<span class="text-danger">{{ $errors->first('visitor_meet_person_name') }}</span>
		        		@endif
						</div>
		        	</div>



                        
 



    
					<div class="form-group mb-3 d-flex">
                    <div class="col-4 text-left"> <label for="name">Reason</label></div>

 		        		<div>
						 <input type="text" name="visitor_reason_to_meet" class="form-control" placeholder="Reason" value='{{$data->visitor_reason_to_meet}}'/>
		        		@if($errors->has('visitor_reason_to_meet'))
		        		<span class="text-danger">{{ $errors->first('visitor_reason_to_meet') }}</span>
		        		@endif
						</div>
		        	</div>
                    





                    
                    
					<div class="form-group mb-3 d-flex">
                    <div class="col-4 text-left"> <label for="name">Entered Time</label></div>

 		        		<div>
						 <input type="text" name="visitor_enter_time" class="form-control" placeholder="Entered Time" value='{{$data->visitor_enter_time}}'/>
		        		@if($errors->has('visitor_enter_time'))
		        		<span class="text-danger">{{ $errors->first('visitor_enter_time') }}</span>
		        		@endif
						</div>
		        	</div>



    
					<!-- <div class="form-group mb-3 d-flex">
                    <div class="col-4 text-left"> <label for="name">Exit Remark</label></div>

 		        		<div>
						 <input type="text" name="visitor_outing_remark" class="form-control" placeholder="Remark"  value='-'/>
		        		@if($errors->has('visitor_outing_remark'))
		        		<span class="text-danger">{{ $errors->first('visitor_outing_remark') }}</span>
		        		@endif
						</div>
		        	</div> -->
                    



 

                    
                    
					<div class="form-group mb-3 d-flex">
                    <div class="col-4 text-left"> <label for="name">Exit Time</label></div>

 		        		<div>
						 <input type="text" name="visitor_out_time" class="form-control" placeholder="Exit Time" value='{{$data->visitor_out_time}}'/>
		        		@if($errors->has('visitor_out_time'))
		        		<span class="text-danger">{{ $errors->first('visitor_out_time') }}</span>
		        		@endif
						</div>
		        	</div>


 
    
					<div class="form-group mb-3 d-flex">
                    <div class="col-4 text-left"> <label for="name">Status</label></div>

 		        		<div>
                            <select name="visitor_status" id="">
                                <!-- <option value="-" disabled selected>-</option>
                                <option value="In">In</option> -->
                                <option value="Out" selected>Out</option>
                            </select>
 		        		@if($errors->has('visitor_status'))
		        		<span class="text-danger">{{ $errors->first('visitor_status') }}</span>
		        		@endif
						</div>
		        	</div>
                        </div>
                    </div>





                    
                    





                    
            


 


     









		        	<div class="form-group mb-3">
                    <input type="hidden" class="btn btn-primary" name="row_id" value="{{ $data->id }}" />

                    <input type="hidden" class="btn btn-primary" name="visitor_outing_remark" value="{{ auth()->id() }}" />
                    <input type="hidden" class="btn btn-primary" name="visitor_enter_by" value="{{ auth()->id() }}" />
                    <input type="submit" class="btn btn-primary" value="Edit" />
		        	</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
  


</script>

@endsection