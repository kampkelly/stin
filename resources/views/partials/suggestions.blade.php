<style type="text/css">
    .suggest {
        width: 200px;
        overflow-x: hidden;
        padding-top: 10px;
    }
    #scrolly{
     //   width: 1000px;
        height: 190px;
        overflow: auto;
        overflow-y: hidden;
        margin: 0 auto;
        white-space: nowrap;
    }
    .suggest p {color: grey;}
</style>
 <hr>
<h4 class="text-center" style="color: grey;">Suggested Connections</43>
<div>
    <ul id="scrolly" class="list-unstyled list-inline">
    	@foreach($suggestions as $suggestion)
            @if(Auth::user()->isFriendWith($suggestion))

            @else
    		<li class="suggest panel">
	            <h4><a href="/innovator/profile/{{$suggestion->username}}">{{$suggestion->fullname}}</a></h4>
	          <!--  <img src="{{ asset('uploads/profile-pic/'.$suggestion->image) }}" class="img-responsive" width="100%" style="height: 100px;"> -->
                    @if($suggestion->image != Null)
                        <img src="{{ asset('uploads/profile-pic/'.$suggestion->image) }}" class="img-responsive img-thumbnail" style="height: 100px;" width="90%">
                    @else
                        @if($suggestion->gender == 'Male')
                            <img src="{{ asset('man.png') }}" class="img-responsive img-thumbnail" style="height: 100px;" width="90%">
                         @else
                            <img src="{{ asset('woman.jpg') }}" class="img-responsive img-thumbnail" style="height: 100px;" width="90%">
                         @endif
                    @endif
	            <p class="smallest-font text-justify" style="font-size: 70%;">{{ str_limit($suggestion->bio, 55) }}</p>
                    @if(Auth::user()->hasFriendRequestFrom($suggestion) || Auth::user()->hasSentFriendRequestTo($suggestion))
                    <a href="/{{Auth::user()->username}}/connections" class="smallest-font text-justify">Requested to connect</a>
                    @else
                <a class="btn btn-success btn-xs" href="/follow/{{$suggestion->username}}" style="text-transform: none; color: white !important;">Connect</a>
                    @endif
        	</li>
            @endif
    	@endforeach
    </ul>
    <hr>
</div>