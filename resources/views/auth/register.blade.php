@extends('layouts.new_master')

@section('content')
<div id="in_reg" ng-app="">
<div class="container">
<div style="height: 80px;"></div>
    <div class="text-center">
        <h4>Looking for a breakthrough idea? No problem, signup and get access to amazing innovations.</h4>
    </div>
     <div style="height: 40px;"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
          
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-6">
        <p class="small">Signup as innovator instead, <a href="/innovator/register">click here</a></p>
                <form class="form-horizontal panel panel-footer" role="form" method="POST" action="/investor/register" name="myForm">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
                        <label for="fullname" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">Company/Full Name <span id="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                            <input id="fullname" type="text" class="form-control" name="company_name" value="{{ old('fullname') }}" placeholder="Enter Company/Full Name" required autofocus ng-model="firstname">
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
                            <input id="password" type="password" class="form-control" name="password" placeholder="Must contain an uppercase, lowercase letter" required>

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
                        <div class="ccol-xs-12 col-sm-8 col-md-8 col-lg-7 col-lg-offset-3 col-sm-offset-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Signup as Investor
                            </button>
                        </div>
                    </div>
            </form>

            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
          
            </div>
    </div>
     <div style="height: 70px;"></div>
</div>
</div>
@endsection
