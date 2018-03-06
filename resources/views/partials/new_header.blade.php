@if(Auth::guest())
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top deskheader">
  <a class="navbar-brand link text-white d-none" href="#" id="show_desktop_sidebar" style="display: none;"><i class="fa fa-bars" aria-hidden="true"></i></a>
  <a class="navbar-brand link text-whte d-none" href="#" id="close_desktop_sidebar" style="display: none; color: #d7f4e2"><i class="fa fa-times" aria-hidden="true"></i></a>
  <a class="navbar-brand link text-success d-sm-none d-lg-block" href="/dashboard#/">Theinnovestors</a>
  <div class="container">
     <ul class="nav navbar-nav d-flex flex-row" style="width: 100%;"> 
           <li class="nav-item pr-sm-0 pr-lg-0 d-sm-block d-lg-none">
              <a href="/dashboard#/" class="link nav-link text-success" style="font-size: 120%">Theinnovestors</a>
            </li>
             <li class="nav-item pr-sm-2 pr-lg-0 d-sm-none d-lg-block">
              <a href="/dashboard#/" class="link nav-link text-success" style="font-size: 102%">Home</a>
            </li>
          @if (Auth::check()) 
      <li class="pr-sm-2 pr-lg-0 d-sm-none d-lg-block">
        <a href="/dashboard#/innovations" class="link nav-link text-white">Innovatons</a>
      </li>
        <li class="pr-sm-2 pr-lg-0 d-sm-none d-lg-block">
          <a href="/dashboard#/my-feeds/{{Auth::user()->username}}" class="link nav-link text-white">My Feeds</a>
        </li>
        <li class="pr-sm-2 pr-lg-0 d-sm-none d-lg-block">
          <a href="/dashboard#/{{Auth::user()->username}}/connections" class="link nav-link text-white">My Connections</a>
        </li>
        <li class="pr-sm-2 pr-lg-0 d-sm-none d-lg-block">
          <a href="/dashboard#/innovator/profile/{{Auth::user()->username}}" class="link nav-link text-white">My Profile</a>
        </li>
        <li class="ml-auto pr-sm-2 pr-lg-0 d-sm-none d-lg-block">
          <a href="/contact" class="link nav-link text-white">Contact Us</a>
        </li>
        <li class="ml-auto pr-sm-3 pr-lg-0 d-md-block d-lg-none">
          <a href="/dashboard#/" class="link nav-link text-white">Home</a>
        </li>
        <li class="pr-sm-3 pr-lg-0 d-md-block d-lg-none">
          <a href="/dashboard#/innovations" class="link nav-link text-white">Innovations</a>
        </li>
        <li class="pr-sm-3 pr-lg-0 d-md-block d-lg-none">
          <a href="/dashboard#/my-feeds/{{Auth::user()->username}}" class="link nav-link text-white">My Feeds</a>
        </li>
        <li class="pr-sm-3 pr-lg-0 d-md-block d-lg-none">
          <a href="/contact" class="link nav-link text-white">Contact</a>
        </li>
        <li class="">
            <a href="{{ route('logout') }}"  
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" class="link nav-link text-white">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
      @else
          <li class="nav-item">
              <a href="/team_requests" class="link nav-link text-success" style="font-size: 102%">Team Requests</a>
            </li>
            <li class="">
              <a href="/contact" class="link nav-link text-success" style="font-size: 102%">Contact</a>
            </li>
            <li class="">
              <a href="/about" class="link nav-link text-success" style="font-size: 102%">About</a>
            </li>
            <li class="float-right d-none">
              <a href="/innovator/register" class="link nav-link text-success" style="font-size: 102%">Register</a>
            </li>
            <li class="float-right">
              <a href="/login" class="link nav-link text-success" style="font-size: 102%">Login</a>
            </li>
        @endif
    </ul>
    
  </div>
</nav>
@endif

@if(Auth::check())
<nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top deskheader">
  <a class="navbar-brand link text-white d-none" href="#" id="show_desktop_sidebar" style="display: none;"><i class="fa fa-bars" aria-hidden="true"></i></a>
  <a class="navbar-brand link text-whte d-none" href="#" id="close_desktop_sidebar" style="display: none; color: #d7f4e2"><i class="fa fa-times" aria-hidden="true"></i></a>
  <a class="navbar-brand link text-white d-sm-none d-lg-block" href="/dashboard#/">Theinnovestors</a>
  <div class="container">
     <ul class="nav navbar-nav d-flex flex-row" style="width: 100%;"> 
           <li class="nav-item pr-sm-0 pr-lg-0 d-sm-block d-lg-none">
              <a href="/dashboard#/" class="link nav-link text-white" style="font-sze: 120%">Theinnovestors</a>
            </li>
             <li class="nav-item pr-sm-2 pr-lg-0 d-sm-none d-lg-block">
              <a href="/dashboard#/" class="link nav-link text-white" style="font-sie: 102%">Home</a>
            </li>
          @if (Auth::check()) 
      <li class="pr-sm-2 pr-lg-0 d-sm-none d-lg-block">
        <a href="/dashboard#/innovations" class="link nav-link text-white">Innovatons</a>
      </li>
        <li class="pr-sm-2 pr-lg-0 d-sm-none d-lg-block">
          <a href="/dashboard#/my-feeds/{{Auth::user()->username}}" class="link nav-link text-white">My Feeds</a>
        </li>
        <li class="pr-sm-2 pr-lg-0 d-sm-none d-lg-block">
          <a href="/dashboard#/{{Auth::user()->username}}/connections" class="link nav-link text-white">My Connections</a>
        </li>
        <li class="pr-sm-2 pr-lg-0 d-sm-none d-lg-block">
          <a href="/dashboard#/innovator/profile/{{Auth::user()->username}}" class="link nav-link text-white">My Profile</a>
        </li>
        <li class="ml-auto pr-sm-2 pr-lg-0 d-sm-none d-lg-block">
          <a href="/contact" class="link nav-link text-white">Contact Us</a>
        </li>
        <li class="ml-auto pr-sm-3 pr-lg-0 d-md-block d-lg-none">
          <a href="/dashboard#/" class="link nav-link text-white">Home</a>
        </li>
        <li class="pr-sm-3 pr-lg-0 d-md-block d-lg-none">
          <a href="/dashboard#/innovations" class="link nav-link text-white">Innovations</a>
        </li>
        <li class="pr-sm-3 pr-lg-0 d-md-block d-lg-none">
          <a href="/dashboard#/my-feeds/{{Auth::user()->username}}" class="link nav-link text-white">My Feeds</a>
        </li>
        <li class="pr-sm-3 pr-lg-0 d-md-block d-lg-none">
          <a href="/contact" class="link nav-link text-white">Contact</a>
        </li>
        <li class="">
            <a href="{{ route('logout') }}"  
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" class="link nav-link text-white">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
      @else
          <li class="nav-item">
              <a href="/team_requests" class="link nav-link text-success" style="font-size: 102%">Team Requests</a>
            </li>
            <li class="">
              <a href="/contact" class="link nav-link text-success" style="font-size: 102%">Contact</a>
            </li>
            <li class="">
              <a href="/about" class="link nav-link text-success" style="font-size: 102%">About</a>
            </li>
            <li class="float-right">
              <a href="/innovator/register" class="link nav-link text-success" style="font-size: 102%">Register</a>
            </li>
            <li class="float-right">
              <a href="/login" class="link nav-link text-success" style="font-size: 102%">Login</a>
            </li>
        @endif
    </ul>
    
  </div>
</nav>
@endif

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top deskheader old d-none" style="margin-bottom: 200px; border-bottom: 1px solid #FAFAFA;">
  <a class="navbar-brand link text-success" href="/">Theinnovestors</a>
  <div class="container">
     <ul class="nav navbar-nav d-flex flex-row" style="width: 80%;"> 
           <li class="nav-item">
              <a href="/" class="link nav-link text-success" style="font-size: 102%">Home</a>
            </li>
          @if (Auth::check()) 
      <li class="">
        <a href="/dashboard#/innovations" class="link nav-link text-success">Innovatons</a>
      </li>
        <li class="">
          <a href="/dashboard#/innovation/create" class="link nav-link text-success">Add Innovation</a>
        </li>
        <li class="">
          <a href="/dashboard#/my-feeds/{{Auth::user()->username}}" class="link nav-link text-success">My Feeds</a>
        </li>
        <li class="">
          <a href="/dashboard#/{{Auth::user()->username}}/connections" class="link nav-link text-white">My Connections</a>
        </li>
        <li class="">
          <a href="/dashboard#/innovator/profile/{{Auth::user()->username}}" class="link nav-link text-white">My Profile</a>
        </li>
        <li class="">
          <a href="/contact" class="link nav-link text-white">Contact Us</a>
        </li>
        <li>
            <a href="{{ route('logout') }}"  
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" class="link nav-link">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
      @else
          <li class="nav-item">
              <a href="/team_requests" class="link nav-link text-success" style="font-size: 102%">Team Requests</a>
            </li>
            <li class="">
              <a href="/contact" class="link nav-link text-success" style="font-size: 102%">Contact</a>
            </li>
            <li class="">
              <a href="/about" class="link nav-link text-success" style="font-size: 102%">About</a>
            </li>
            <li class="float-right d-none">
              <a href="/innovator/register" class="link nav-link text-success" style="font-size: 102%">Register</a>
            </li>
            <li class="float-right d-none">
              <a href="/login" class="link nav-link text-success" style="font-size: 102%">Login</a>
            </li>
        @endif
    </ul>
    
  </div>
</nav>


@if ( Auth::guest() )
<div id='cssmenu' class="mobilehead" style="position: fixed; color: white; top: 0%; z-index: 2; width: 100%;">
<ul>
   <li><a href='/'>Home</a></li>
   <li><a href="/request_team">Find Team Members</a></li>
    <li><a href="/team_requests">Team Requests</a></li>
   <li><a href='/terms'>Terms and Conditions</a></li>
   <li><a href='/about'>About</a></li>
   <li><a href='/contact'>Contact</a></li>
    <li><a id="log" href="/login">Login</a></li>
    <li><a id="reg" href="/innovator/register">Register</a></li>
    <li style="display: none;"><a id="reg" href="/innovator/register">Signup as Investor</a></li>
</ul>
</div>
@endif


<!--NEW HEADER 
<a href="#" data-icon="gear" class="ui-btn-right">MENU</a> -->
@if (Auth::check()) 
  <div class="row new-head fixed-top newbk d-md-none text-center pl-3" style="width: 104%;">
      <div class="co-2">
          <a href="/" class="btn btn-success btn-sm">
            <span style="font-size: 150%;" class="icon-innovestors text-center"></span>
          </a>
      </div>
      
      @if(checkPermission(['innovator']))
          <div class="co-2">
              <a href="/dashboard#/innovations" class="btn btn-success btn-sm">
                <i class="fa fa-list-alt" aria-hidden="true"></i>
              </a>
          </div>
          <div class="co-2">
              <a href="/dashboard#/innovation/create" class="btn btn-success btn-sm">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </a>
          </div>
          <div class="co-2">
            <a href="/dashboard#/{{Auth::user()->username}}/connections" class="btn btn-success btn-sm">
            <i class="fa fa-users" aria-hidden="true"></i></span> <span class="smallest-font">
                @if( count(Auth::user()->getFriendRequests()) >= 1)
                ({{ count(Auth::user()->getFriendRequests()) }})
                @endif
              </span>
            </a>
          </div>
          <div class="co-2">
            <a href="/dashboard#/innovator/profile/{{Auth::user()->username}}" class="btn btn-success btn-sm">
              <i class="fa fa-user" aria-hidden="true"></i></span>
            </a>
          </div>
          <div class="co-2">
              <a href="/dashboard#/my-feeds/{{Auth::user()->username}}" class="btn btn-success btn-sm">
                <i class="fa fa-rss" aria-hidden="true"></i>
              </a>
          </div>
        @else
            <div class="col-xs-2">
               <router-link tag="a" to="/innovations" class="btn btn-default btn-sm">
              <span class="glyphicon glyphicon-list"></span><div style="height: 5px;"></div> <span class="smallest-font pull-eft">Innovations</span>
            </router-link>
            </div>
            <div class="col-xs-2">
               <router-link tag="a" to="/innovation/create" class="btn btn-default btn-sm">
              <span class="glyphicon glyphicon-list"></span><div style="height: 5px;"></div> <span class="smallest-font pull-eft">Pitch Innovat</span>
            </router-link>
            </div>
            <div class="col-xs-2">
               <router-link tag="a" to="/innovator/profile/edit/{{Auth::user()->username}}" class="btn btn-default btn-sm">
              <span class="glyphicon glyphicon-list"></span><div style="height: 5px;"></div> <span class="smallest-font pull-eft">Update Prof</span>
            </router-link>
            </div>
            <div class="col-xs-2">
               <router-link tag="a" to="/{{Auth::user()->username}}/innovations" class="btn btn-default btn-sm">
              <span class="glyphicon glyphicon-list"></span><div style="height: 5px;"></div> <span class="smallest-font pull-eft">My Innovations</span>
            </router-link>
            </div>
        @endif
      
      
      <!--list items link-->
      <div class="co-2">
          <a href="/dashboard#//listitems" class="btn btn-success btn-sm">
            <i class="fa fa-bars" aria-hidden="true"></i>
          </a>
      </div>
      <!--list items link-->
  </div>
@endif

