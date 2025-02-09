@extends('dashboard')

@section('content') 

<div class="container">
<div class="row mt-5">
<div class="offset-md-4 col-md-4">
    <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
        @if(session()->has('error'))
<div class="alert alert-danger">
    {{session()->get('error')}}
</div>
        @endif
            <form action='{{route("login.custom")}}' method='POST'>
                @csrf
 
<div class="form-group mb-3">
    <input type="text" name='email' placeholder='Enter Email' class='form-control' value=''>
    @if($errors->has('email'))
        <span class="text-danger">{{$errors->first('email')}}</span>
    @endif
</div>

<div class="form-group mb-3">
    <input type="password" name='password' placeholder='Enter Password' class='form-control' value=''>
    @if($errors->has('password'))
        <span class="text-danger">{{$errors->first('password')}}</span>
    @endif
</div>


<div class="form-group mb-3 text-center">
<button type='submit' class='btn btn-dark btn-block'>Login</button>
</div>
<br>
<!-- <div class="text-center">
<p>Admin? <a href="{{route('login')}}">Register</a></p>
</div> -->


            </form>

        </div>
    </div>
</div>
</div>
</div>

 
@endsection
