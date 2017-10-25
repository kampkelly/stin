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
             <div class="row">
                <div class="col-md-8 col-md-offset-2">
                <br>
                    <div class="panel panel-default">
                        <div class="panel-heading text-center"><h4>Manage My Subscriptions</h4></div>

                        <div class="panel-body">
                            @if (Auth::user()->subscription('main')->cancelled())
                                <p>Your subscription will end on {{ Auth::user()->subscription('main')->ends_at->format('dS M Y') }}.</p>
                                <form action="{{ url('subscription/resume') }}" method="post">
                                    <button type="submit" class="btn btn-success">Resume subscription</button>
                                    {{ csrf_field() }}
                                </form>
                                <br>
                                <div class="panel-footer">
                                    <em class="small"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> On renewing your subscription, you will be re-subscribed to this plan but won't be billed until your currrent plan expires</em>
                                </div>
                            @else
                                <p>You are currently subscribed to the {{ Auth::user()->subscription('main')->braintree_plan }} plan</p>
                                @if (Auth::user()->subscription('main')->onTrial()) 
                                    Your trial period will end in {{ Auth::user()->subscription('main')->trial_ends_at->diffInDays() }} days
                                @endif
                                <form action="{{ url('subscription/cancel') }}" method="post">
                                    <button type="submit" class="btn btn-danger">Cancel subscription</button>
                                    {{ csrf_field() }}
                                </form>
                                <br>
                                <div class="panel-footer">
                                <em class="small"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> On cancelling your subscription, you will not be billed at the end of your cycle and you will still have access until your current plan expires. However you can renew your subscription if you want.</em>
                                </div>
                            @endif
                        </div>
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
