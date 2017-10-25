<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
             <h4 class="text-center">All Recent Startups</h4>
                <h4 class="text-center">Explore Our Innovations: See What Is Happenning Right Now</h4>
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
             <div class="container-fluid startups" v-show="loaded">
                   
               <!--suggestions-->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                </div>
               <!--suggestions-->
               <div id="shownewinnovation"></div>
                <p v-if="countstartups < 1">There are no innovations here. Be the first,
                <router-link tag="a" to="/innovation/create">
                    <a>Add one now</a>
                </router-link>
                                       <!--if startups is less than 0 ends-->
                    <div class="row" v-else v-for="(startup, index) in startups">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row pan pan-success">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="text-ceter">
                                <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                    <a>{{ startup.title }}</a>
                                  </router-link>
                                <span class="small"> by {{ startup.group_name }} </span>
                                    <br><span class="smallest-font">Uploaded by: 
                                     <router-link tag="a" :to="'/innovator/profile/' + startup.user.username">
                                      <a>{{startup.user.fullname}}</a>
                                    </router-link> 
                                    </span>
                                <span class="small pull-right">{{ postedOn(startup) }}</span><br><span class="small pull-right"><div class="rw-ui-container" v-bind:data-title="startup.id"></div></span></h4>
                                
                                <div class="row cntainer-fluid">
                                   
                                    <router-link tag="a" v-bind:to="'/innovation/' + startup.slug" class="col-xs-12 col-sm-4 col-md-4 col-lg-5">
                                        <img v-bind:src="'uploads/' + startup.image" width="100%" class="img-responsive">
                                    </router-link>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                         <p class="text-center text-justify lead"><span style="text-decoration: underline; colr: gray !important;"> Brief description:</span> {{ startup.short_desc }} <br>
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
                <hr>
                   <!--if loop is 2-->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                         <!--suggestions-->
                    </div>
                     <!--if loop is 2 ends-->
                
                 <div id="messages" ></div>
            <!--LOOP ENDS--> 
                <div class="text-center"> 
                    <!--PAGINATION LINKS-->
                       
                    <!--PAGINATION LINKS-->
                </div>
                <!--piwik code for srotsevon...... -->
         <!--   <iframe src="http://srotsevonni-piwik.tk/index.php?module=Widgetize&action=iframe&moduleToWidgetize=Dashboard&actionToWidgetize=index&idSite=1&period=week&date=yesterday&token_auth=15b26b459f8874b5f45d9a6c0d752c05&output=embed" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%"></iframe>  -->

            </div>
     
        <div class="text-center"> 
             <!--paginate links-->
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
                startups: [],
                loading: '',
                loaded: '',
                countstartups: ''
            }
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this 
            axios.post('/innovations')
            .then(function(response) { 
                self.startups = response.data[0],
                self.countstartups = response.data[0].length,
                console.log(self.startups),
                console.log(response.data[1]),
                self.loading = false,
                self.loaded = true
                responsive();
                innovation_notification();
                }); 
        },
        methods: {
            postedOn(startup) {
                return moment(startup.created_at).fromNow();
            }
        }
    }

import Pusher from 'pusher-js'
import Echo from "laravel-echo"
//require('jquery')
    function innovation_notification() {
         window.Echo.channel('innovationadded')
            .listen('InnovationCreated', (e) => {
                $( "#shownewinnovation" ).prepend(
                        `<div class="row" id="${e.innovation.slug}" style="display:none;">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row pan pan-success">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <h4 class="text-ceter">
                                        <router-link tag="a" to="/dashboard#/innovation/${e.innovation.slug}">
                                            <a>${e.innovation.title}</a>
                                          </router-link>
                                        <span class="small"> by ${e.innovation.group_name} </span>
                                            <br><span class="smallest-font">Uploaded by: 
                                             <router-link tag="a" to="/innovator/profile/${e.user.username}">
                                              <a>${e.user.fullname}</a>
                                            </router-link> 
                                            </span>
                                        <span class="small pull-right"><b class="text-success">New</b> ${moment(e.innovation.created_at).fromNow()}</span><br><span class="small pull-right"><div class="rw-ui-container" data-title="${e.innovation.id}"></div></span></h4>
                                        
                                        <div class="row cntainer-fluid">
                                            <a href="/dashboard#/innovation/${e.innovation.slug}" class="col-xs-12 col-sm-4 col-md-4 col-lg-5">
                                                <img src="uploads/${e.innovation.image}" width="100%" class="img-responsive">
                                            </a>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                                 <p class="text-center text-justify lead"><span style="text-decoration: underline; colr: gray !important;"> Brief description:</span> ${e.innovation.short_desc} <br>
                                                  <router-link tag="a" to="/dashboard#/innovation/${e.innovation.slug}">
                                                    <a>More...</a>
                                                  </router-link>
                                                  </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    `
                );
                $('#' + e.innovation.slug).fadeIn(4000);
             });
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

