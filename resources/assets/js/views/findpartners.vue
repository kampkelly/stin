<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <section v-show="loaded">
        <div class="container-fluid">
              <!--if innovator-->
              <h4 class="text-center">Partner Requests</h4>
              <div v-for="findpartner in findpartners">
                  <div>
                     <router-link tag="a" :to="findpartner.slug">
                        <a style="color:#2980B8 !important;">{{findpartner.name}} from {{findpartner.company_name}} needs a  {{findpartner.position}}</a>
                    </router-link>
                    <span style="color:grey;" class="pull-right">{{ postedOn(findpartner) }}</span>
                  </div>
              </div>
           
        </div>
    
        </section>
        <div id="usb"></div> 
        <div class="text-center"> 
             <!--paginate links-->
        </div>
        </section>
    </div> 
</div>
</template>


<script>
import moment from 'moment';
var globalauthid = document.getElementById('globalauthid').value;
let globalauth = jQuery.parseJSON(globalauthid);
console.log('game');
console.log('game');
console.log(globalauth.id);

    export default {
        data() {
            return {
                findpartners: [],
                auth: '',
                loading: '',
                loaded: ''
            }
        },
        created() {  //fire off ajax request
            this.loading = true,
            this.loaded = false,
            self = this 
            axios.post('/findpartners')
            .then(function(response) { 
                self.findpartners = response.data,
                self.loading = false,
                self.loaded = true,
                self.auth = globalauth,
                responsive()
                }); 
        },
        methods: {
            postedOn(findpartner) {
                return moment(findpartner.created_at).fromNow();
            }
        }
    }

    function responsive() {
        $('.first-row').css("position", "fixed");
      if ($(window).width() > 1199) {
         $(".first-row").show();
         $("#innovator_top_div").hide(); //innovator profile top div
          $('.first-row').css("position", "fixed");
         $('.first-row').css("width", "16.666667%");
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
                   $('.first-row').css("position", "fixed");
                    $('.first-row').css("top", "0px");
                   //added to make it fixed
                } else {
                $('.first-row').css("position", "fixed");
                $('.first-row').css("top", "0px");
                }
            });
               $('first-row').scrollTop(diffHeight);
        }else{
            $('.first-row').css("position", "absolute");
            $(".first-row").hide();
            $("#innovator_top_div").show(); //innovator profile top div
            $('.second-row').css("margin-left", "0%");
        }
    }
</script>

