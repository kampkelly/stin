$(document).ready(function(){
    
    $(document).scrollTop(1);
    $(window).on('hashchange', function(e){  //detect url change
        $(document).scrollTop(1);  //move document to top
    });

    var lastScrollTop = 0;  //fix for fixed header in mobile phones
    var scrollTop;
         $(window).scroll(function () {
        //    setInterval(function() {
            scrollTop = $(window).scrollTop(); 
            if(scrollTop > lastScrollTop && scrollTop > 1.8) {
                $('.new-head').css("margin-top", '1.8em');  //scrolling up
            }else if(scrollTop < lastScrollTop) {
                $('.new-head').css("margin-top", '0em');  //scrolling up
            }else{}
            lastScrollTop = scrollTop;
         //   }, 1000);
        });       
  
    if ($(window).width() < 468) {
        $(".body-container").removeClass("container-fluid");
        $('#firstview .list-unstyled a').removeClass('btn-lg');
        $('#firstview .list-unstyled a').addClass('btn-md');
        $(".deskheader").hide();
    }else if($(window).width() < 768) {
        $(".body-container").addClass("container-fluid"); 
        $(".new-head").show();
        $(".mobilehead").show();
        $(".deskheader").hide();
        $('#firstview .list-unstyled a').removeClass('btn-md');
        $('#firstview .list-unstyled a').addClass('btn-lg');
    }else if($(window).width() < 992) {
        $(".body-container").addClass("container-fluid");
        $(".new-head").hide();
        $(".mobilehead").hide();
        $(".deskheader").show();
        $('#firstview .list-unstyled a').removeClass('btn-md');
        $('#firstview .list-unstyled a').addClass('btn-lg');
    }else{
        $(".body-container").addClass("container-fluid");
        $(".mobilehead").hide();
        $(".deskheader").show();
        $('#firstview .list-unstyled a').removeClass('btn-md');
        $('#firstview .list-unstyled a').addClass('btn-lg');
    }
    if ($(window).width() > 992) {
        $('#firstview .list-unstyled a').removeClass('btn-md');
        $('#firstview .list-unstyled a').addClass('btn-lg');
        $(".deskheader").show();
    }
    if ($(window).width() < 768) {
        $('#content-top').hide(); 
    }else if($(window).width() > 902){
        $('#content-top').hide(); 
    }else{
        $('#content-top').show();
    }
    //WINDOW RESIZE EVENTS BEGINS
    window.addEventListener("resize", myFunction);

    function myFunction() {
        var w = window.outerWidth;
        var h = window.outerHeight;
        var txt = "Window size: width=" + w + ", height=" + h;
        if (w < 468) {
            $(".body-container").removeClass("container-fluid");
            $('#firstview .list-unstyled a').removeClass('btn-lg');
            $('#firstview .list-unstyled a').addClass('btn-md');
            $(".deskheader").hide();
        }else if(w < 768) {
            $(".body-container").addClass("container-fluid");
            $(".new-head").show();
            $(".mobilehead").show();
            $(".deskheader").hide();
            $('#firstview .list-unstyled a').removeClass('btn-md');
            $('#firstview .list-unstyled a').addClass('btn-lg');
        }else if(w < 992) {
            $(".body-container").addClass("container-fluid");
            $(".new-head").hide();
            $(".mobilehead").hide();
            $(".deskheader").show();
            $('#firstview .list-unstyled a').removeClass('btn-md');
            $('#firstview .list-unstyled a').addClass('btn-lg');
        }else{
            $(".body-container").addClass("container-fluid");
            $(".mobilehead").hide();
            $(".deskheader").show();
            $('#firstview .list-unstyled a').removeClass('btn-md');
            $('#firstview .list-unstyled a').addClass('btn-lg');
        }
        if (w >= 992) {
            $('#firstview .list-unstyled a').removeClass('btn-md');
            $('#firstview .list-unstyled a').addClass('btn-lg');
            $(".deskheader").show();
        }
        if (w < 768) {
            $('#content-top').hide();  
        }
        else if(w > 902){
            $('#content-top').hide();
        }
        else{$('#content-top').show();}

        if (w >= 1199) {
            $(".first-row").show();
            $("#innovator_top_div").hide(); //innovator profile top div
          //    $('.first-row').css("position", "fixed");
          //   $('.first-row').css("width", "16.666667%");
             $('.first-row').css({"position":"fixed","width":"16.666667%"});
             $('.second-row').css("margin-left", "16.666667%");
              //  $("wrapper").hide();
                var offsetHeight = document.getElementById('secondDiv').offsetHeight;
                var firstHeight = document.getElementById('firstDiv').offsetHeight;
                diffHeight = offsetHeight - firstHeight;
                document.getElementById("k").innerHTML = offsetHeight;
                document.getElementById("kk").innerHTML = firstHeight;
                document.getElementById("kkk").innerHTML = diffHeight;
                   $(window).scroll(function () {
                    var scrollTop = $(window).scrollTop(); 
                    if (scrollTop > diffHeight) {
                        $('.first-row').css({"position":"fixed","top":"0px"});
                       //added to make it fixed
                    } else {
                    $('.first-row').css({"position":"fixed","top":"0px"});
                    }
                });
               $('first-row').scrollTop(diffHeight);
        } else {
            $(".first-row").hide();
            $("#innovator_top_div").show(); //innovator profile top div
            $('.second-row').css("margin-left", "0%");
        }
    }

    //REQUEST FADEOUT
    myFnction();
    function myFnction() {
        setTimeout(function(){ 
           $("#reques_modal").fadeOut(4000)
           $(".notifications_panel").fadeOut(4000)
        }, 3000);
    }
    //connection requests
        setInterval(function(){
            $('#notify_update').fadeOut(1000);
            $('#notify_update').fadeIn(2000);
        }, 3000);
        /////////////////////////////////////////////////////////////
   $("#my_file").on("change", function() {
      $("#formId").submit();
  });
   $("#my_file_profilepage").on("change", function() {
      $("#formId_profilepage").submit();
  });
   

});