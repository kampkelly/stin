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
            if(scrollTop > lastScrollTop && scrollTop > 1.7) {
                $('.new-head').css("margin-top", '1.5em');  //scrolling up
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
            $("#show_desktop_sidebar").hide();
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
               $("#show_desktop_sidebar").hide();
               $("#close_desktop_sidebar").hide();
               $('.first-row').css({"left":"0px","opacity":"1"});   //new line
        } else {
            $(".first-row").hide();
            $("#show_desktop_sidebar").show();
            $("#close_desktop_sidebar").hide();
            $("#innovator_top_div").show(); //innovator profile top div
            $('.second-row').css("margin-left", "0%");
            $('.first-row').css({"left":"-200px","opacity":"1"});   //new line
           // close_sidebar_on_document_click();
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
     //$('#notify_update').hide();
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
   ///////////////////////////messenger
   $(".messenger_preview").on("click", function() {
      //  $('.messenger').show("slow");
       $('.messenger_preview').hide();
       $('.messenger').show();
       //$('.messenger').css("border-radius", "0px !important");
         
             $(".messenger").animate({
                left: '0%',
                opacity: '1',
                top: '2.8em',
                width: '96%',
                height: '100%',
                right: '0%',
            }); 
       
        $('body').addClass('stop-scrolling');
        $('#is_there_new_message').hide(); 
   });

    $(".minimize_messenger").on("click", function() {
      //  $('.messenger').show("slow");
      $('.messenger_preview').show();
       var wh = window.outerWidth;
        $(".messenger").animate({
           /* left: '40%',
            opacity: '0.5',
           // height: '100vh',
            top: '96%',
            width: '60%' */
            //original ends
            left: '78%',
            opacity: '0.1',
         //   top: '10%',
            top: '90%',
          //  bottom: '4%',
            width: '10%',
            height: '38px',
            right: '0%',

        });
        $('.messenger').hide();
        $('body').removeClass('stop-scrolling');
   });
    //////////////////////////////messenger

    //show and close desktop sidebar
    $("#show_desktop_sidebar").on("click", function() {
        $(".first-row").show();
        $("#show_desktop_sidebar").hide();
        $("#close_desktop_sidebar").show();
      //  $(".first-row").toggle("slide");
        $(".first-row").animate({
            left: '0px',
        });
    });
    $("#close_desktop_sidebar").on("click", function() {
        $("#close_desktop_sidebar").hide();
        $("#show_desktop_sidebar").show();
      //  $(".first-row").toggle("slide");
        $(".first-row").animate({
            left: '-200px',
        });
     //   $(".first-row").hide();
    });
        var wh = window.outerWidth;
        if (wh >= 1199) {
            $("#show_desktop_sidebar").hide();
           $("#close_desktop_sidebar").hide();
           $('.first-row').css({"left":"0px","opacity":"1"});   //new line
        }else{
            $("#show_desktop_sidebar").show();
           $("#close_desktop_sidebar").hide();
           $('.first-row').css({"left":"-200px","opacity":"1"});   //new line
        }
    if (wh <= 1199) {
          //  close_sidebar_on_document_click();
        }
    function close_sidebar_on_document_click() {  
        $(document).on('click', function(event) {
              if (!$(event.target).closest('#show_desktop_sidebar, #close_desktop_sidebar').length) {
                    $(".first-row").animate({
                        left: '-200px',
                    });
                    $("#show_desktop_sidebar").show();
                    $("#close_desktop_sidebar").hide();
              }
          
        });
      }

    //show and close desktop sidebar

});