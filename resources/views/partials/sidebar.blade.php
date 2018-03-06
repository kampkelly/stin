<div class="col-xs-2col-sm-12 col-md-4 col-lg-4 col-xl-3 third-column third-row pr-4">
<div style="height: 60px;"></div>

        <h6 class="text-center mt-3" style="text-decoration: underline;">Team Requests</h6>
         @if(count($request_teams) <= 0)
            <p class="small">No team requests yet.
                    <a href="/request_team">Find a Team Member</a>
         </p>
        @else
             @foreach($request_teams as $request)
                        <a href="/request_team/{{$request->slug}}" class="list-group-item small list-group-item-light d-none">{{$request->user->fullname}} working on "{{$request->title}}" needs <span style="color: #27AD60;">{{count($request->requestmembers)}} innovator(s)</span> {{ str_limit($request->description, 20) }}</a>
                        <a href="/request_team/{{$request->slug}}" class="list-group-item small list-group-item-light d-none">{{$request->user->fullname}} needs <span style="color: #27AD60;">{{count($request->requestmembers)}} innovator(s)</span> to assist on "{{$request->title}}" </a>
                @endforeach
        @endif

        <h6 class="text-center mt-3" style="text-decoration: underline;">Recent Innovations</h6>
    @if(count($startsides) <= 0)
            <p class="small">There are no innovations yet. Be the first,
                <router-link tag="a" to="/innovation/create">
                    <a>Add one now</a>
                  </router-link>
         </p>
    @else
        <div class="list-group">
            @foreach($startsides as $startside)
                  <router-link tag="a" to="/innovation/{{$startside->slug}}" class="list-group-item small list-group-item-light">
                    <a>{{ str_limit($startside->title, 23) }}</a>
                  </router-link>
            @endforeach
            <div class="text-center small">
             <router-link tag="a" to="/innovations" class="small">
                <a>See all</a>
              </router-link>
            </div>
        </div>
    @endif

    <h6 class="text-center mt-2">Categories</h6>
    <form action="/category" method="POST" role="form">  
            {{csrf_field()}}      
            <div class="form-group">
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option class="btn btn-block" value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-outline-info btn-block btn-sm">Go There!</button>
        </form>
    
    

   @if(checkPermission(['innovator']))
    <h6 style="text-decoration: underline;" class="text-center mt-3">Suggested Connections</h6>
       
    <section class="vuesuggestions">
     <p class="text-center sent-messag" style="color: #1AAF5D; position: absolute; top: 100px; left: 10%;" v-show="showrequestmessage">@{{sent}}</p>
    @foreach($user_for_friends as $user)
    @if(Auth::user()->isFriendWith($user))

    @else
        @if($user->is_permission == 0)
            <div class="row contaner-flui suggestons mt-2">
                <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                    <img src="{{ asset('uploads/profile-pic/'.$user->image) }}" class="img-fluid rounded" style="height: 56px;">
                </div>  <!--/connect/{{$user->username}}  v-on:mouseover="aler('{{$user->username}}')" -->
                <div class="col-9 col-sm-9">
                    <p>sksslks</p>
                </div>
                <div class="col-9 col-sm-9 col-md-9 col-lg-9 d-none">
                     <router-link tag="a" to="/innovator/profile/{{$user->username}}" class="text-capitalize" style="fot-size: 100%;">
                      <a>{{$user->fullname}}</a>
                    </router-link> 
                    <router-link tag="a" to="/innovator/profile/{{$user->username}}" class="btn btn-succes newbk btn-sm float-right">
                        <a style="text-transform: none; color: white !important;">View profile</a>
                    </router-link> 
                    <br> <span class="small-font">{{$user->profession}}: {{ str_limit($user->bio, 25)}} fk</span>
                </div>
            </div>            
        @endif
    @endif
    @endforeach
    </section>
  <!--end permission-->
    


@endif
    <h5 class="text-center mt-3" style="text-decoration: underline;">TheInnovestors News</h5>
    @foreach($news as $new)
        <div class="card pl-3 mt-1">
                <h4 class="card-tite">
                <router-link tag="a" to="/post/{{$new->slug}}" class="small">
                    <a>{{$new->title}}</a>
                  </router-link>
                </h4>
            <div class="">
               <p class="smallest-font" style="line-height: 20px;"> {{ str_limit(strip_tags($new->body), 50) }}
                <router-link tag="a" to="/post/{{$new->slug}}" class="btn btn-sm btn-secondary small">
                    <a style="color: white !important;">Read More...</a>
                  </router-link>
                 </p>
            </div>
        </div>
    @endforeach
</div>
