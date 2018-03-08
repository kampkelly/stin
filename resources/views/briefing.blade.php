@extends('layouts.new_master')

@section('content')
	<div style="height: 60px;"></div>
	<h2 class="text-center" style="text-decoration: underline;">Recent Innovations</h2>
   &nbsp; &nbsp; <input type="radio" name="featured" value="all" v-model="featured" id="featuredall"> <label for="featuredall" style="cursor:pointer;">All</label> &nbsp; &nbsp;
    <input type="radio" name="featured" value="1" v-model="featured" id="featured1"> <label for="featured1" style="cursor:pointer;">Featured</label> &nbsp; &nbsp;
    <input type="radio" name="featured" value="0" v-model="featured" id="featured0"> <label for="featured0" style="cursor:pointer;">Pitched</label> &nbsp; &nbsp; 
@if( count($innovations) <= 1)
    <h4 class="text-center">No innovations yet</h4>
    <div style="height: 80vh;"></div>
@endif
	@foreach($innovations as $innovation)
    <div v-if="featured == 'all'">
        @if($innovation->featured == 'yes')
              <div class="row container" style="margin-bottom: 20px;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row pan pan-success">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="text-ceter">
                                  <a href="/dashboard#/innovation/{{$innovation->slug}}">{{ $innovation->title }}</a>
                                <span class="small"> by TheInnovestors </span>
                                    <br><span class="smallest-font">Uploaded by: TheInnovestors
                                    </span>
                                <span class="small pull-right"> <span style="color:#27AD60;">Featured</span> {{$innovation->created_at->diffForHumans()}}</span><br><span class="small pull-right"><div class="rw-ui-container" data-title="{{$innovation->id}}"></div></span></h4>
                                <div class="row cntainer-fluid">
                                    <a href="/dashboard#/innovation/{{$innovation->slug}}" class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
                                        <img src="/uploads/startup_photos/{{$innovation->image}}" width="100%" class="img-responsive">
                                    </a>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                         <p class="text-center text-justify lead"><span style="text-decoration: underline; colr: gray !important;"> Brief description:</span> {!! str_limit($innovation->short_desc, $limit = 240) !!} <br> 
                                          <a href="/dashboard#/innovation/{{$innovation->slug}}">More...</a>
                                         </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
        @endif
        @if($innovation->featured == 'no')
              <div class="row container" style="margin-bottom: 20px;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row pan pan-success">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="text-ceter">
                                  <a href="/dashboard#/innovation/{{$innovation->slug}}">{{ $innovation->title }}</a>
                                <span class="small"> by {{ $innovation->group_name }} </span>
                                    <br><span class="smallest-font">Uploaded by: 
                                    <a href="/dashboard#/innovator/profile/{{$innovation->user->username}}">{{$innovation->user->fullname}}</a>
                                    </span>
                                <span class="small pull-right">{{$innovation->created_at->diffForHumans()}}</span><br><span class="small pull-right"><div class="rw-ui-container" data-title="{{$innovation->id}}"></div></span></h4>
                                <div class="row cntainer-fluid">
                                    <a href="/dashboard#/innovation/{{$innovation->slug}}" class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
                                        <img src="/uploads/startup_photos/{{$innovation->image}}" width="100%" class="img-responsive">
                                    </a>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                         <p class="text-center text-justify lead"><span style="text-decoration: underline; colr: gray !important;"> Brief description:</span> {{ $innovation->short_desc }} <br>
                                          <a href="/dashboard#/innovation/{{$innovation->slug}}">More...</a>
                                         </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
        @endif
    </div>

     <div v-if="featured == 1">
        @if($innovation->featured == 'yes')
              <div class="row container" style="margin-bottom: 20px;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row pan pan-success">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="text-ceter">
                                  <a href="/dashboard#/innovation/{{$innovation->slug}}">{{ $innovation->title }}</a>
                                <span class="small"> by TheInnovestors </span>
                                    <br><span class="smallest-font">Uploaded by: TheInnovestors
                                    </span>
                                <span class="small pull-right"> <span style="color:#27AD60;">Featured</span> {{$innovation->created_at->diffForHumans()}}</span><br><span class="small pull-right"><div class="rw-ui-container" data-title="{{$innovation->id}}"></div></span></h4>
                                <div class="row cntainer-fluid">
                                    <a href="/dashboard#/innovation/{{$innovation->slug}}" class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
                                        <img src="/uploads/startup_photos/{{$innovation->image}}" width="100%" class="img-responsive">
                                    </a>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                         <p class="text-center text-justify lead"><span style="text-decoration: underline; colr: gray !important;"> Brief description:</span> {!! str_limit($innovation->short_desc, $limit = 150) !!} <br>
                                          <a href="/dashboard#/innovation/{{$innovation->slug}}">More...</a>
                                         </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
        @endif
    </div>

     <div v-if="featured == 0">
        @if($innovation->featured == 'no')
		      <div class="row container" style="margin-bottom: 20px;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row pan pan-success">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="text-ceter">
                                  <a href="/dashboard#/innovation/{{$innovation->slug}}">{{ $innovation->title }}</a>
                                <span class="small"> by {{ $innovation->group_name }} </span>
                                    <br><span class="smallest-font">Uploaded by: 
                                    <a href="/dashboard#/innovator/profile/{{$innovation->user->username}}">{{$innovation->user->fullname}}</a>
                                    </span>
                                <span class="small pull-right">{{$innovation->created_at->diffForHumans()}}</span><br><span class="small pull-right"><div class="rw-ui-container" data-title="{{$innovation->id}}"></div></span></h4>
                                <div class="row cntainer-fluid">
                                    <a href="/dashboard#/innovation/{{$innovation->slug}}" class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
                                        <img src="/uploads/startup_photos/{{$innovation->image}}" width="100%" class="img-responsive">
                                    </a>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                         <p class="text-center text-justify lead"><span style="text-decoration: underline; colr: gray !important;"> Brief description:</span> {{ $innovation->short_desc }} <br>
                                          <a href="/dashboard#/innovation/{{$innovation->slug}}">More...</a>
                                         </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
        @endif
    </div>

	@endforeach
@endsection
