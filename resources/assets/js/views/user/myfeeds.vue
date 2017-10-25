<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <div class="container-fluid startups" v-show="loaded">
            <h4 class="text-center">My Feeds</h4>
                <h4 class="text-center" style="color: #242525;"><small>See the latest posts from those you are
                <router-link tag="a" v-bind:to="'/' + username + '/connections'">
                    <a>connected</a>
                  </router-link> to</small></h4>
            <!--LOOP STARTUP STARTS-->
            <!--LOOP STARTS-->         
             <div v-for="friend in friends">
                            <div class="row" v-for="startup in startups" v-if="startup.user_id == friend.id">
                                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 oe">
                                    <div class="row pan panel-success">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <h4 class="text-ceter">
                                            <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                            <a>{{ startup.title }}</a>
                                          </router-link>
                                            <span class="small"> by {{startup.group_name}}</span>
                                            <span class="small pull-right">{{ postedOn(startup) }}</span><br><span class="small pull-right"><div class="rw-ui-container" v-bind:data-title="startup.id"></div></span></h4>
                                            <hr>
                                            <div class="row cntainer-fluid">
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                                    <img v-bind:src="'uploads/' + startup.image" width="100%" class="img-responsive">
                                                </div>
                                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                                     <p class="text-center text-justify small"><span style="text-decoration: underline;"> Brief description:</span> {{startup.short_desc}} <br>
                                                     <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                                        <a>More...</a>
                                                      </router-link>
                                                      </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                  </div>
                <!--hidden -->
                <!--hidden -->
                <ul class="list-unstyled"> 
                    
                </ul>
                    <hr>
 
            <!--LOOP STARTUP ENDS-->
        </div>  <!--loaded ends-->
     

        </section>
    </div> 
</div>
</template>

<script>

import moment from 'moment';

    export default {
        data() {
            return {
                thedata: [],
                loading: '',
                loaded: '',
                friends: '',
                startups: '',
                username: ''
            }
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this 
            axios.post('/my-feeds/username')
            .then(function(response) {
                response => this.thedata = response.data,
                self.friends = response.data[0],
                self.startups = response.data[1],
                self.username = response.data[2],
                self.loading = false,
                self.loaded = true,
                responsive();
                }); 
        },
        methods: {
            postedOn(startup) {
                return moment(startup.created_at).fromNow();
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

