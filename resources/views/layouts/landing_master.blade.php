<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <title>TheInnovestors</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css"> -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slide.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/headmobilee.css') }}" rel="stylesheet">
    <link href="{{ asset('css/news_scroll.css') }}" rel="stylesheet">
<!--
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style3.css') }}" rel="stylesheet">
-->
    <link rel="shortcut icon" href="{{ asset('static-pics/favicon.ico') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include jQuery Mobile stylesheets -->
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <!-- Include the jQuery Mobile library -->
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
 <!--   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
   
  <!--  <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/modernizr.custom.86080.js') }}"></script> -->
    <script src="{{ asset('js/headscript.js') }}"></script>
    <script src="https://use.fontawesome.com/fa2b05ef33.js"></script>
    <link href="{{ asset('css/my-slider.css') }}" rel="stylesheet">
    <script src="{{ asset('js/ism-2.2.min.js') }}"></script>
    <script src="https://algorithmia.com/v1/clients/js/algorithmia-0.2.0.js"></script>
     <script src="{{ asset('js/script.js') }}"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Handlee" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/myiconstyle.css') }}" rel="stylesheet">
    <!--DELETE-->
        <style>
       
        </style>
    <!--DELETE-->
    <!-- Piwik --
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//piwik.dev/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
 End Piwik Code -->
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//srotsevonni-piwik.tk/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->
    </head>
<body style="positin: relative;">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-101228365-1', 'auto');
  ga('send', 'pageview');

</script>
    
 <div id="boy" style="position: relative; width: 100%;">
    <!--REQUESTS-->
    @if (Auth::check())
        @if(count( Auth::user()->getFriendRequests() ) >= 1)
        <div style="position: fixed; bottom: 0%; right: 3%; z-index: 99" id="reques_modal">
        <div class="alert aler-info col-xs-12 col-sm-4 col-md-4 col-lg-4 col-sm-offset-1 small" role="alert" style="width: 100%; background-color: #FFFFFF; z-index: 17">
        <span>Connection Request(s):</span>
            @foreach(Auth::user()->getFriendRequests() as $k)
            <?php $users =  DB::select("SELECT * FROM users"); ?>
                <ul class="list-unstyled"> 
                @foreach($users as $us)
                    @if($us->id == $k->sender_id)
                        <li><a href="/innovator/profile/{{$us->username}}" style="color: #003B7D;">{{$us->fullname}}</a> <a href="/accept_request/{{$us->username}}" class="btn btn-info btn-xs">Accept Request</a> <a href="/reject_request/{{$us->username}}" class="btn btn-warning btn-xs">Reject Request</a></li>
                    @endif
                @endforeach
                </ul>
            @endforeach
         </div>
         </div>
        @endif
    @endif
    <!--REQUESTS-->

   
        @include('partials/landing_header')
        @if($flash = session('message'))
            <div class="alert alert-success notifications_panel" role="alert" style="position: fixed; top: 40px; width: 30%; z-index: 60;">
                {{$flash}}
            </div>
        @endif
     
        @yield('content')
        <div class="text-center" style="padding-bottom: 20px;">
            <h5>Signup to our newsletters to be updated!</h5>
             <form action="/subscribe" method="POST" class="form-inline" role="form">
            {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Adress">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-0">
                            <button type="submit" class="btn btn-primary btn-bloc">Update Me</button>
                        </div>
                    </div>
            </form>
        </div>

         @include('partials/footer')
      <!--  <script src="/js/app.js"></script> -->
        @yield('braintree')
    </div>
        @include('partials/master_script')

    <!--DELETE-->
    <script>
        
    </script>
    <!--DELETE-->
    <!-- Go to www.addthis.com/dashboard to customize your tools -- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-590b6d62620c44d0"></script>  -->
    <script type="text/javascript">(function(d, t, e, m){
    
    // Async Rating-Widget initialization.
    window.RW_Async_Init = function(){
                
        RW.init({
            huid: "362618",
            uid: "74fffb34f9f1f493aa037adee253526b",
            source: "website",
            options: {
                "advanced": {
                    "layout": {
                        "dir": "rtl"
                    },
                    "font": {
                        "size": "9px",
                        "italic": true
                    }
                },
                "size": "tiny",
                "style": "green",
                "isDummy": false
            } 
        });
        RW.render();
    };
        // Append Rating-Widget JavaScript library.
    var rw, s = d.getElementsByTagName(e)[0], id = "rw-js",
        l = d.location, ck = "Y" + t.getFullYear() + 
        "M" + t.getMonth() + "D" + t.getDate(), p = l.protocol,
        f = ((l.search.indexOf("DBG=") > -1) ? "" : ".min"),
        a = ("https:" == p ? "secure." + m + "js/" : "js." + m);
    if (d.getElementById(id)) return;              
    rw = d.createElement(e);
    rw.id = id; rw.async = true; rw.type = "text/javascript";
    rw.src = p + "//" + a + "external" + f + ".js?ck=" + ck;
    s.parentNode.insertBefore(rw, s);
    }(document, new Date(), "script", "rating-widget.com/"));</script>


<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
</body>
</html>