<div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 first-row" id="firstDiv">    
    <div class="container-fluid">
        <div class="pan panel-deful row">
            <div class="col-11 col-sm-11 col-md-11 col-lg-8 col-sm-offset-1 text-center">
                 <router-link tag="h5" to="/innovator/profile/{{Auth::user()->username}}" class="text-center" style="text-decoration: underline;"><a style="font-size: 100%; color: #17693a;">{{Auth::user()->fullname}}</a>
                   </router-link>
               @if(Auth::user()->address == '' || Auth::user()->state == '' || Auth::user()->country == '' || Auth::user()->contacts == '' || Auth::user()->bio == '' || Auth::user()->education == '')
                  <router-link tag="a" to="/innovator/profile/edit/{{Auth::user()->username}}" class="smal text-danger d-none" id="notify_update">
                      <p style="color: red !important;" class="m-0 mb-2">Please Update Profile</p>
                    </router-link>
              @endif
               <h6 class="m-0 mb-1 d-none">
                   <router-link tag="a" to="/innovator/profile/{{Auth::user()->username}}" class="text-center" style="text-decoration: underline;">My Profile
                   </router-link>
                </h6>
            </div>

            <div class="col-11 col-sm-11 col-md-11 col-lg-8 col-sm-offset-1">
                    <form action="/upload_profile_pic" method="post" enctype="multipart/form-data" id="formId" style="position: relative;">
                   {{ csrf_field() }}
                   @if(Auth::user()->image != 'default_profile.jpeg')
                      <img src="{{ asset('uploads/profile-pic/'.Auth::user()->image) }}" class="img-fluid rounded-circle" width="100%" style="height: 70px; posiion: absolute;">
                  @else
                      <img :src="'https://api.adorable.io/avatars/181/{{Auth::user()->email}}.png'" class="img-fluid rounded-circle" width="100%;" style="height: 70px; filter: grayscale(50%);">
                  @endif
                      <span class="glyphicon glyphicon-camera" style="color: white; position: absolute; font-size: 150%; top: 50%; left: 35%;"></span>
                      <input type="file" id="my_file" name="my_file" style="position: absolute; top: 0; font-size: 40%; opacity: 0.001; height: 70px;"/>
                    </form>
            </div>
            <div style="display: none;"> <!--this holds the entire website display in place above width 1199; MUST NOT BE DELETED OR CHANGED EXCEPT YOU KNOW WHAT YOU ARE DOING-->
            <p style="color: white;" id="k">mn</p><p style="color: white;" id="kk"></p><p style="color: white;" id="kkk"></p></div>
        </div>
    </div>
     <ul class="list-group" style="margin-top: 10px; overflow-y: scroll; max-height:370px; height:370px;">
     @if(checkPermission(['innovator']))   
        <router-link tag="a" to="/innovator/profile/edit/{{Auth::user()->username}}" class="list-group-item pb-1 pt-0">
            <small><a>Edit Profile</a></small>
          </router-link>
        <router-link tag="a" to="/innovation/create" class="list-group-item pb-1 pt-0">
        <small><a>Pitch an Innovation</a></small>
      </router-link>
      <router-link tag="a" to="/{{Auth::user()->username}}/innovations" class="list-group-item pb-1 pt-0">
          <small><a>My Innovations</a></small>
        </router-link> 
        <router-link tag="a" to="/{{Auth::user()->username}}/threads" class="list-group-item small pb-1 pt-1 d-none">
          <a>My Messages</a>
        </router-link>
        <router-link tag="a" to="/{{Auth::user()->username}}/connections" class="list-group-item small pb-1 pt-1">
          <a>{{Auth::user()->getFriendsCount()}} Connections</a>
        </router-link>
        @if( count(Auth::user()->getFriendRequests()) >= 1)
          <router-link tag="a" to="/{{Auth::user()->username}}/connections" class="list-group-item small pb-1 pt-0">
            <a>New requests <span class="badge">{{ count(Auth::user()->getFriendRequests()) }}</span></a>
          </router-link>
        @endif
        @foreach($friends as $us)
            <a href="/innovator/profile/{{$us->username}}" class="list-group-item small person" style="display: none;">{{$us->fullname}}</a>
        @endforeach
        {{$friends->links()}}
        <!--here-->
         <a href="/myrequests" class="list-group-item pb-1 pt-1 small d-none">
             My Team Requests
        </a>
         <a href="/team_requests" class="list-group-item small pb-1 pt-1 small d-none">
             Team Requests
        </a>
        <a href="/request_team" class="list-group-item pb-1 pt-1 small">
              Find Team Members
        </a>
        <router-link tag="a" to="/posts" class="list-group-item pb-1 pt-1 small">
          <a>TheInnovestors News</a>
        </router-link> 
        <a href="/contact" class="list-group-item pb-1 pt-1 small">
              Contact
        </a>
        <a href="/terms" class="list-group-item pb-1 pt-1 small">
              Terms of use
        </a>
        <a href="/terms" class="list-group-item pb-1 pt-1 small">
              Disclaimer
        </a>
        <a href="/about" class="list-group-item pb-1 pt-1 small">
              About
        </a>
        <router-link tag="a" to="{{ route('logout') }}" class="list-group-item pb-1 pt-1 small">
        <a href="{{ route('logout') }}"  
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" >
                Logout
            </a>
        </router-link>
        <a href="https://www.facebook.com/teaminnovestors/" class="list-group-item pb-1 pt-1 small" target="blank">
             <span style="color: #2980B8 !important;"> Like us on facebook</span>
        </a>
        <!--here-->
     @else
        <router-link tag="a" to="/innovation/create" class="list-group-item">
          <small><a>Pitch an Innovation</a></small>
        </router-link>
        <router-link tag="a" to="/{{Auth::user()->username}}/innovations" class="list-group-item">
            <small><a>My Innovations</a></small>
          </router-link> 
       <router-link tag="a" to="/innovator/profile/edit/{{Auth::user()->username}}" class="list-group-item small">
          <a>Update Profile</a>
       </router-link>
    @endif
    @if(checkPermission(['admin', 'superadmin']))
        <a href="/admin/all_innovations" class="list-group-item pb-1 pt-1 small d-none">
              Admin
        </a>
        <a href="/lte-admin" class="list-group-item pb-1 pt-1 small">
             LTE Admin
        </a>
        @endif
    </ul>


     
</div>

