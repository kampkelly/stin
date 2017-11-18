<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
             <div class="container-fluid startups" v-show="loaded">
                    <h4 class="text-center">{{category.name}}</h4>
                    <h4 class="text-center"><small>{{category.description}}</small></h4>
                    &nbsp; &nbsp; <input type="radio" name="featured" value="all" v-model="featured" id="featuredall"> <label for="featuredall" style="cursor:pointer;">All</label> &nbsp; &nbsp;
                    <input type="radio" name="featured" value="1" v-model="featured" id="featured1"> <label for="featured1" style="cursor:pointer;">Featured</label> &nbsp; &nbsp;
                    <input type="radio" name="featured" value="0" v-model="featured" id="featured0"> <label for="featured0" style="cursor:pointer;">Pitched</label> &nbsp; &nbsp;
                    <div v-if="countstartups < 1" style="height:90vh;">
                        <p >There are no innovations here. Be the first, 
                            <router-link tag="a" to="/innovation/create">
                                <a>Add one noww</a>
                              </router-link>
                        </p>
                     </div>
                <div class="row" v-else v-for="(startup, index) in startups">
                  <div v-if="featured == 'all'">  <!--begins here-->
                    <div v-if="startup.featured == 'yes'">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row pan pan-success">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="text-ceter">
                                <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                    <a>{{ startup.title }}</a>
                                  </router-link>
                                <span class="small"> by TheInnovestors </span> 
                                    <br><span class="smallest-font">Uploaded by: TheInnovestors
                                    </span>
                                <span class="small pull-right"> <span style="color:#27AD60;">Featured</span> {{ postedOn(startup) }}</span><br><span class="small pull-right"><div class="rw-ui-container" v-bind:data-title="startup.id"></div></span></h4>
                                
                                <div class="row cntainer-fluid">
                                   
                                    <router-link tag="a" v-bind:to="'/innovation/' + startup.slug" class="col-xs-12 col-sm-4 col-md-4 col-lg-5">
                                        <img v-bind:src="'uploads/startup_photos/' + startup.image" width="100%" class="img-responsive">
                                    </router-link>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                         <p class="text-center text-justify lead"><span style="text-decoration: underline; colr: gray !important;"> Brief description:</span> <span v-html="$options.filters.truncate(startup.short_desc, 150)"></span><br>
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
                                        <img v-bind:src="'uploads/startup_photos/' + startup.image" width="100%" class="img-responsive">
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
              </div> <!--ends here-->
        
 
                    <div v-if="featured == 1 && startup.featured == 'yes'"> <!--begins here-->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row pan pan-success">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="text-ceter">
                                <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                    <a>{{ startup.title }}</a>
                                  </router-link>
                                <span class="small"> by TheInnovestors </span>
                                    <br><span class="smallest-font">Uploaded by: TheInnovestors
                                    </span>
                                <span class="small pull-right"> <span style="color:#27AD60;">Featured</span> {{ postedOn(startup) }}</span><br><span class="small pull-right"><div class="rw-ui-container" v-bind:data-title="startup.id"></div></span></h4>
                                
                                <div class="row cntainer-fluid">
                                   
                                    <router-link tag="a" v-bind:to="'/innovation/' + startup.slug" class="col-xs-12 col-sm-4 col-md-4 col-lg-5">
                                        <img v-bind:src="'uploads/startup_photos/' + startup.image" width="100%" class="img-responsive">
                                    </router-link>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                         <p class="text-center text-justify lead"><span style="text-decoration: underline; colr: gray !important;"> Brief description:</span>  <span v-html="$options.filters.truncate(startup.short_desc, 150)"></span> <br>
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
                                        <img v-bind:src="'uploads/startup_photos/' + startup.image" width="100%" class="img-responsive">
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
                </div> <!--ends here-->
              </div>
                <hr>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                         <!--suggestions-->
                    </div>            
                 <div id="messages" ></div>
            <!--LOOP ENDS--> 
                <div class="text-center"> 
                    <!--PAGINATION LINKS-->
                       
                    <!--PAGINATION LINKS-->
                </div>
            
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
                category: '',
                countstartups: '',
                featured: 'all'
            }
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this 
            this.fetchData()
        },
        methods: {
             fetchData () {
                axios.post('/showcategory/' + this.$route.params.id)
                .then(function(response) { 
                self.startups = response.data[1],
                self.category = response.data[0],
                self.countstartups = response.data[1].length,
                self.loading = false,
                self.loaded = true,
                responsive();
                }); 
            },
            postedOn(startup) {
                return moment(startup.created_at).fromNow();
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

