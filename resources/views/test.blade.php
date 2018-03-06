   $(".messenger_preview").on("click", function() {
      //  $('.messenger').show("slow");
       $('.messenger_preview').hide();
       $('.messenger').show();
       //$('.messenger').css("border-radius", "0px !important");
        $(".messenger").animate({
          /*  left: '0%',
            opacity: '1',
            top: '40%',
            width: '100%' */
            left: '0%',
            opacity: '1',
         //   top: '10%',
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
        if (wh >= 1199) {

        }else{
            
        }
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