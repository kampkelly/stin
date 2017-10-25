@if (Auth::check())
<input type="text" name="myid" value="{{Auth::user()->id}}" id="myid" hidden="true" />
<input type="text" name="myusername" value="{{Auth::user()->username}}" id="myusername" hidden="true" />
    <div id="reqtop"></div>
    <div id="req"></div>
    <div id="reqbottom"></div>
    <div id="notifynewconnection"></div>
    @if(count( Auth::user()->getFriendRequests() ) >= 1)
    <div style="position: fixed; bottom: 0%; right: 3%; z-index: 99" id="reques_modal">
    <div class="alert aler-info col-xs-12 col-sm-4 col-md-4 col-lg-4 col-sm-offset-1 small" role="alert" style="width: 100%; background-color: #FFFFFF; z-index: 17">
    <span>Connection Request(s):</span>
        @foreach(Auth::user()->getFriendRequests() as $k)
        <?php $users =  DB::select("SELECT * FROM users"); ?>
            <ul class="list-unstyled"> 
            @foreach($users as $us)
                @if($us->id == $k->sender_id)
                    <li><a href="/innovator/profile/{{$us->username}}" style="color: #003B7D;">{{$us->fullname}}</a> <a href="/accept_request/{{$us->username}}" class="btn btn-info btn-xs">Accept Request</a> <a href="/reject_request/{{$us->username}}" class="btn btn-warning btn-xs">Reject Request</a></li>
                @endif
            @endforeach
            </ul>
        @endforeach
     </div>
     </div>
    @endif
@endif