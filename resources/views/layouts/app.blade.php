<!doctype html>
<html lang="en">
 <head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- CoreUI CSS -->
 <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">
 <script src="https://use.fontawesome.com/45cfb6a801.js"></script>

 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <title>{{ config('app.name', 'Laravel') }}</title>
 <link rel="icon" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.2/svgs/solid/euro-sign.svg">

 </head>
 <body class="c-app">
    <!-- SIDE BAR -->
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand d-md-down-none">
        
        <h1>
        <i class="fa fa-euro c-sidebar-brand-minimized" ></i>
        <i class="fa fa-euro c-sidebar-brand-full" width="118" height="46">&nbsp; Invoices</i>
        </h1>
        
        
        </div>
        @guest

        @else
        <ul class="c-sidebar-nav ps ps--active-y">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('home')}}">
                <i class="c-sidebar-nav-icon fa fa-dashboard fa-lg"></i> Dashboard
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{url('/invoices')}}">
                <i class="c-sidebar-nav-icon fa fa-list fa-lg"></i>Invoices List
                </a>
            </li>

            
        
        </ul>

        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
        
        @endguest
        
    </div>
    
    <!-- END OF SIDE BAR -->
        


      <div class="c-wrapper">
          <!-- HEADER SECTION -->
          <header class="c-header c-header-light c-header-fixed c-header-with-subheader">

        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
            <i class="fa fa-angle-double-left fa-lg"></i>
</button><a class="c-header-brand d-lg-none" href="#">
<i class="fa fa-angle-double-left fa-lg"></i></a>
<button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
<i class="fa fa-angle-double-left fa-lg"></i>
</button>
            
        <div class="c-header-nav-item  lg">

        <ul class="c-header-nav d-md-down-none">
        <li class="c-header-nav-item px-3"></li>

        <a class="c-header-nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
         <i class="fa fa-cubes"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <div class="dropdown-header bg-light py-2"><strong>Finance</strong></div>
        <a class="dropdown-item" href="https://clients.drmorris-itservices.de/home" target="_blank"><i class="fa fa-globe" ></i> &nbsp; Clients</a>
          <a class="dropdown-item" href="https://quotes.drmorris-itservices.de/home" target="_blank"><i class="fa fa-money" ></i> &nbsp; Quotes</a>
          <div class="dropdown-divider"></div>
          <div class="dropdown-header bg-light py-2"><strong>Other Software</strong></div>
          <a class="dropdown-item" href="https://invoices.drmorris-itservices.de/home" target="_blank"><i class="fa fa-euro" ></i> &nbsp; Invoices</a>
          <a class="dropdown-item" href="#" target="_blank"><i class="fa fa-shopping-bag" ></i> &nbsp; Products</a>
          <a class="dropdown-item" href="#" target="_blank"><i class="fa fa-laptop" ></i> &nbsp; Assest Management</a>
          <a class="dropdown-item" href="#" target="_blank"><i class="fa fa-tasks"></i>&nbsp; Projects</a>
        </div>
      </div>
      </ul>
       
            <ul class="c-header-nav mfs-auto">
            
            
            </ul>
            <ul class="c-header-nav">
            
            
            

            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <div class="">
                
                {{AUTH::User()->name}}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
            
            <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
                <a class="dropdown-item" href="{{url('/profile')}} ">
                <i class="c-icon mfe-2 fa fa-user"></i>Profile
                </a>

                @can('isAdmin')
                <div class="dropdown-header bg-light py-2"><strong>System Administration</strong></div>
                    
                <a class="dropdown-item" href="{{url('/sysusers')}} ">
                <i class="c-icon mfe-2 fa fa-users"></i>System Users
                </a>
                @endcan
                
            
            
            <div class="dropdown-divider"></div>
            
                
                
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="c-icon mfe-2 fa fa-lock"></i>
                    {{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            </li>
            <button class="c-header-toggler c-class-toggler mfe-md-3" type="button" data-target="#aside" data-class="c-sidebar-show">
            
            </button>

           
            @endguest
            </ul>
            
            </header>
            <!-- END OF HEADER SECTION -->

        <div class="c-body">
            <main class="c-main">
              <!-- Main content here -->
              @yield('content')
            </main>
          </div>
          <footer class="c-footer">
            <!-- Footer content here -->
            <div class="row">
                <div class="col-12">
                &copy;2020 DRMorris IT Services - Powered by CoreUI
                </div>
                <div class="col-12">
                <small>V2.1 - MAR2021</small>
                </div>
            </div>
          </footer>
    </div>
    

 <!-- Optional JavaScript -->
 <!-- Popper.js first, then CoreUI JS -->
 <script src="https://unpkg.com/@popperjs/core@2"></script>
 <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
 </body>
</html>