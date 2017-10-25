<style type="text/css">
	
</style>

<div class="navbar navbar-default navbar-fixed-top deskheader">
  <div class="container-fluid">
    <a class="navbar-brand link" href="/">Theinnovestors</a>
    <ul class="nav navbar-nav" style="width: 80%;"> 
      <li class="active">
        <a href="/" class="link">Home</a>
      </li>
      @if (Auth::check()) 
      <li class="mobilehide">
        <a href="/dashboard#/innovations" class="link">Innovatons</a>
      </li>
        <li class="mobilehide">
          <a href="/dashboard#/innovation/create" class="link">Add Innovation</a>
        </li>
        <li class="mobilehide">
          <a href="/dashboard#/my-feeds/{{Auth::user()->username}}" class="link">My Feeds</a>
        </li>
        <li class="mobilehide">
          <a href="/dashboard#/{{Auth::user()->username}}/connections" class="link">My Connections</a>
        </li>
        @if(checkPermission(['innovator']))
        <li class="mobilehide">
          <a href="/dashboard#/innovator/profile/{{Auth::user()->username}}" class="link">My Profile</a>
        </li>
        @elseif(checkPermission(['investor']))
        <li class="mobilehide">
          <a href="/dashboard#/investor/profile/{{Auth::user()->username}}" class="link">My Profile</a>
        </li>
        @else

        @endif
        <li class="mobilehide">
          <a href="/contact" class="link">Contact Us</a>
        </li>
        <li>
            <a href="{{ route('logout') }}"  
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" class="link">
                Signout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
      @else
        <li class="mobilehide">
          <a href="/contact" class="link">Contact</a>
        </li>
        <li class="mobilehide">
          <a href="/about" class="link">About</a>
        </li>
        <li class="mobilehide pull-right">
          <a href="/innovator/register" class="link" style="font-size: 102%">Register</a>
        </li>
        <li class="mobilehide pull-right">
          <a href="/login" class="link" style="font-size: 102%">Login</a>
        </li>
      @endif
    </ul>
  </div>
</div>


@if ( Auth::guest() )
<div id='cssmenu' class="mobilehead" style="position: fixed; color: white; top: 0%; z-index: 2; width: 100%;">
<ul>
   <li><a href='/'>Home</a></li>
   <li><a href='/features'>Features</a></li>
   <li><a href='/terms'>Terms and Conditions</a></li>
   <li><a href='/about'>About</a></li>
    <li><a id="log" href="/login">Signin</a></li>
    <li><a id="reg" href="/innovator/register">Signup as Innovator</a></li>
    <li style="display: none;"><a id="reg" href="/innovator/register">Signup as Investor</a></li>
</ul>
</div>
@endif


<!--NEW HEADER 
<a href="#" data-icon="gear" class="ui-btn-right">MENU</a> -->
@if (Auth::check()) 
  <div class="row new-head">
      <div class="col-xs-2">
      <a href="/dashboard#" class="btn btn-default btn-sm">
        <span style="font-size: 260%;" class="icon-innovestors text-center"></span>
        </a>
      </div>
      <div class="col-xs-2">
        <a href="/dashboard#/innovations" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-list"></span><div style="height: 5px;"></div> <span class="smallest-font pull-eft">Innovations</span>
          </a>
      </div>
      <div class="col-xs-2">
      @if(checkPermission(['innovator', 'admin']))
        <a href="/dashboard#/innovator/profile/{{Auth::user()->username}}" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-user"></span><div style="height: 5px;"></div><span class="smallest-font pull-rght">My Profile</span>
          </a>
        @else
          <a href="/dashboard#/investor/profile/{{Auth::user()->username}}" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-user"></span><div style="height: 5px;"></div> <span class="smallest-font pull-rght">My Profile</span>
          </a>
        @endif
      </div>
      @if (Auth::check()) 
      <div class="col-xs-2">
      <a href="/dashboard#/{{Auth::user()->username}}/connections" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-stats"></span><div style="height: 5px;"></div> <span class="smallest-font pull-lft">Connections
            @if( count(Auth::user()->getFriendRequests()) >+ 1)
            ({{ count(Auth::user()->getFriendRequests()) }})
            @endif
          </span>
        </a>
      </div>
      @endif
      <div class="col-xs-2">
        <a href="/dashboard#/my-feeds/{{Auth::user()->username}}" class="btn btn-default btn-sm" id="feeeds">
            <span class="glyphicon glyphicon-tasks"></span><div style="height: 5px;"></div> <span class="smallest-font pull-lft" >My Feeds</span>
          </a>
      </div>
      <div class="col-xs-2">
        <a href="/dashboard#/listitems" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-menu-hamburger"></span>
          </a>
      </div>
  </div>
  @endif

<!--NEW HEADER -->