<div class="navbar navbar-default navbar-fixed-top deskheader newbk" style="backgrund-color: #1AAF5D !important;">  <!--desktop header-->
  <div class="container-fluid">
    <a class="navbar-brand hide-mini-laptop" href="/dashboard#/">Theinnovestors</a>
    <a class="navbar-brand hide-desktop" href="/" style=" margin-top: -8px;"><span style="font-size: 200%; color: white;" class="icon-innovestors text-center"></span></a>
    <ul class="nav navbar-nav" style="width: 80%;">
    <!--router links-->
      <router-link tag="li" to="/innovations" exact>
        <a>Innovations</a>
      </router-link>
      @if(checkPermission(['innovator', 'admin']))
          <router-link tag="li" to="/{{Auth::user()->username}}/connections">
            <a>Connections</a>
          </router-link>
          <router-link tag="li" to="/my-feeds/{{Auth::user()->username}}">
            <a>Feeds</a>
          </router-link>
      @endif
      <router-link tag="li" to="/posts">
        <a>News</a>
      </router-link>
      @if(checkPermission(['innovator', 'admin']))
          <router-link tag="li" to="/{{Auth::user()->username}}/threads">
            <a>Threads</a>
          </router-link> 
      @endif
      <router-link tag="li" to="/search">
        <a><span class="glyphicon glyphicon-search" style="color: white; font-size: 120%;"></span></a>
      </router-link>
      <router-link tag="li" to="{{ route('logout') }}">
        <a href="{{ route('logout') }}"  
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Signout
            </a>
        </router-link>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
    </ul>
  </div>
</div>

<!--NEW HEADER  For logged in mobile
<a href="#" data-icon="gear" class="ui-btn-right">MENU</a> -->
@if (Auth::check()) 
  <div class="row new-head newbk">
      <div class="col-xs-2">
        <router-link tag="a" to="/" class="btn btn-default btn-sm" exact>
          <span style="font-size: 260%;" class="icon-innovestors text-center"></span>
        </router-link>
      </div>
      <div class="col-xs-2">
      @if(checkPermission(['innovator', 'admin']))
        <router-link tag="a" to="/innovations" class="btn btn-default btn-sm">
        <span class="glyphicon glyphicon-list"></span><div style="height: 5px;"></div> <span class="smallest-font pull-eft">Innovations</span>
      </router-link>
        @else
           <router-link tag="a" to="/innovations" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-list"></span><div style="height: 5px;"></div> <span class="smallest-font pull-eft">Innovations</span>
        </router-link>
        @endif
      </div>
      <div class="col-xs-2">
       <router-link tag="a" to="/{{Auth::user()->username}}/connections" class="btn btn-default btn-sm">
        <span class="glyphicon glyphicon-stats"></span><div style="height: 5px;"></div> <span class="smallest-font pull-lft">Connections
            @if( count(Auth::user()->getFriendRequests()) >+ 1)
            ({{ count(Auth::user()->getFriendRequests()) }})
            @endif
          </span>
      </router-link>
      </div>
      <div class="col-xs-2">
         <router-link tag="a" to="/{{Auth::user()->username}}/threads" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-list"></span><div style="height: 5px;"></div> <span class="smallest-font pull-eft">Messages</span>
        </router-link>  
      </div>
      <div class="col-xs-2">
         <router-link tag="a" to="/my-feeds/{{Auth::user()->username}}" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-tasks"></span><div style="height: 5px;"></div> <span class="smallest-font pull-lft" >My Feeds</span>
        </router-link>
      </div>
      <!--list items link-->
      <div class="col-xs-2">
         <router-link tag="a" to="/listitems" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-menu-hamburger"></span>
        </router-link>
      </div>
      <!--list items link-->
  </div>
@endif

