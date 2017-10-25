<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 third-column third-row">
<div style="height: 60px;"></div>
    <form action="/search" method="POST" role="search" class="hide-all">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="q"
                placeholder="Search innovations, people"> <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search" style="height: 20px;"></span>
                </button>
            </span>
        </div>
    </form>
    <!-- FORM 2 -->
    <h6 style="text-decoration:underline; cursor:pointer; color:#139DFD;" class="search_tog small text-center hide-all">advanced search</h6>
  <!--  <form action="/advanced_search" method="POST" role="search" class="form-inline search_effect" style="display:none;">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="q"
                placeholder="Type startups/users"
            </span>
        </div>
        <div class="input-group">
            <label><span class="small">Created-least date(mm/dd/yyyy):</span></label>
            <input type="date" class="form-cntrol" value="2017-05-20" name="date">
        </div>
        <div class="form-group">
            <label class="text-muted"><small>Innovations</small></label>
            <input type="radio" class="form-control" value="startup" name="startup" checked="true">
            <label class="text-muted"><small>People</small></label>
            <input type="radio" class="form-control" value="user" name="startup">
        </div>
        <div class="">
            <input type="submit" value="search" class="btn btn-primary btn-xs btn-block">
        </div>
    </form>   -->
    <form action="/advanced_search" method="POST" role="search" class="form-inline search_effect" style="display:none;">
        {{ csrf_field() }}
        
        <div class="row">
            <div class="col-xs-5 col-sm-6 col-md-5 col-lg-4 col-md-offset-0 col-lg-offset-0 control-label">
                <div class="form-group">
                    <input type="text" class="form-control" name="q"
                    placeholder="Type startups/users">
                </div>
            </div>
            <div class="col-xs-5 col-sm-6 col-md-6 col-lg-4">
                <div class="form-group">          
                    <input type="date" class="form-cntrol" value="2017-05-20" name="date">
                </div>
            </div>
        </div>  
        <div class="form-group">
            <label class="text-muted"><small>Innovations</small></label>
            <input type="radio" class="form-control" value="startup" name="startup" checked="true">
            <label class="text-muted"><small>People</small></label>
            <input type="radio" class="form-control" value="user" name="startup">
        </div>
        <div class="">
            <input type="submit" value="search" class="btn btn-primary btn-xs btn-block">
        </div>
    </form>
    <!-- FORM 2 -->
    
        <h5 class="text-center" style="text-decoration: underline;">Latest Innovations</h5>
    @if(count($startsides) <= 0)
            <p class="small">There are no innovations yet. Be the first, <a href="/startup/new">Add one now</a></p>
    @else
        <div class="list-group">
            @foreach($startsides as $startside)
                  <router-link tag="a" to="/innovation/{{$startside->slug}}" class="list-group-item small">
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
    <h5 class="text-center">Categories</h5>
    <form action="/category" method="POST" role="form">  
            {{csrf_field()}}      
            <div class="form-group">
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option class="btn btn-block" value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-xs">Go There!</button>
        </form>
    
    

   @if(checkPermission(['innovator', 'admin']))
    <h5 style="text-decoration: underline;" class="text-center">Suggested Connections</h5>
       
    <section class="vuesuggestions">
     <p class="text-center sent-messag" style="color: #1AAF5D; position: absolute; top: 100px; left: 10%;" v-show="showrequestmessage">@{{sent}}</p>
    @foreach($user_for_friends as $user)
    @if(Auth::user()->isFriendWith($user))

    @else
        @if($user->is_permission == 0)
            <div class="row contaner-fluid panel panel-succes suggestions">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <img src="{{ asset('uploads/profile-pic/'.$user->image) }}" class="img-responsive img-rounded" style="height: 56px;">
                </div>  <!--/connect/{{$user->username}}  v-on:mouseover="aler('{{$user->username}}')" -->
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                     <router-link tag="a" to="/innovator/profile/{{$user->username}}" class="text-capitalize" style="font-size: 100%;">
                      <a>{{$user->fullname}}</a>
                    </router-link> 
                    <a class="btn btn-success btn-xs pull-right" href="#" style="text-transform: none; color: white !important; display: none;" v-on:click.stop.prevent="sendconnect($event, '/connect/{{$user->username}}')">Connect</a>
                    <router-link tag="a" to="/innovator/profile/{{$user->username}}" class="btn btn-succes newbk btn-xs pull-right" style="font-size: 100%;">
                        <a style="text-transform: none; color: white !important;">View profile</a>
                    </router-link> 
                    <br> <span class="small-font">{{$user->profession}}: {{ str_limit($user->bio, 25)}}</span>
                </div><br>
            </div>
        @else
            <div class="row contaner-fluid panel panel-succes suggestions">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    @if($user->image != Null)
                    <img src="{{ asset('cranes.jpg') }}" class="img-responsive img-rounded" style="height: 56px;">
                    @else
                        <img src="{{ asset('man.png') }}" class="img-responsive img-rounded" style="height: 56px;">
                    @endif
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <a href="/investor/profile/{{$user->username}}">{{$user->company_name}}</a> <a class="btn btn-succes newbk btn-xs pull-right" href="#" style="text-transform: none; color: white !important;">Connect</a><br> <span class="smallest-font">{{$user->profession}}: {{ str_limit($user->bio, 25)}}</span>
                </div><br>
            </div>
        @endif
    @endif
    @endforeach
    </section>
  <!--end permission-->
  <!--pinterest removed-->
    

<!--	<h5 class="text-center" style="text-decoration: underline;">Investors</h5>
    <div class="list-group">
        @foreach($investors as $investor)
            <div class="row contaner-fluid panel panel-succes suggestions">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    @if($user->image != Null)
                    <img src="{{ asset('cranes.jpg') }}" class="img-responsive img-rounded" style="height: 56px;">
                    @else
                        <img src="{{ asset('man.png') }}" class="img-responsive img-rounded" style="height: 56px;">
                    @endif
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <a href="/investor/profile/{{$investor->username}}">{{$investor->company_name}}</a> <a class="btn btn-success btn-xs pull-right" href="#" style="text-transform: none;">Connect</a><br> <span class="smallest-font">{{$investor->profession}}: {{ str_limit($investor->bio, 25)}}</span>
                </div><br>
            </div>
        @endforeach
        <div class="text-center"><a href="#" class="small">See all</a></div>
    </div> -->
@endif
    <h5 class="text-center">News Update</h5>
    @foreach($news as $new)
        <div class="pane panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <router-link tag="a" to="/post/{{$new->slug}}" class="small">
                    <a>{{$new->title}}</a>
                  </router-link>
                </h4>
            </div>
            <div class="panel-body">
               <p class="smallest-font" style="line-height: 20px;"> {{ str_limit(strip_tags($new->body), 50) }}
                <router-link tag="a" to="/post/{{$new->slug}}" class="btn btn-xs btn-primary small">
                    <a style="color: white;">Read More...</a>
                  </router-link>
                 </p>
            </div>
        </div>
    @endforeach
</div>
