<style type="text/css">
	
</style>

<div class="land_header">	

	<nav class="navbar navbar-default navbar-fixed-top contaier" role="navigation">
		<div class="row container dsk-head" style="width: 100%; pading-left: 10em; pading-right: 10em;">
			<!-- Brand and toggle get grouped for better mobile display -->
      <ul>
        <li style="top: 4px !important; flex-grow: 2 !important;"><a href="/" id="branded" style="font-size: 190%; margin-right: 7px; color:  #E8D5BB !important;">Theinnovestors</a><span style="font-size: 250%;" class="icon-innovestors text-center"></span></li>
        @if (Auth::check())
          <li><a href="/startups">Innovations</a></li>
          <li><a href="/my-feeds/{{Auth::user()->username}}">My Feeds</a></li>
          <li><a href="/investor/profile/{{Auth::user()->username}}">My Profile</a></li>
          <li><a href="/{{Auth::user()->username}}/connections">Connections
          @if( count(Auth::user()->getFriendRequests()) >= 1)
            ({{ count(Auth::user()->getFriendRequests()) }})
          @endif
            </a></li>
        @endif
     <!--   <li style="font-size: 100%; bottom: 3px !important; backgrond-color: grey;" id="brand">TheInnovestors<span style="font-ize: 250%;" class="icon-innovestors"></span></li> 
        <li style="top: 4px !important;" id="banded"><span style="font-size: 250%;" class="icon-innovestors text-center"></span></li> -->
        <li>Features</li>
        <li>FAQS</li>
        <li>Contact</li>
        @if(Auth::check())
        <li>
            <a href="{{ route('logout') }}"  
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        @endif
      </ul>
			<!-- /.navbar-collapse -->
		</div>
	</nav>
	
</div>

   @if ( Auth::guest() )
<div id='cssmenu' class="mobilehead" style="position: fixed; color: white; top: 0%; z-index: 2; width: 100%;">
<ul>
   <li><a href='/'>Homme</a></li>
   @if (Auth::check()) 
   <li><a href='/dashboard'>Dashboard</a></li>
       @if(checkPermission(['innovator']))
       <li><a href='/startups'>Startups</a>
            <ul>
                <li><a href='/startup/new'>New Startup</a>
            </ul>
        </li>
        <li>
          <a class="nav-lnk" href="/my-feeds/{{Auth::user()->username}}">My Feeds</a>
        </li>
        <li>
          <a class="nav-lnk" href="/{{Auth::user()->username}}/connections">Watchers(
          {{ count(Auth::user()->getFriendRequests()) }})</a>
        </li>
         <li><a href='/innovator/profile/{{Auth::user()->username}}'>{{Auth::user()->firstname}}</a>
            <ul>
               <li><a href='/innovator/profile/{{Auth::user()->username}}'>My Profile</a></li>
               <li><a href='/innovator/profile/{{Auth::user()->id}}'>Friends</a></li>
            </ul>
         </li>
       @endif
   @endif
   <li><a href='/features'>Features</a></li>
   <li><a href='/terms'>Terms and Conditions</a></li>
   <li><a href='/privacy'>Privacy Policy</a></li>
   <li><a href='/about'>About</a></li>
   @if (Auth::check()) 
        @if (!Auth::user()->subscribed('main'))
            <li><a href="/plans" style="background-color: orange;">Upgrade</a></li>
        @else
            <li style="background-color: blue;"><a href='/subscriptions'>Subscriptions</a>
              <ul>
                 <li><a href='/subscriptions'>Manage Subscriptions</a>
                 </li>
                 <li><a href='/plans'>View Plans</a>
                 </li>
              </ul>
           </li>
        @endif
        <li>
            <a href="{{ route('logout') }}"  
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    @else
        <li><a id="log" href="/login">Signin</a></li>
        <li><a id="reg" href="#register">Signup</a></li>
    @endif
</ul>
</div>
@endif


<!--NEW HEADER 
<a href="#" data-icon="gear" class="ui-btn-right">MENU</a> -->
   @if (Auth::check()) 
  <div class="row new-head">
      <div class="col-xs-2">
      <a href="/startups" class="btn btn-default btn-sm">
       <!--   <span style="font-family: 'Orbitron', sans-serif;" class="smallest-font ic">tń..</span> -->
        <span style="font-size: 260%;" class="icon-innovestors text-center"></span>
        </a>
     <!--   <a href="/dashboard" class="btn btn-default btn-sm">
          <i><img style="height: 2.4em; width: 350%;" src="{{ asset('icon1.png') }}"></i>
        </a> -->
      </div>
      <div class="col-xs-2">
        <a href="/dashboard" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-list"></span><div style="height: 5px;"></div> <span class="smallest-font pull-eft">Categories</span>
          </a>
      </div>
      <div class="col-xs-2">
      @if(checkPermission(['innovator', 'admin']))
        <a href="/innovator/profile/{{Auth::user()->username}}" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-user"></span><div style="height: 5px;"></div><span class="smallest-font pull-rght">My Profile</span>
          </a>
        @else
          <a href="/investor/profile/{{Auth::user()->username}}" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-user"></span><div style="height: 5px;"></div> <span class="smallest-font pull-rght">My Profile</span>
          </a>
        @endif
      </div>
      @if (Auth::check()) 
      <div class="col-xs-2">
      <a href="/{{Auth::user()->username}}/connections" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-stats"></span><div style="height: 5px;"></div> <span class="smallest-font pull-lft">Watchers
            @if( count(Auth::user()->getFriendRequests()) >+ 1)
            ({{ count(Auth::user()->getFriendRequests()) }})
            @endif
          </span>
        </a>
      </div>
      @endif
      <div class="col-xs-2">
        <a href="/my-feeds/{{Auth::user()->username}}" class="btn btn-default btn-sm" id="feeeds">
            <span class="glyphicon glyphicon-tasks"></span><div style="height: 5px;"></div> <span class="smallest-font pull-lft" >My Feeds</span>
          </a>
      </div>
      <div class="col-xs-2">
    <!--  <button type="button" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-menu-hamburger" data-toggle="modal" data-target="#cart"></span>
        </button> -->
        <div id="o-wrapper" class="o-wrapper">      
            <button id="c-button--slide-right" class="c-button"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
        </div><!-- /o-wrapper -->
      </div>      
  </div>
<!--  <div style="height: 4em;"></div> -->

<nav id="c-menu--slide-right" class="c-menu c-menu--slide-right">
  <button class="c-menu__close">Close Menu &rarr;</button>
  <ul class="c-menu__items">
    <li class="c-menu__item"><a href="/dashboard" class="c-menu__link">Home</a></li>
    <li class="c-menu__item"><a href="#" class="c-menu__link">About</a></li>
    <li class="c-menu__item"><a href="#" class="c-menu__link">Services</a></li>
    <li class="c-menu__item"><a href="#" class="c-menu__link">Terms</a></li>
    <li class="c-menu__item"><a href="#" class="c-menu__link">Contact</a></li>
    <li class="c-menu__item"> <a class="c-menu__link" href="{{ route('logout') }}"  
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            </li>
  </ul>
</nav><!-- /c-menu slide-right -->
<div id="c-mask" class="c-mask"></div><!-- /c-mask -->

 <script src="{{ asset('js/slide.js') }}"></script>
  <script type="text/javascript">
 /* 
    $("#feeds").toggle(
        function(){$(".slide").css({"right": "0px", "transition": "3s"});},
        function(){$(".slide").css({"right": "-300px", "transition": "3s"});},
     //   function(){$(".slide").css({"right": "-300px"});},
       // function(){$("p").css({"color": "green"});
    }); 
    });*/
    /**
   * Slide right instantiation and action.
   */
  var slideRight = new Menu({
    wrapper: '#o-wrapper',
    type: 'slide-right',
    menuOpenerClass: '.c-button',
    maskId: '#c-mask'
  });

  var slideRightBtn = document.querySelector('#c-button--slide-right');
  
  slideRightBtn.addEventListener('click', function(e) {
    e.preventDefault;
    slideRight.open();
  });

  </script>
  @endif

<!--NEW HEADER -->