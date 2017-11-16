<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <div class="container-fluid all_innovations" style="padding-left: 30px" v-show="loaded">
            <h3 class="text-center">{{post.title}}</h3>        
              <router-link tag="a" to="/posts">
                <a>back to posts</a>
              </router-link>
                <div class="panel panel-inf">
                    <div class="panel-heading" style="background:grey;">
                        <h3 class="panel-title" style="color: white;">{{post.title}}<span class="small pull-right" style="color:white;">{{ postedOn(post) }}</span></h3>
                    </div>
                    <div class="panel-body">
                      <p> {{post.body}} </p>
                    </div>
                </div> 
        </div>
     
        </section>
    </div> 
</div>
</template>


<script>
import moment from 'moment';

    export default {
        data() {
            return {
                posts: [],
                loading: '',
                loaded: '',
                post: ''
            }
        },
         beforeRouteUpdate: function(to, from, next) {
            next();
            this.fetchData();
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this,
            this.fetchData()
        }, 
        methods: {
            fetchData () {
                axios.post('/post/' + this.$route.params.slug)
                .then(function(response) { 
                $(document).scrollTop(1);
                self.post = response.data,
                self.loading = false,
                self.loaded = true,
                responsive();
                }); 
            },
            postedOn(post) {
                return moment(post.created_at).fromNow();
            },
        }
    }

    function responsive() {
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

