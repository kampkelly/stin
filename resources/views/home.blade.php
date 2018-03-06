@if (Auth::check()) 
    <script type='text/javascript'> document.location = '/dashboard'; </script>
@endif
@extends('layouts.new_master')

@section('content')
<!--import--> 
<div class="homepage1">
<section id="firstview">
    <div class="row containe">
        <div style="height: 70px;"></div>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
                <h2 class="text-center" style="color: white; text-shadow: 1.6px 1.6px #000000; font-size: 35px;"><b>Hello, Have an Idea? Pitch it. Get Invested!</b></h2>
            <div class="text-ceter" style="padding: 0px 0px 0px 40px;">
                <h3 style="color: white; text-shadow: 1.2px 1.2px #000000;" class="text-center"> <span style="font-size: 18px; color: white; text-shadow: 1.2px 1.2px #000000; font-size: 20px;"><b> Connecting Creative Minds With Investors</b></span></h3>
                <div style="height: 20px;"></div>
                <ul class="list-unstyled list-inlne text-center">
                    <li><a href="/innovations" class="btn btn-success btn-lg" style="background-color: #227FBB; font-size: 26px;">See Innovations</a></li> <br>
                    <li class="d-none d-lg-block"><a href="/request_team" class="btn btn-light btn-lg" style="font-size: 14px;">Request to teamup1</a>
                    <span title="snnsls" style="color: white; cursor: pointer; text-decoration: underline; text-shadow: 0.8px 0.8px #000000;" onclick="requestpartner_info()">What is this?</span></li>
                    <li class="d-lg-none">
                        <a href="/request_team" class="btn btn-light btn-lg" style="font-size: 17px;">Request to teamup</a>
                        <p class="small" style="color: white; text-shadow: 0.7px 0.7px #000000;">What is this?</p>

                    </li>
                </ul>
                 <div style="height: 40px;"></div>
                
                <div class="text-center" style="display: none;">
                    <a href="/request_team" class="btn btn-default btn-lg btn-bock" style="padding: 12px 50px 12px 50px">Request to teamup</a>
                    <span title="snnsls" style="color: white; cursor: pointer; text-decoration: underline;" onclick="requestpartner_info()">What is this?</span>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
            <div class="text-center">
                <a href="/dashboard#/innovation/create" class="btn btn-success btn-sm">Pitch Your Innovation</a>
                <hr>
                <div  style="padding: 0px 40px 0px 40px;" class="hide-smartphone">
                    <div class="pael panel-default">
                        <div class="panel-heading">
                             @if(count($startups) >= 10)
                            <h3 class="card-header">Latest Innovations</h3>
                            @else
                            <h6 class="card-header bg-light">News Updates</h6>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
<div style="height: 0px;"></div>

<!--insert-->
<section id="secondview"  style="background-color: white; height: 60vh;">
    <div class="hmm" style="background-color: #227FBB; height: 60vh;">
        <div class="text-center container" style="padding-top: 50px;">
            <h1>Our Mission</h1>
            <h3>The plug that connects innovators/startups to secure investments.</h3>
            <h4>Dedicated to Promote Entrepreneurship by showcasing peoples’ creativity.</h4>
            <h4>Establish connections with like minded individuals</h4>
            <div style="height: 10px;"></div>
            <a href="/about" class="btn btn-success btn-lg">Learn More</a>
        </div>
    </div>
</section>
<div style="height: 10px;"></div>

<section id="thirdview" style="height: 100vh; background-color: white;">
<div class="container">
    <h2 class="text-center">The Process</h2>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 howitworks">
            <ol>
                <li>
                    <h4 style="coor: white;">An Innovator registers on Theinnovestors.</h4>
                </li>
                <li>
                    <h4>An Innovator uploads a project, invention or startup.</h4>
                </li>
                <li>
                   <h4 style="colr: gray;"> One or more Innovators may connect to make a better improved version of their innovations.</h4>
                </li>
                <li>
                    <h4 style="coor: white;">The Innovator gets funded, acquired, enters partnership or absorbed into the Investor's company.</h4>
                </li>
            </ol>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <img src="{{ asset('/homepage/illustration1.png') }}" class="img-fluid" style="filter: blur(0px) brightness(1) grayscale(0%); hight: 80vh; width: ; padding-eft: 50px;">
        </div>
    </div>
</div>
</section>
<div style="height: 20px;"></div>

<section id="fifthview" class="container">
    <h4 class="text-center">Contact us below</h4>
    <form action="/contact" method="POST" class="form-horizontal justify-content-center" role="form">
         {{ csrf_field() }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                 <label for="username" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 offset-lg-4 offset-md-2 offset-sm-2 control-label">Name</label>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4 offset-lg-4 offset-md-2 offset-sm-2">
                    <input id="username" type="text" class="form-control" name="contact_name" value="{{ old('lastname') }}" placeholder="Enter Full Name" required autofocus ng-model="username">
                </div>
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                 <label for="username" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 offset-lg-4 offset-md-2 offset-sm-2 control-label">Email</label>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4 offset-lg-4 offset-md-2 offset-sm-2">
                    <input id="username" type="email" class="form-control" name="contact_email" value="{{ old('lastname') }}" placeholder="Enter Email Address" required autofocus ng-model="username">
                </div>
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                 <label for="username" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 offset-lg-4 offset-md-2 offset-sm-2 control-label">Message</label>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4 offset-lg-4 offset-md-2 offset-sm-2">
                    <textarea name="contact_msg" placeholder="Enter Message" class="form-control" rows="3"></textarea>
                </div>
            </div>
    
            
    
            <div class="form-group">
                <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4 offset-lg-4 offset-md-2 offset-sm-2">
                    <button type="submit" class="btn btn-success btn-block">Send</button>
                </div>
            </div>
    </form>

</section>

</div>

<!--import-->
<div style="height:20px;"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(window).scroll(function () {
            var scrollTop = $(window).scrollTop(); 
      //  var documentTop = $(document).scrollTop();
            if (scrollTop > 600) {
           //     $('.deskheader').addClass('navbar-default');
             //   $('.deskheader a').addClass('link');
              //  $('.dsk-head').css("padding-right", '10em');
            }else{
               // $('.deskheader').removeClass('navbar-default');
               // $('.deskheader a').removeClass('link');
               // $('.dsk-head').css("padding-right", '10em');
            }
        });
        $('#loads').load('map.html')
        $('footer').show();
    });
    function requestpartner_info() {
        swal({
      //      title: 'How it works?',
              width: 500,
              background: '#d9d7d8',
          html: '<h3>Requesting for a team member?</h3> \
<p>You make a request for a team member and you get contacted by suitable persons to fill in that role for your idea/startup.</p>',
        confirmButtonText: 'Got It!',
        confirmButtonColor: 'grey',
        })
    }
</script>
@endsection