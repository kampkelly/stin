<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;" >
      <!--search form-->
        <section class="middle-coumn background-primar" style="padding-bottom: 60px;">
           <h4 class="text-center">Message Threads</h4>
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <div class="container-fluid" v-show="loaded">
           <!--insert-->
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-4 allthreads">
                     <ul class="list-group thread" style="height: 80vh; background-color:#227FBB; width:250px; position:fixed;">
                        <h4 class="text-center" style="color:white;">Threads</h4>
                      <div v-if="count_threads >= 1">
                        <div v-for="thread in threads">
                            <span v-if="auth.id == thread.receiver_id">
                                <li class="list-group-item smal" style="border: none !important;background-color: #227FBB !important; padding-bottom: 0px;" v-for="user in users" v-if="user.id == thread.user_id">
                                <router-link tag="a" :to="'/' + user.username + '/threads/' + thread.slug" class="text-muted">
                                    <a style="color:white;background-color: #227FBB !important;">
                                        <span v-if="auth.id != thread.user_id"> </span>
                                        <span v-else> </span>
                                         - {{thread.title}} 
                                        <span style="display:none;"> » </span></a>
                                  </router-link>
                                </li>
                            </span>
                            <span v-else>
                                <li class="list-group-item smal" style="border: none !important;background-color: #227FBB !important; padding-bottom: 0px;" v-for="user in users" v-if="user.id == thread.receiver_id">
                                <router-link tag="a" :to="'/' + user.username + '/threads/' + thread.slug" class="text-muted">
                                    <a style="color:white;background-color: #227FBB !important;">
                                        <span v-if="auth.id != thread.user_id"></span>
                                        <span v-else> </span>
                                        - {{thread.title}} 
                                        <span style="display:none;"> » </span> </a>
                                  </router-link>
                                </li>
                            </span>
                        </div>
                    </div>
                    <div v-else><p style="color:white;padding:5px;" class="small">You have no threads with anyone at this time</p></div>
                    </ul>
                </div>
                    <router-view></router-view>
            </div>
             <div style="height:600px;"></div>
            <!--insert-->
    
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
                threads: [],
                count_threads: '',
                loading: '',
                loaded: '',
                auth: '',
                users: ''
            }
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this
            if ($(window).width() < 768) {
            } 
            toggle_allthreads();
            this.fetchData()
        },
        methods: {
             fetchData () {
                axios.post('/' + this.$route.params.username + '/threads')
                .then(function(response) { 
                self.threads = response.data[0],
                self.auth = response.data[1],
                self.users = response.data[2],
                self.count_threads = response.data[0].length,
                self.loading = false,
                self.loaded = true,
                responsive();
                }); 
            },
            postedOn(thread) {
                return moment(thread.created_at).fromNow();
            },
        }
    }
    function toggle_allthreads() {
         $('.allthreads').show();
         $('footer').hide();
         if ($(window).width() < 768) {
            $('.third-column').hide();
            $('footer').hide();
        }
         window.addEventListener("resize", myFunction);
          function myFunction() {
             var w = window.outerWidth;
              var h = window.outerHeight;
             if (w < 768) {
                  $('.third-column').hide();
              } else {
                 $('.third-column').show();
              }
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

