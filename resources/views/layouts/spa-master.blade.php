<!doctype html>
<html lang="en">
<head>
    <title>TheInnovestors</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="d7gBnkn0v6wNn7JAf3526WxiqQQdDXr8q0w7VGwRXUU" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slide.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/headmobilee.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading-btn.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('static-pics/favicon.ico') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="{{ asset('css/myiconstyle.css') }}" rel="stylesheet">

<script type="text/javascript">
 /* var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */ //dont activate this line
 /* _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//srotsevonni-piwik.tk/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();  */
</script>
<script>
        // rename myToken as you like
        window.Laravel =  <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
        </script>
        
@include('partials/_analytics')
<!-- End Piwik Code -->
    </head>
<body>
  <script type="text/javascript">
    //timer
    var d = new Date();
    var futuredate = new Date(2017,9,25,12,0,0);
    var n = d.getTime();
    var f = futuredate.getTime();
    if (f > n) {
        if(window.location.href == 'https://www.theinnovestors.com/' || window.location.href == 'https://www.theinnovestors.com/login' || window.location.href == 'https://www.theinnovestors.com/register' || window.location.href == 'https://www.theinnovestors.com/innovator/register') {
             window.location.href = 'http://theinnovestors.com/launchingsoon';    
        }else{
          //   check();
        }
    } else { 
     //   window.location.href = 'http://theinnovestors.dev';
    }
    function check() {
        setInterval(function() {
             d = new Date();
             futuredate = new Date(2017,9,25,17,51,0);
             n = d.getTime();
             f = futuredate.getTime();
            if (f > n) {
             //   console.log('reading');
              //   window.location.href = 'http://theinnovestors.dev/contact';
            } else {
                window.location.href = 'http://theinnovestors.com';
            }
        }, 1000);
    }
    //timer
  </script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-101228365-1', 'auto'); 
  ga('send', 'pageview');

</script>
    
 <div id="app" style="position: relative; width: 100%;">
  <input type="text" value="{{Auth::user()}}" id="globalauthid" hidden>
    <!--REQUESTS-->
    @include('partials/_requests_notifier_in_header')
    <!--REQUESTS-->

    @include('partials/headerspa')  <!--header-->
   @include('partials/_new_message')
    <div id="csrf">{{ csrf_field() }}</div>
       
        @if($flash = session('message'))
            <div class="alert alert-success notifications_panel" role="alert" style="position: fixed; top: 40px; width: 30%; z-index: 60;">
                {{$flash}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div style="height: 10px;"></div>
        <div style="height: 60px; display: none;" id="content-top"></div>

        
        <div class="row" style="position: relative;">  <!--container div for content between header and footer-->
            @if(checkPermission(['admin']))
                @include('/partials/admin_left_sidebar')
            @else
                @include('/partials/left_sidebar')  <!--left sidebar-->
            @endif
 
             <router-view></router-view>  <!--router view for changing content-->

              @include('/partials/sidebar')  <!--right sidebar-->
          </div>

     
        @yield('braintree')
        
    </div>
    
        @include('partials/footer')


    <!--DELETE-->
    <script>
    /*     var myid = document.getElementById('myid').value;
         var myusername = document.getElementById('myusername').value;
    var socket = io.connect('http://theinnovestors.dev:8890');
   socket.on('message', function (data) {
        data = jQuery.parseJSON(data);
        console.log(data.fullname);

         
        if(data.receiver_request_id == myid){
            if(data.request_id == 1){
 
                $( "#req" ).prepend(
                 '<div style="position: fixed; bottom: 0%; right: 3%; z-index: 99" id="reque_modal"><div class="alert aler-info col-xs-12 col-sm-4 col-md-4 col-lg-4 col-sm-offset-1 small" role="alert" style="width: 100%; background-color: #C0C0C0; z-index: 17"><span> You have new connection request(s). <a href="/'+myusername+'/connections">view</a></span> </div></div>' 
                 ); 
            }
        }
        

      }); */
    </script>
    
    @include('/partials/_rating_widget')

    <!-- Include jQuery Mobile stylesheets -->
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/headscript.js') }}"></script>
    <script src="https://use.fontawesome.com/fa2b05ef33.js"></script>  
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
    <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.all.js"></script>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
 <script type="text/javascript" src="/js/vue10.js"></script>
      <script type="text/javascript" src="/js/main9.js"></script>
       <script src="{{ asset('js/bundle1.js') }}"></script>
     <!--  <script src="{{ asset('js/app.js') }}"></script> -->
       <!--for mobileheader slide in when logged in-->
      <!--for mobileheader slide in when logged in-->
</body>
</html>