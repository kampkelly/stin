@extends('layouts.landing_master')

@section('content')
<div class="body-container">
<div class="row" style="position: relative;">
    @if(checkPermission(['admin']))
        @include('/partials/admin_left_sidebar')
    @else
        @include('/partials/left_sidebar')
    @endif
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
    <section class="middle-column background-primary">
        <div class="container-fluid">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center"><h4>Choose a plan</h4></div>
                        @if (Auth::user()->subscribed('main')) 
                            <h5 class="text-center">You already have a subscribption</h5>
                        @endif

                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach ($plans as $plan)
                                    <li class="list-group-item clearfix">
                                        <div class="pull-left">
                                        @if (Auth::user()->subscribedToPlan($plan->braintree_plan, 'main'))
                                        You are currently subscribed to the {{ $plan->name }} plan
                                        @endif
                                            <h4 class="btn btn-success btn-block">{{ $plan->name }}</h4>
                                            <h4>${{ number_format($plan->cost, 2) }} per month</h4>
                                            @if ($plan->description)
                                                <p>{{ $plan->description }}</p>
                                            @endif
                                        </div>
                                        @if (!Auth::user()->subscribedToPlan($plan->braintree_plan, 'main'))
                                        <a href="{{ url('/plan', $plan->slug) }}" class="btn btn-default pull-right">Choose Plan</a>
                                        @else
                                            <a href="{{ url('/subscriptions') }}" class="btn btn-primary btn-xs pull-right">Manage Subscription</a>
                                        @endif


                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>   
            </div>
            </section>
            <div style="height: 300px;"></div>
        </div>
        @include('/partials/sidebar')
    </div>
</div>
<!--STARTUPS ROW ENDS-->
<div style="height: 500px;"></div>
@endsection
