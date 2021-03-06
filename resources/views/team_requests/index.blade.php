@extends('layouts.new_master')

@section('content')

<div style="background: #f2f2f2;">
<div class="container docs">
	<div style="height:45px;"></div>
     <h4 class="text-center" style="text-decoration: underline;">Team Requests </h4><br><br>
     @if(count($request_teams) >= 0)
         @foreach($request_teams as $request)
         <div class="row" style="margin-bottom: 20px; background: #f2f2f2;">
            <h5>{{$request->type}} request</h5>
             <span class="float-right">{{$request->created_at->diffForHumans()}}</span> <span class="pull-right">on {{$request->category}}; &nbsp;</span>
              <a style="color:#133c57 !important; text-decoration: none;" href="/request_team/{{$request->slug}}">{{$request->user->fullname}} needs <span style="color:green;"> {{count($request->requestmembers)}} innovators</span> to assist on "{{$request->title}}":<br>
                 <span class="d-none" style="color: grey;">Description: {{str_limit($request->description, $limit = 80)}}</span> Read more... </a>
              @if(Auth::check())
                @if($request->username == Auth::user()->username)
                    <span> <a href="#">By me</a> </span>
                @else
                    <span> <a href="/dashboard#/innovator/profile/{{$request->username}}">Connect</a> </span>
                @endif
              @else
                    
              @endif
          </div>
         @endforeach
     @endif
     @if(count($request_teams) < 1)
           <h4>There are no teamup requests at this time!<br> You may submit one <a href="/request_team">here</a></h4>
      @endif
    <div style="height:200px;"></div>
</div>
</div>
@endsection
