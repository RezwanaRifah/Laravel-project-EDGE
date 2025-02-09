<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='{{asset("css/bootstrap.css")}}'>
    <link rel="stylesheet" href='{{asset("css/dataTables.bootstrap5.min.css")}}'>
    <style>
        .nav-link {
     padding: 1rem 1rem 0 2rem;
     text-align: left;
}
    </style>
</head>
<body class='text-center'>

<div class="mt-3">
<h3>UiMonk Co-working Office </h3>
<h6>Visitor Management System</h6>

</div>
@guest
@yield('content')

@else

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">UiMonk</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="#">Welcome, {{ Auth::user()->email }}</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                        </li>

                        @if(Auth::user()->type == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('receptionist') }}">Receptionist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('department') }}">Department</a>
                        </li>
                    

                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('visitor') }}">Visitor</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>

                    </ul>

                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!--<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">!-->
                @yield('content') 
                <!--</div>!-->
            </main>
        </div>
    </div>    




@endguest

<script src='{{asset("js/jquery.js")}}'></script>
<script src='{{asset("js/jquery.dataTables.min.js")}}'></script> 
<script src='{{asset("js/bootstrap.js")}}'></script>
<script src='{{asset("js/dataTables.bootstrap5.min.js")}}'></script>
</body>
</html>