<template>
<div class="col-xs-2 col-sm-12 col-md-8 col-lg-8 col-xl-7 second-row" id="secondDiv" style="padding-top: 70px; margin-right: 0px !important;">
        <div>
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
             <h5 class="text-center">All Innovations</h5>
                <h5 class="text-center">Explore Our Innovations: See What Is Happenning Right Now</h5>
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
             <div class="container-fluid startups" v-show="loaded">
                    
               <!--suggestions-->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                </div>
               <!--suggestions-->
                 &nbsp; &nbsp; <input type="radio" name="featured" value="all" v-model="featured" id="featuredall"> <label for="featuredall" style="cursor:pointer;"><b>All</b></label> &nbsp; &nbsp;
    <input type="radio" name="featured" value="1" v-model="featured" id="featured1"> <label for="featured1" style="cursor:pointer;"><b>Featured</b></label> &nbsp; &nbsp;
    <input type="radio" name="featured" value="0" v-model="featured" id="featured0"> <label for="featured0" style="cursor:pointer;"><b>Pitched</b></label> &nbsp; &nbsp;
               <div id="shownewinnovation"></div>
                <p v-if="countstartups < 1">There are no innovations here. Be the first,
                <router-link tag="a" to="/innovation/create">
                    <a>Add one now</a>
                </router-link>
                                       <!--if startups is less than 0 ends-->

                <div class="row" v-else v-for="(startup, index) in startups">
                  <div v-if="featured == 'all'">  <!--begins here-->
                    <div v-if="startup.featured == 'yes'">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="text-ceter">
                                <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                    <a>{{ startup.title }}</a>
                                  </router-link>
                                <span class="small"> by TheInnovestors </span> 
                                    <br><span class="smallest-font">Uploaded by: TheInnovestors
                                    </span>
                                <span class="small float-right"> <span style="color:#27AD60;">Featured</span> {{ postedOn(startup) }}</span><br><span class="small pull-right"><div class="rw-ui-container" v-bind:data-title="startup.id"></div></span></h4>
                                
                                <div class="row cntainer-fluid">
                                   
                                    <router-link tag="a" v-bind:to="'/innovation/' + startup.slug" class="col-xs-12 col-sm-3 col-md-4 col-lg-5">
                                        <img v-bind:src="'uploads/startup_photos/' + startup.image" width="100%" class="img-responsive">
                                    </router-link>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                         <p class="text-justify"><span style="text-decoration: underline; colr: gray !important;"> Brief description:<br></span> <span v-html="$options.filters.truncate(startup.short_desc, 150)"></span><br>
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
                <div v-if="startup.featured == 'no'">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3">
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
                                <span class="small float-right">{{ postedOn(startup) }}</span><br><span class="small float-right"><div class="rw-ui-container" v-bind:data-title="startup.id"></div></span></h4>
                                
                                <div class="row cntainer-fluid">
                                   
                                    <router-link tag="a" v-bind:to="'/innovation/' + startup.slug" class="col-xs-12 col-sm-4 col-md-4 col-lg-5">
                                        <img v-bind:src="'uploads/startup_photos/' + startup.image" width="100%" class="img-responsive">
                                    </router-link>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                         <p class="text-justify lead"><span style="text-decoration: underline; colr: gray !important;"> Brief description:</span> {{ startup.short_desc }} <br>
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
              </div> <!--ends here-->
        
 
                    <div v-if="featured == 1 && startup.featured == 'yes'"> <!--begins here-->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3">
                        <div class="row pan pan-success">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="text-ceter">
                                <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                    <a>{{ startup.title }}</a>
                                  </router-link>
                                <span class="small"> by TheInnovestors </span>
                                    <br><span class="smallest-font">Uploaded by: TheInnovestors
                                    </span>
                                <span class="small float-right"> <span style="color:#27AD60;">Featured</span> {{ postedOn(startup) }}</span><br><span class="small float-right"><div class="rw-ui-container" v-bind:data-title="startup.id"></div></span></h4>
                                
                                <div class="row cntainer-fluid">
                                   
                                    <router-link tag="a" v-bind:to="'/innovation/' + startup.slug" class="col-xs-12 col-sm-4 col-md-4 col-lg-5">
                                        <img v-bind:src="'uploads/startup_photos/' + startup.image" width="100%" class="img-responsive">
                                    </router-link>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                         <p class="text-justify lead"><span style="text-decoration: underline; colr: gray !important;"> Brief description:</span>  <span v-html="$options.filters.truncate(startup.short_desc, 150)"></span> <br>
                                          <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                            <a>More...</a>
                                          </router-link>
                                          </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> <!--ends here-->

 
                    <div v-if="featured == 0 && startup.featured == 'no'"> <!--begins here-->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3">
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
                                        <img v-bind:src="'uploads/startup_photos/' + startup.image" width="100%" class="img-responsive">
                                    </router-link>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                         <p class="text-justify lead"><span style="text-decoration: underline; colr: gray !important;"> Brief description:</span> {{ startup.short_desc }} <br>
                                          <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                            <a>More...</a>
                                          </router-link>
                                          </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> <!--ends here-->
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
     
       <!---scroll stuffs-->
        <h3 id="add_all_here"></h3>
        <div style="height:0px;" id="space"></div>
        <img src="/Ellipsis.svg" class="w-100" v-show="still_adding" style="height: 3.35em;">
        <i class="fa fa-arrow-down" style="height: 20px; color: grey; margin-left:40px;" aria-hidden="true" id="outside_view" v-show="not_finished"></i>
       <!---scroll stuffs-->
        </section>
    </div> 
</div>
</template>


<script>
import moment from 'moment';
 var additional_innovations;
    export default {
        data() {
            return {
                startups: [],
                loading: '',
                loaded: '',
                countstartups: '',
                featured: 'all',
                x: 0,
                y: 2,
                not_finished: true,
                still_adding: false,
                shuu: ''
            }
        },
         beforeRouteLeave (to, from, next) {
             $('.third-column').show();
             next();
            // called when the route that renders this component is about to
            // be navigated away from.
            // has access to `this` component instance.
          },
        watch: {
            featured: function (nw) {
              if(nw == 'all') {
                     $('.i_am_featured').show(); 
                     $('.i_am_pitched').show(); 
                 } if(nw == 1) {
                     $('.i_am_featured').show(); 
                     $('.i_am_pitched').hide(); 
                 }  if(nw == 0) {
                     $('.i_am_featured').hide(); 
                     $('.i_am_pitched').show(); 
                 }
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
                self.not_finished = response.data[2],
                console.log(self.startups),
                console.log(response.data[1]),
                self.loading = false,
                self.loaded = true
                responsive();
                innovation_notification();
                }); 
        },
        mounted: function() {
            var vueInstance = this
             var wh = window.outerWidth;
              if (wh <= 768) {
                $('.third-column').hide();
              }else{ $('.third-column').show(); }
            var elem = document.getElementById('outside_view')
            var add_here = document.getElementById('add_all_here')
            var space = document.getElementById('space')
            var watcher = scrollMonitor.create(elem)
          //  watcher.enterViewport(function() {
            watcher.fullyEnterViewport(function() {
              //  alert('scrolled down');
            $('body').addClass('stop-scrolling');
                     //    $(space).hide();
                      
                         // $(space).show();
                         //adding(this.x, this.y);
            vueInstance.x = vueInstance.x + 2,
            vueInstance.y = 2,
            self.still_adding = true
         //   axios.post('/moreinnovations/' + xx + '/' + this.x)
            axios.post(`/moreinnovations/${vueInstance.x}/${vueInstance.y}`)
                .then(function(response) {
                self.not_finished = response.data[1],
                self.still_adding = false
                 additional_innovations = response.data[0];
                    additional_innovations.forEach(function(an_innovation) {
                        console.log(an_innovation);
                        append_featured_innovation(an_innovation, add_here);
                        append_pitched_innovation(an_innovation, add_here);
                    });
                    
            }); 
                 $('body').removeClass('stop-scrolling');
              })
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
       window.Echo = new Echo({
                       broadcaster: 'pusher',
                       key: 'ddc158fa13ebad9c3fdf',
                       cluster: 'us2',
                       encrypted: true
                  }); 
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
                                                <img src="uploads/startup_photos/${e.innovation.image}" width="100%" class="img-responsive">
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
      window.addEventListener("resize", myFunction);

    function myFunction() {
        var wh = window.outerWidth;
            if (wh <= 768) {
              $('.third-column').hide();
            }else{ $('.third-column').show(); }
    }
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

    function append_featured_innovation(an_innovation, add_here) {
        if(an_innovation.featured == 'yes') {
           $(add_here).append(
                  `
                    <div class="row startups container-fluid" id="${an_innovation.slug}">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3 i_am_featured">
                            <div class="row pan pan-success">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <h6 class="text-ceter">
                                    <router-link tag="a" to="/dashboard#/innovation/${an_innovation.slug}">
                                        <a>${an_innovation.title}</a>
                                      </router-link>
                                    <span class="small"> by TheInnovestors </span>
                                        <br><span class="smallest-font">Uploaded by: 
                                       TheInnovestors
                                        </span>
                                    <span class="small float-right">`
                                   //  ${ an_innovation.featured == 'yes' ? '<b class="text-success">Newer</b>': '' }
                                     + (an_innovation.featured == 'yes' ? '<b class="text-success">Featured</b>': '') +
                                 //   <b class="text-success" v-if="${an_innovation.featured} == 'yes'">Neww</b>
                                   `  ${moment(an_innovation.created_at).fromNow()}</span><br><span class="small float-right"><div class="rw-ui-container" data-title="${an_innovation.id}"></div></span></h6>
                                    
                                    <div class="row cntainer-fluid">
                                        <a href="/dashboard#/innovation/${an_innovation.slug}" class="col-xs-12 col-sm-3 col-md-4 col-lg-5">
                                            <img src="uploads/startup_photos/${an_innovation.image}" width="100%" class="img-fluid">
                                        </a>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                             <p class="text-justify" style="font-size:45%;"><span style="text-decoration: underline; colr: gray !important;"> Brief description:<br></span>  ${truncateString(an_innovation.short_desc, 200)} <br>
                                             <router-link tag="a" to="/dashboard#/innovation/${an_innovation.slug}">
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
       }
    }
    
    function append_pitched_innovation(an_innovation, add_here) {
        if(an_innovation.featured == 'no') {
           $(add_here).append(
                  `
                    <div class="row startups container-fluid" id="${an_innovation.slug}">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3 i_am_pitched">
                            <div class="row pan pan-success">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <h6 class="text-ceter">
                                    <router-link tag="a" to="/dashboard#/innovation/${an_innovation.slug}">
                                        <a>${an_innovation.title}</a>
                                      </router-link>
                                    <span class="small"> by ${an_innovation.group_name} </span>
                                        <br><span class="smallest-font">Uploaded by: 
                                        <router-link tag="a" to="/innovator/profile/${an_innovation.user.username}">
                                          <a>${an_innovation.user.fullname}</a>
                                        </router-link>
                                        </span>
                                    <span class="small float-right">`
                                   //  ${ an_innovation.featured == 'yes' ? '<b class="text-success">Newer</b>': '' }
                                     + (an_innovation.featured == 'no' ? '<b class="text-success">Pitched</b>': '') +
                                 //   <b class="text-success" v-if="${an_innovation.featured} == 'yes'">Neww</b>
                                   `  ${moment(an_innovation.created_at).fromNow()}</span><br><span class="small float-right"><div class="rw-ui-container" data-title="${an_innovation.id}"></div></span></h6>
                                    
                                    <div class="row cntainer-fluid">
                                        <a href="/dashboard#/innovation/${an_innovation.slug}" class="col-xs-12 col-sm-3 col-md-4 col-lg-5">
                                            <img src="uploads/startup_photos/${an_innovation.image}" width="100%" class="img-fluid">
                                        </a>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                             <p class="text-justify" style="font-size:45%;"><span style="text-decoration: underline; colr: gray !important;"> Brief description:<br></span>  ${truncateString(an_innovation.short_desc, 200)} <br>
                                             <router-link tag="a" to="/dashboard#/innovation/${an_innovation.slug}">
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
        }
    }
    function truncateString(str, num) {
      if (str.length <= num) {
        return str;
      } else {
        return str.slice(0, num > 3 ? num - 3 : num) + '...';
      }
    }
</script>

