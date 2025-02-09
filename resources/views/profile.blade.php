@extends('dashboard')

 @section('content')


<div class="container">
  
    <div class="row mt-3">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><h5>Edit Admin Profile</h5></div>
                <div class="card-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    <form action="{{ route('profile.edit') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3 d-flex ">
                            <div class="col-4 text-left"> <label for="name">User Name</label></div>
                           
                           <div>
                           <input type="text" name="name" placeholder="Enter Name" class="form-control" value="{{ $data->name }}">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                           </div>
                        </div>

                        <div class="form-group mb-3 d-flex ">
                             <div class="col-4 text-left"> <label for="Email">Email</label></div>

                          <div>
                          <input type="email" name="email" placeholder="Enter Email" class="form-control" value="{{ $data->email }}">
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                          </div>
                        </div>

                        <div class="form-group mb-3 d-flex ">
                             <div class="col-4 text-left"> <label for="Password">Password</label></div>

                            <div>
                            <input type="password" name="password" placeholder="Enter Password" class="form-control">
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group mb-3 text-center">
                            <button type="submit" class="btn btn-dark btn-block">Update Profile</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>

@endsection
