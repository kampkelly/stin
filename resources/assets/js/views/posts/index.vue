<template>
<div class="col-xs-2 col-sm-12 col-md-8 col-lg-8 col-xl-7 second-row" id="secondDiv" style="padding-top: 70px; margin-right: 0px !important;">
        <div>
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
            <h4 class="text-center">News Updates</h4>
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div> 
        <div class="container-fluid all_innovations" style="padding-left: 30px" v-show="loaded">
                <div v-for="post in posts">
                    <div class="panel-heading">
                        <h4 class="card-title bg-secondary p-1">
                        <router-link tag="a" :to="'/post/' + post.slug">
                            <a style="color:white;">{{post.title}}</a>
                          </router-link>
                        <span class="small pull-right" style="color:white;">{{ postedOn(post) }}</span></h4>
                    </div>
                    <div class="card-body">
                       <p class="small" style="line-height:28px;"> {{post.body}} 
                       <router-link tag="a" :to="'/post/' + post.slug" class="btn btn-sm btn-info">
                            <a style="color:white;">Read More...</a>
                          </router-link>
                       <a :href="'/admin/post/edit/' + post.slug" class="btn btn-sm btn-warning hide-all">Edit</a> </p>
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
                loaded: ''
            }
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this,
            axios.post('/getposts')
             .then(function(response) {
              $(document).scrollTop(1);
                self.posts = response.data,
                self.loading = false,
                self.loaded = true
                responsive();
                }); 
        },
        methods: {
            postedOn(post) {
                return moment(post.created_at).fromNow();
            },
        }
    }

    function responsive() {
    //  alert('am showing first');
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

