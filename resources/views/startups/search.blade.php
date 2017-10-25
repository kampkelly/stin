@extends('layouts.master')

@section('content')
<div class="container">
</div>
<!--STARTUPS ROW BEGINS-->
<div class="container">
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-10 col-lg-10">
    <!--LOOP STARTUP STARTS-->
    <!--LOOP STARTS-->
        @if(isset($details))
            <h4 style="color: #1fad50;"> Startups matching "{{ $query }}" </b> are :</h4>
            <div id="other_pos"> 
              @foreach($details as $startup)
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 one">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                 <div class="panel panel-default">
                                    <div class="panel-heading">
                                          <!--  <h3 class="panel-title text-center">Image</h3> -->
                                            <img src="{{ asset('uploads/'.$startup->image) }}" width="100%" class="img-responsive">
                                    </div>
                                    <div class="panel-body">
                                        <p class="small">Innovator:<a href="/innovator/profile/{{$startup->user->username}}">{{$startup->user->firstname}}</a><br>
                                        Website:<a href="/{{$startup->user->website}}" target="blank"> {{$startup->user->website}}</a><br>
                                        Category: <a href="/category/{{$startup->category->id}}">{{ $startup->category->name }}</a><br>
                                        <a href="/innovator/profile/{{$startup->user->username}}">View Profile</a></p>
                                    </div>
                                    <div class="panel-footer">
                                    <div class="rw-ui-container" data-title="{{$startup->id}}"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                                <h3 class="text-ceter"><a href="/startup/{{$startup->id}}">{{ str_limit($startup->title, 40) }}</a><span class="small"> by {{$startup->group_name}}</span><span class="small pull-right">{{$startup->created_at->diffForHumans()}}</span></h3>
                                <hr>
                                <p class="text-center text-justify">Brief description: {{ strip_tags($startup->short_desc) }}<br>
                                <h4>Notable Achievements:</h4>
                                <ul class="">
                                    <?php  $mark=explode(',', $startup->achievements);
                                       foreach($mark as $achievement) {
                                          echo '<li>'.$achievement.'</li>';
                                       }   ?>  
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div> 
                </div>
               @endforeach 
            </div>
            <div class="col-sm-12"> 
                {{ $details->links() }}
            </div>
        @endif
        @if(isset($det))
                <h4> Innovators matching "{{ $query }}" </b> are :</h4>
                @foreach($det as $user)
                @if($user->is_permission == 0)
                        <div class="list-group col-sm-11 col-sm-offset-1">
                            <a href="/innovator/profile/{{$user->username}}" class="list-group-item ">
                                <h4 class="list-group-item-heading">{{$user->lastname}} {{$user->firstname}}</h4>
                                <p class="list-group-item-text">{{$user->bio}}</p>
                            </a>
                        </div>
                @endif
                @endforeach
                <h4> Investors matching "{{ $query }}" </b> are :</h4>
                @foreach($det as $user)
                @if($user->is_permission == 1)
                     <div class="list-group col-sm-11 col-sm-offset-1">
                        <a href="#" class="list-group-item ">
                            <h4 class="list-group-item-heading">{{$user->company_name}}</h4>
                            <p class="list-group-item-text">{{$user->bio}}</p>
                        </a>
                    </div>
                @endif
                @endforeach
        @endif
        @if(isset($message))
            <h2> Your search for "{{ $query }}" </b> returned :</h2>
            <h4>{{$message}}</h4>
        @endif
    <!--LOOP ENDS-->
        <!--LOOP STARTUP ENDS-->
        <div class="text-center"> 
            <!--PAGINATION LINKS-->
            @if (Auth::user()->subscribed('main'))
            @else
            @endif
             <a href="/plans" style="color: orange;">Upgrade</a> to click to see more startups in this category
            <!--PAGINATION LINKS-->
        </div>
    </div>
    @include('/partials/sidebar')
</div>
</div>
<!--STARTUPS ROW ENDS-->
<div style="height: 500px;"></div>
@endsection
