<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <div class="container-fluid" v-show="loaded">
            <h4>Hi, {{auth.fullname}}, here are the list of your innovations</h4>
                <h3 class="text-center" style="text-decoration: underline;">Innovations</h3>       <!--innovations-->
                 <div v-if="countstartups >= 1">
                    <div class="row" v-for="startup in startups">
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
                                            <img v-bind:src="'uploads/startup_photos/' + startup.image" width="100%" class="img-responsive">
                                        </div>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                             <p class="text-center text-justify"><span style="text-decoration: underline;"> Brief description:</span> {{startup.short_desc}} <br>
                                             <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                                <a>More...</a>
                                              </router-link>
                                              <router-link tag="a" v-bind:to="'/innovation/edit/' + startup.slug" class="btn btn-info btn-xs">
                                                <a style="color:white;">Update</a>
                                              </router-link>

                                              </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> 
                <div <div v-else>
                    <h4>You have not uploaded any innovation(s) yet, 
                     <router-link tag="a" to="/innovation/create">
                        tell us about your innovation
                      </router-link>
                    </h4>
                </div>
                <h4 class="text-center">Videos</h4> 
                <div class="row" v-if="countyoutubevideos >= 1">
                     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" v-for="video in youtubevideos">
                            <iframe width="100%" height="250" :src="'https://www.youtube.com/embed/' + video.video_id" frameborder="0" allowfullscreen></iframe>
                            <p class="sm-medium-font"> <span style="text-decoration: underline;">Title:</span> {{video.title}}<br>
                            <span style="text-decoration: underline;">Description:</span> {{video.description}}</p>
                    </div>
                </div>
                <div <div v-else>
                    <h4>You have not uploaded any videos yet,  
                        <router-link tag="a" to="/innovation/create">
                        tell us about your innovation
                      </router-link>
                    and you can upload a video while doing so!</h4>
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
                loading: '',
                loaded: '',
                auth: '',
                startups: '',
                youtubevideos: '',
                countstartups: '',
                countyoutubevideos: ''
            }
        },
        beforeRouteUpdate: function(to, from, next) {
            console.log("beforeRouteCreate");
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
                axios.post('/person/' + this.$route.params.username)
                .then(function(response) { 
                self.auth = response.data[0],
                self.startups = self.auth.startups,
                self.youtubevideos = response.data[2],
                self.countstartups = self.auth.startups.length,
                self.countyoutubevideos = response.data[2].length,
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

