@extends('layouts.new_master')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<!--<div style="height: 40px;"></div> -->
<div id="in_reg" ng-app="">
<div style="height: 70px;"></div>
<div class="container">
    <div class="text-center">
        <h2>Hi, Register to get access to all innovations!</h2>
    </div>
  <!--  <h4>Hello, register free below as an innovator and get access to our list of innovative activities happening around you.<br> You can also upload your own invention/startup when you are ready!</h4> -->
  <div style="height: 10px;"></div>
  <div class="row">
      <div class="col-xs-12 col-sm-0 col-md-1 col-lg-3">
          
      </div>
      <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
        <p class="small" style="display: none;">Signup as an investor instead, <a href="/investor/register">click here</a></p>
          <form class="form-horizontal panel panel-footer" role="form" method="POST" action="/innovator/register" name="myForm" >
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
                    <label for="fullname" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">Full Name <span id="asterisks">*</span></label>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                        <input id="fullname" type="text" class="form-control" name="fullname" value="{{ old('fullname') }}" placeholder="Enter Full Name" required autofocus ng-model="firstname">
                        <span class="small" ng-show="myForm.fullname.$touched && myForm.fullname.$invalid">Firstname is required.</span>
                        @if ($errors->has('fullname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fullname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                 <label for="username" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">Username <span id="asterisks">*</span></label>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('lastname') }}" placeholder="Enter Username" required autofocus ng-model="username">
                        <span class="small" ng-show="myForm.username.$touched && myForm.username.$invalid">Username is required.</span>
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">E-Mail Address <span id="asterisks">*</span></label>

                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" required ng-model="email">
                        <span class="small" ng-show="myForm.email.$touched && myForm.email.$invalid">Email is required.</span>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">Password <span id="asterisks">*</span></label>

                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                        <input id="password" type="password" class="form-control" name="password" placeholder="At least 6 characters" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!--EDITED FIELDS START HERE-->
                 
                <!--EDITED FIELDS END HERE-->

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        <button type="submit" class="btn btn-success btn-block">
                            Register Now
                        </button>
                    </div>
                </div>
            </form>
            <h4 class="text-center">or use</h4>
            <ul class="list-inline list-unstyled" style="display: flex;">
                <a href="/auth/facebook" class="btn btn-primary" :disabled="disabled" style="cursor: pointer; flex: 1; margin-right: 10px;"> Facebook</a>
                <a href="{{ url('/auth/google') }}" class="btn btn-md btn-danger" :disabled="disabled" style="cursor: pointer; flex: 1; margin-left: 10px;">Google</a>
            </ul>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
          
      </div>
  </div>
            <div style="height: 70px;"></div>
</div>
</div>
@endsection
