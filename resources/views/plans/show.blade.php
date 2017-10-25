@extends('layouts.landing_master')

@section('content')
<script src="/js/app.js"></script>
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
                   <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                          <div class="panel-heading text-center">Subscribe to {{ $plan->name }} Plan -> ${{ number_format($plan->cost, 2) }} per month</div>
                          <div class="panel-body">
                                <form action="{{ url('/subscribe') }}" method="post">
                                  <div id="dropin-container"></div>
                                  <input type="hidden" name="plan" value="{{ $plan->id }}">
                                  {{ csrf_field() }}
                                  <hr>
                                  <button id="payment-button" class="btn btn-primary btn-flat hidden" type="submit">Pay now</button>
                                </form>
                          </div>
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

@section('braintree')
    <script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>

    <script>
        $.ajax({
            url: '{{ url('braintree/token') }}'
        }).done(function (response) {
            braintree.setup(response.data.token, 'dropin', {
                container: 'dropin-container',
                onReady: function () {
                    $('#payment-button').removeClass('hidden');
                }
            });
        });
    </script>
@endsection