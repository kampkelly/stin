@extends('layouts.new_master')

@section('content')

<div class="container docs">
	<div style="height:45px;"></div>
     <h4 class="text-center">My Team Requests! </h4><br><br>
     {{$grav_url}}
     <img src="{{$grav_url}}" class=""> 
     @if(count($requests) >= 1)
         @foreach($requests as $request)
        <div class="row" style="margin-bottom: 20px; background: #FAFAFA;">
            <h5>{{$request->type}} request</h5>
             <span class="pull-right">{{$request->created_at->diffForHumans()}}</span> <span class="pull-right">on {{$request->category}}; &nbsp;</span>
              <a style="color:#133c57 !important; text-decoration: none;" href="/request_team/{{$request->slug}}">{{$request->user->fullname}} working on "{{$request->title}}" needs <span style="color:green;"> {{count($request->requestmembers)}} innovators</span>  to join him in his idea:<br>
                . <span style="color: grey;">Description: {{str_limit($request->description, $limit = 80)}}</span> Read more... </a>
          </div>
         @endforeach
     @else
        <h4 class="text-center">No requests for a team from you yet!</h4>
     @endif
          
    <div style="height:200px;"></div>
</div>

@endsection
