<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Wuling HRMS &mdash; 2023</title>

  <link rel="icon" href="{{ url('img/logo.png') }}">
 
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('modules/fontawesome/css/all.min.css')}}">

  {{-- <link rel="stylesheet" href="path/to/fontawesome.min.css"> --}}

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset("modules/fullcalendar/fullcalendar.min.css") }}" >
    
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{asset('modules/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('modules/weather-icon/css/weather-icons.min.css')}}">
  <link rel="stylesheet" href="{{asset('modules/weather-icon/css/weather-icons-wind.min.css')}}">
  <link rel="stylesheet" href="{{asset('modules/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{asset('modules/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{asset('modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="{{asset('css/components.css')}}">
  <link rel="stylesheet" href="{{asset('css/custom.css')}}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<script src="{{asset('js/page/modules-chartjs.js')}}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>
<body>
    <div id="app">
      <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar main-navbar sticky-top">
            <ul class="navbar-nav mr-3">
              <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            </ul>
            
          <ul class="navbar-nav navbar-right ">
            
            <li class="dropdown">
              <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{asset('img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::user()->name}}!</div>
              </a>  
              <div class="dropdown-menu dropdown-menu-right">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
        
                    <div class="dropdown-item">
                      <a href="route('logout')"
                      onclick="event.preventDefault();
                                  this.closest('form').submit();" class="has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i>Log out
                      </a>
                  </form>
                </div>
                </div>
              </div>
            </li>
          </ul>
        </nav>


        <div class="main-sidebar sidebar-style-2">
          <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="/dashboard">Leave Management System</a>
            </div>
              <div class="sidebar-brand sidebar-brand-sm">
                <img src="{{asset('img/logo.png')}}" alt="logo" height="40px" width="40px" class="shadow-dark rounded-circle">
              </div>
                <ul class="sidebar-menu">
                @if (auth()->user()->level==="supervisor" && "employee")
                <div class="p-3 hide-sidebar-mini">
                  <a href="/leave-request/create" class="btn btn-primary btn-lg btn-block btn-icon-splitS">
                    <i class="fas fa-rocket"></i>
                    Propose Leave
                  </a>
                </div>
                @endif
                  <li class="dropdown {{ (request()->is('dashboard*')) ? 'active' : '' }}">
                    <a href="/dashboard" class="nav-link">
                      <i class="fas fa-fire"></i>
                      <span>Summary</span>
                    </a>
                  </li>
                  {{-- <li class="dropdown {{ (request()->is('employee*')) ? 'active' : '' }}">
                    <a href="/employee" class="nav-link">
                      <i class="fas fa-users"></i>
                      <span>Propose Leave</span>
                    </a> --}}
                  </li>
                  @if (auth()->user()->level=="admin")
                  <li class="dropdown {{ (request()->is('employee*')) ? 'active' : '' }}">  
                    <a href="/employee" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span>Employee Data</span>
                    </a>        
                  </li>
                  <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown">
                      <i class="fas fa-table"></i>
                      <span>Employee Component</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="{{ (request()->is('department')) ? 'active' : '' }}">
                        <a class="nav-link" href="/department">Department list</a>
                      </li>
                      <li class="{{ (request()->is('title')) ? 'active' : '' }}">
                        <a class="nav-link" href="/title">Title list</a>
                      </li>
                    </ul>
                  @endif
                 
                  <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown">
                      <i class="fas fa-table"></i>
                      <span>Leave Data</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="{{ (request()->is('employee/remain-leave')) ? 'active' : '' }}">
                        <a class="nav-link" href="/employee/remain-leave">Remain Leave</a>
                      </li>
                      
                      @if (auth()->user()->level=="admin")
                      <li class="{{ (request()->is('/leave-type')) ? 'active' : '' }}">
                        <a class="nav-link" href="/leave-type">Leave Type</a>
                      </li>
                      @endif


                      <li class="{{ (request()->is('/leave-request')) ? 'active' : '' }}">
                        <a class="nav-link" href="/leave-request">Leave Request</a>
                      </li>
                      <li class="{{ (request()->is('/holiday-dates')) ? 'active' : '' }}">
                        <a class="nav-link" href="/holiday-dates">Holiday Dates</a>
                      </li>
                    </ul>
                    </li>
              </div>
            </div>
          </aside>
        </div>