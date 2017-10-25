<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 first-row" id="firstDiv">    
    <div class="container-fluid">
    <div style="height: 0px;"></div>
        <div class="pan panel-defult row">
          <h4 style="color: white;" class="text-center">{{Auth::user()->fullname}}</h4>
            @if(Auth::user()->address == '' || Auth::user()->state == '' || Auth::user()->country == '' || Auth::user()->contacts == '' || Auth::user()->bio == '' || Auth::user()->education == '')
                @if(checkPermission(['investor']))
                    <a href="/investor/profile/edit/{{Auth::user()->username}}" class="small text-danger" id="notify_update">Please Update Your Profile!</a>
                @else 
                <router-link tag="a" to="/innovator/profile/edit/{{Auth::user()->username}}" class="small text-danger" id="notify_update">
                    <a>Update Profile</a>
                  </router-link>
                @endif
            @endif
            <div class="text-center">
                <h4>
                   <router-link tag="a" to="/innovator/profile/{{Auth::user()->username}}" class="text-center" style="text-decoration: underline;">My Profile
                   </router-link>
                </h4>
            </div>
            <div class="col-sm-11 col-md-11 col-lg-8 col-sm-offset-1">
                 @if(Auth::user()->image != Null)
                    
                    <form action="/upload_profile_pic" method="post" enctype="multipart/form-data" id="formId" style="position: relative;">
                   <!--   <input type="image" src="{{ asset('uploads/profile-pic/'.Auth::user()->image) }}" class="img-responsive img-circle" width="100%" style="height: 70px; posiion: absolute;"/> -->
                   {{ csrf_field() }}
                      <img src="{{ asset('uploads/profile-pic/'.Auth::user()->image) }}" class="img-responsive img-circle" width="100%" style="height: 70px; posiion: absolute;">
                      <span class="glyphicon glyphicon-camera" style="color: white; position: absolute; font-size: 150%; top: 50%; left: 35%;"></span>
                      <input type="file" id="my_file" name="my_file" style="position: absolute; top: 0; font-size: 330%; opacity: 0.001;"/>
                    </form>
                 @else
                     @if(Auth::user()->gender == 'Male')
                        <img src="{{ asset('man.png') }}" class="img-responsive img-rounded" width="100%">
                     @else
                        <img src="{{ asset('woman.jpg') }}" class="img-responsive img-rounded" width="100%">
                     @endif
                 @endif
            @if( Auth::check() )
                <form action="/profile/image/{{Auth::user()->username}}" method="POST" value="PUT" class="form-horizontal" role="form" files="true" enctype="multipart/form-data" style="margin-top: 10px; display: none;">
                    {{ csrf_field() }}
                    <input style="font-size: 10px;" type="file" name="image">
                    <button type="submit" class="text-center btn btn-block btn-xs">Save Picture</button>
                </form>
            @endif
            </div>
            <div class="col-sm-11 col-md-11 col-lg-12">
                
            </div>
            <div style="display: none;"> <!--this holds the entire website display in place above width 1199; MUST NOT BE DELETED OR CHANGED EXCEPT YOU KNOW WHAT YOU ARE DOING-->
            <p style="color: white;" id="k">mn</p><p style="color: white;" id="kk"></p><p style="color: white;" id="kkk"></p></div>
        </div>
    </div>
     <ul class="list-group" style="margin-top: 10px;">
     @if(checkPermission(['innovator']))
        
        <router-link tag="a" to="/innovator/profile/edit/{{Auth::user()->username}}" class="list-group-item small">
            <a>Edit Profile</a>
          </router-link>
        <router-link tag="a" to="/innovation/create" class="list-group-item">
        <small><a>Pitch an Innovation</a></small>
      </router-link>
      <router-link tag="a" to="/{{Auth::user()->username}}/innovations" class="list-group-item">
          <small><a>My Innovations</a></small>
        </router-link> 
        <router-link tag="a" to="/{{Auth::user()->username}}/threads" class="list-group-item small">
          <a>My Messages</a>
        </router-link>
        <router-link tag="a" to="/{{Auth::user()->username}}/connections" class="list-group-item small">
          <a>{{Auth::user()->getFriendsCount()}} Connections</a>
        </router-link>
        @if( count(Auth::user()->getFriendRequests()) >= 1)
          <router-link tag="a" to="/{{Auth::user()->username}}/connections" class="list-group-item small">
            <a>New requests <span class="badge">{{ count(Auth::user()->getFriendRequests()) }}</span></a>
          </router-link>
        @endif
        @foreach($friends as $us)
            <a href="/innovator/profile/{{$us->username}}" class="list-group-item small person" style="display: none;">{{$us->fullname}}</a>
        @endforeach
        {{$friends->links()}}
     @else
     <router-link tag="a" to="/innovator/profile/edit/{{Auth::user()->username}}" class="list-group-item small">
        <a>Update Profile</a>
     </router-link>
    @endif
    </ul>
      <div class="list-group" style="margin-top: -20px;">
        <router-link tag="a" to="/posts" class="list-group-item active">
          <p class="list-group-item-text small">Posts</p>
        </router-link> 
        <a href="/contact" class="list-group-item active">
              <p class="list-group-item-text small">Contact</p>
        </a>
        <a href="/terms" class="list-group-item active">
              <p class="list-group-item-text small">Terms of use</p>
        </a>
        <a href="/terms" class="list-group-item active">
              <p class="list-group-item-text small">Disclaimer</p>
        </a>
        <a href="/about" class="list-group-item active">
              <p class="list-group-item-text small">About</p>
        </a>
        @if(checkPermission(['admin', 'superadmin']))
        <a href="/admin/all_innovations" class="list-group-item active">
              <p class="list-group-item-text small">Admin</p>
        </a>
        @endif
        <router-link tag="a" to="{{ route('logout') }}" class="list-group-item active">
        <p href="{{ route('logout') }}"  
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" class="list-group-item-text small">
                Signout
            </p>
        </router-link>
      </div>
</div>

