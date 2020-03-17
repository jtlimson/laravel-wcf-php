<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - {{ strtoupper( basename(Request::path())  ) }} </title>
    <!-- Custom script Scripts   -->
    <script  type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script  type="text/javascript" src="{{ asset('js/jquery-2.2.4.min.js') }}" ></script>      
    <script  type="text/javascript" src="{{ asset('js/global.js') }}" ></script>   
    <script  type="text/javascript" src="{{ asset('js/custom.js') }}" ></script>   
    

    <!-- Custom Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">       
    <!-- datatables assets  -->      
    <!-- Fonts  -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >       
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito" type="text/css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>    
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if( !empty(session('Role') )  )
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">                 
                        <a class="nav-link {{ !request()->is('marketing/*') && !request()->is('tracker/*')  &&  !request()->is('daily/*')  ? 'active' : '' }} " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false" href=" {{ url('/')}}" >{{ __('Home') }} </a>
                    </li>
                    @if(  in_array ('admin', session('Role') )   ||  in_array ('marketing', session('Role') )  )   
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('marketing/*') ? 'active' : '' }} " id="profile-tab" data-toggle="tab" href="#marketing" role="tab" aria-controls="profile" aria-selected="false">{{ __('Marketing') }}</a>
                    </li>
                    @endif
                    @if(  in_array ('admin', session('Role') )   ||  in_array ('tracker', session('Role') )  )                           
                    <li class="nav-item">
                        <a class="nav-link  {{ request()->is('tracker/*') ? 'active' : '' }} " id="contact-tab" data-toggle="tab" href="#transaction" role="tab" aria-controls="contact" aria-selected="false">{{ __('Bounced Tracker') }}</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('daily/*') ? 'active' : '' }} " id="sent-tab" data-toggle="tab" href="#sent" role="tab" aria-controls="sent" aria-selected="false">{{ __('Daily Emails') }}</a>
                    </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent-tab">    
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                            <a class="nav-link {{ request()->is('daily/sent/list') ? 'active' : '' }} " href="{{ route('t.a.sent') }}">Sent List</a>
                            </li>   
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">    
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>                               
                    </div>
                    <div class="tab-pane fade" id="marketing" role="tabpanel" aria-labelledby="profile-tab">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  {{ request()->is('marketing/sbc*') ? 'active' : '' }} " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Send Blast') }} 
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">                            
                                <a class="dropdown-item" href="{{ route('sbc.list') }}">{{ __('Send') }}</a>
                            <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('t.jobs') }}">Queued Jobs</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  {{ request()->is('marketing/tp*') ? 'active' : '' }} " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('Template') }} 
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">                            
                                <a class="dropdown-item" href="{{ route('tp.index') }}">{{ __('Create') }}</a>
                            <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('tp.show') }}">List</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  {{ request()->is('marketing/b*') ? 'active' : request()->is('m/import') ? 'active' : ''  }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('Recipient') }} 
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">                            
                            <a class="dropdown-item" href="{{ route('b.index') }}">{{ __('Create') }} Batch</a>
                            <a class="dropdown-item" href="{{ route('import') }}">Import Recipient - CSV</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('b.show') }}">List</a>                           
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  {{ request()->is('marketing/u*') ? 'active' : request()->is('import') ? 'active' : ''  }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('Unsubscribers') }} 
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">                            
                            <a class="dropdown-item" href="{{ route('u.show') }}">List</a>
                            <a class="dropdown-item" href="{{ route('u.bounced') }}">   {{ __('Bounced Email') }}  </a>                                       
                            </div>
                        </li>
                    </ul>
                    </div>
                    <div class="tab-pane fade" id="transaction" role="tabpanel" aria-labelledby="contact-tab">
                    <ul class="navbar-nav mr-auto">                      
                        <li class="nav-item">                        
                           <a class="nav-link {{ request()->is('tracker/u/show') ? 'active' : '' }} " href="{{ route('t.m.bounced') }}">Blast</a>
                        </li>
                        <!-- 
                        <li class="nav-item">                          
                           <a class="nav-link {{ request()->is('tracker/u/bounced') ? 'active' : '' }} " href="{{ route('t.a.bounced') }}">All Bounced Email</a>       
                        </li>                       
                        TODO:                         
                        -->                        
                        <?php                                                 
                        foreach(\Helpers::dynamicMenu() as $menu) {
                        ?>
                        <li class="nav-item">                          
                           <a class="nav-link {{ request()->is('tracker/u/bounced') ? 'active' : '' }} " href="{{ route('t.a.bounced', ['filter'=>$menu->server_from ]) }}">{{ $menu->server_from }}</a>       
                        </li>
                        <?php } ?>
                    </ul>                    
                    </div>
                    </div>                  
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto pull-right">
                       @if(!session('IsAuthenticated'))
                        <li class="nav-item">
                            <a class="nav-link" href="">{{ __('Login') }}</a>
                        </li>
                        @else             
                        <!--
                        <li class="nav-item">
                            <a class="nav-link" href="">{{ __('Register') }}</a>
                        </li>
                        -->      
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('Welcome') }}  {{ session('DisplayName') }}
                            </a>                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">      
                            @if(!empty( session('Role') )) 
                                @if(  in_array('admin', session('Role') ) )                
                                    <a class="dropdown-item" href="{{ route('admin.index.accessrole') }}">
                                        {{ __('Access Role') }}
                                    </a>       
                                    <a class="dropdown-item" href="{{ route('admin.index.category') }}">
                                        {{ __('Category') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.index.map') }}">
                                        {{ __('Map Server') }}
                                    </a>      
                                    <a class="dropdown-item" href="{{ url('/readme.md') }} ">
                                        {{ __('READ ME') }}
                                    </a>            
                                @endif
                            @endif
                                <a class="dropdown-item" href=""
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form method="GET" id="logout-form" action="{{ route('logout') }}">
                                    @csrf    
                                </form>
                            </div>
                        </li>          
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">      
            @yield('content')
        </main>
    </div>
</body>
<footer class="footer-copyright text-center py-3">
   Metrobank Japan 
</footer>
</html>
@yield('script')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remitter Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div id="xr">  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>     
      </div>
    </div>
  </div>
</div>

<script  type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

<script>
 
 $(function () {  $('#myTab .active').tab('show')  });

</script>