@extends('layouts.new_master')

@section('content')

<div class="container docs">
	<div style="height:45px;"></div>
      <div class="row" style="margin-bottom: 20px; background: #FAFAFA;">
      	@if($request)
        <h4 class="text-center">{{$request->type}} request</h4>
         <span class="pull-right">{{$request->created_at->diffForHumans()}}</span> <span class="pull-right">on {{$request->category}}; &nbsp;</span>
          <p style="color:#133c57 !important; text-decoration: none;">{{$request->user->fullname}} working on "{{$request->title}}" needs the following positions to join him in his idea:<br><br>
            @foreach($request->requestmembers as $member)
              <ul>
                    <li>{{$member->role}} to do: {{$member->function}} </li>
              </ul>
            @endforeach
            . <span style="color: grey;">Additional information: {{str_limit($request->additional, $limit = 80)}}</span></p>
    </div>
	@if(Auth::check())
	    @if($request->user->username == Auth::user()->username)
	    <p>Status: {{$request->status}}</p>
	    <form action="/request_team/update/{{$request->slug}}" method="POST" class="form-horizontal" role="form" files="true" enctype="multipart/form-data">
            {{ csrf_field() }}
            <select name="status">
            	<option value="active">Activate</option>
            	<option value="deactivated">Deactivate</option>
            </select>
            <button type="submit" class="btn btn-primary btn-xs">
               Update this request
            </button>

        </form>
	   @else
	   	 <h4> <a href="/dashboard#/innovator/profile/{{$request->user->username}}" style="colr: #2980b8;" class="btn btn-primary btn-md">Connect for this position</a></h4>
	   @endif
   @else
   	 <h4> <a href="/dashboard#/innovator/profile/{{$request->user->username}}" style="colr: #2980b8;" class="btn btn-primary btn-md">Connect for this position</a></h4>
   @endif
    @endif
    <div style="height:200px;"></div>
</div>
@endsection
