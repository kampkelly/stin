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
        <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8">
                <h2 class="text-center" style="color: white; text-shadow: 1px 1px #000000;">Hello, Have an Idea? Pitch it. Get Invested!</h2>
            <div class="text-ceter" style="padding: 0px 0px 0px 40px;">
                <h3 style="color: white; text-shadow: 1px 1px #000000;" class="text-center"> <span style="font-size: 18px; color: white; text-shadow: 0.8px 0.8px #000000;"> Connecting Creative Minds With Investors</span></h3>
                <div style="height: 40px;"></div>
                <ul class="list-unstyled list-inline text-center">
                    <li><a href="/startups" class="btn btn-success btn-lg" style="background-color: #227FBB;">See Innovations</a></li>
                    <li>
                        <p class="small" style="color: white; text-shadow: 0.7px 0.7px #000000;">Want to invest?</p>
                        <a href="/contact" class="btn btn-primary btn-lg">Click Here</a>

                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
            <div class="text-center">
                <a href="/innovator/register" class="btn btn-success btn-md">Pitch Your Innovation</a>
                <hr>
                <div  style="padding: 0px 40px 0px 40px;">
                    <div class="pael panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Latest Innovations</h3>
                        </div>
                        <div class="panel-body" style="background-color: rgba(255, 255, 255, 0);">
                            @if(count($startups) >= 10)
                            @foreach($startups as $startup)
                                <div class="list-group">
                                    <a href="#" class="list-group-item">{{str_limit($startup->title, $limit = 30)}}</a>
                                </div>
                            @endforeach
                            @else
                                <p style="color: white;">Welcome to theinnovestors, we are glad to have you </p>
                            @endif
                           
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
<div style="height: 0px;"></div>

<!--insert-->
<section id="secondview"  style="background-color: white; height: 100vh;">
    <div class="" style="background-color: #227FBB; height: 60vh;">
        <div class="text-center container" style="padding-top: 50px;">
            <h1>Our Mission</h1>
            <h3>The plug that connects innovators/startups to secure investments.</h3>
            <h4>Dedicated to Promote Entrepreneurship by showcasing peoples’ creativity.</h4>
            <h4>Establish connections with like minded individuals</h4>
            <div style="height: 10px;"></div>
            <a href="/about" class="btn btn-success btn-lg">Learn More</a>
        </div>
    </div>
    <div style="height: 40vh; backgound-color: #2589c9;">
        <div class="text-center">
            <h3 style="color: #242525; padding-top: 7px;">Partners</h3>
            <div class="row" style="padding: 0px 30px 0px 30px;">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                     <img src="{{ asset('static-pics/partners/enspire.jpg') }}" class="img-responsive img-circle" style="filter: blur(0px) brightness(1) grayscale(0%); widt: 70%; height: 100px;">
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                     <img src="{{ asset('static-pics/partners/salesnaija.png') }}" class="img-responsive img-circle" style="filter: blur(0px) brightness(1) grayscale(0%); wdth: 70%; height: 100px;">
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                     <img src="{{ asset('static-pics/partners/abstracthoughts.jpeg') }}" class="img-responsive img-circle" style="filter: blur(0px) brightness(1) grayscale(0%); width: 60%; height: 100px;">
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                     <img src="{{ asset('static-pics/partners/elis.svg') }}" class="img-responsive img-circle" style="filter: blur(0px) brightness(1) grayscale(0%); widt: 70%; height: 100px;">
                </div>
            </div>
        </div>
    </div>
</section>
<div style="height: 10px;"></div>
<section id="thirdview" style="height: 100vh; background-color: white;">
<div class="container">
    <h2 class="text-center">The Process</h2>
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-6 howitworks">
            <ol>
                <li style="background-clor: #1AAF5D; padding: 0px 10px 0px 10px; magin-bottom: 20px; bordr-radius: 2%;">
                    <h4 style="coor: white;">An innovator or startup (indidvidual/group) registers on theinnovestors.</h4>
                </li>
                <li>
                    <h4>An innovator: </h4>
                    <ul class="list-unstyled">
                        <li>(a) uploads a brief description of his project, invention, startup.</li> <p class="text-center">Or</p>
                        <li>(b) and other innovators connect to make a better improved version of their projects. They uploads a brief description of his project, invention, startup.</li>
                    </ul>
                </li>
                <li>
                   <h4 style="colr: gray;"> The invention/startup gets published to investors who view it and makes contact with the innovator, startup.</h4>
                </li>
                <li>
                    <h4 style="coor: white;">The investor gets funded, acquired, enters partnership or absorbed into the investor's company.</h4>
                </li>
            </ol>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-6">
            <img src="{{ asset('/homepage/illustration1.png') }}" class="img-responsive" style="filter: blur(0px) brightness(1) grayscale(0%); hight: 80vh; width: ; padding-eft: 50px;">
        </div>
    </div>
</div>
</section>
<section class="inbetween">
    <img src="{{ asset('/homepage/steve.jpg') }}" class="img-reponsive" style="filter: blur(0px) brightness(1) grayscale(0%); height: 50vh; paddng-left: 25%;">
</section>
<section id="fourthview" style="backgrund-color: #227FBB; height: 100vh;">
    <h3 class="text-center">What You Benefit from Theinnovestors</h3>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div>
                <div class="pael panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading" style="background-color: #1AAF5D; color: white; border-bottom: none;">Innovator</div>
                    <div class="panel-body">
                        <p style="clor: black;">When you register as an innovator, startup, you will have access to the following:</p>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Access to innovative ideas that will trigger the mind</td>
                            </tr>
                            <tr>
                                <td>Showcase your invention</td>
                            </tr><tr>
                                <td>Get seen by investors</td>
                            </tr><tr>
                                <td>Connect and partner with other innovators</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div>
                <div class="pael panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading" style="background-color: #227FBB; color: white; border-bottom: none;">Investor</div>
                    <div class="panel-body">
                        <p style="clor: black;">When you register as an investor, startup, you will have access to the following:</p>
                    </div>
                    <table class="table">
                        
                        <tbody>
                            <tr>
                                <td>Access to all innovations</td>
                            </tr>
                            <tr>
                                <td><h5>Tailored innovations for your needs</h5></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div style="height: 20px;"></div>
<section id="fifthview" class="container">
    <h4 class="text-center">Have a question, contact us here:</h4>
    <form action="/contact" method="POST" class="form-horizontal" role="form">
         {{ csrf_field() }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                 <label for="username" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">Name</label>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4">
                    <input id="username" type="text" class="form-control" name="contact_name" value="{{ old('lastname') }}" placeholder="Enter Full Name" required autofocus ng-model="username">
                </div>
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                 <label for="username" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">Email</label>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4">
                    <input id="username" type="email" class="form-control" name="contact_email" value="{{ old('lastname') }}" placeholder="Enter Email" required autofocus ng-model="username">
                </div>
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                 <label for="username" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">Message</label>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4">
                    <textarea name="contact_msg" placeholder="Enter Message" class="form-control" rows="3"></textarea>
                </div>
            </div>
    
            
    
            <div class="form-group">
                <div class="col-sm-10 col-lg-4 col-sm-offset-4">
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
                $('.deskheader').addClass('navbar-default');
                $('.deskheader a').addClass('link');
                $('.dsk-head').css("padding-right", '10em');
            }else{
                $('.deskheader').removeClass('navbar-default');
                $('.deskheader a').removeClass('link');
                $('.dsk-head').css("padding-right", '10em');
            }
        });
        $('#loads').load('map.html')
        $('footer').show();
    });
</script>
@endsection