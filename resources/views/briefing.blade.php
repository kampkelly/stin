@extends('layouts.new_master')

@section('content')
	<div style="height: 60px;"></div>
	<h2 class="text-center" style="text-decoration: underline;">Recent Innovations</h2>
	@foreach($innovations as $innovation)
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
                                <span class="small pull-right">{{$innovation->created_at}}</span><br><span class="small pull-right"><div class="rw-ui-container" data-title="{{$innovation->id}}"></div></span></h4>
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
	@endforeach
@endsection
