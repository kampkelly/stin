<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:92;"></div> 
             <div class="container-fluid" v-show="loaded">
              <div style="height:10px;"></div>
              <h3>Search Innovations</h3>
              <form action="/newsearch" method="POST" role="search" v-on:submit.prevent="search('/newsearch/' + query)">
                  <div id="csval" ref="criteria">k</div>
                  <div class="input-group">
                      <input type="text" class="form-control" name="q"
                          placeholder="Search innovations, people" v-model="query"> <span class="input-group-btn">
                          <button type="submit" class="btn btn-default">
                              <span class="glyphicon glyphicon-search" style="height: 20px;"></span>
                          </button>
                      </span>
                  </div>
              </form>
              <!--startups-->
              <div v-show="searchloading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:45%; left:32%;"></div> 

              <div  v-show="searchloaded" v-if="countstartups < 1">No results found, please try with different keywords.</div>
                 <div class="row" v-show="searchloaded" v-else v-for="(startup, index) in startups">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row pan pan-success">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="text-ceter">
                                <router-link tag="a" v-bind:to="'/innovation/' + startup.slug">
                                    <a>{{ startup.title }}</a>
                                  </router-link>
                                <span class="small"> by {{ startup.group_name }} </span>
                                    <br><span class="smallest-font">Uploaded by: 
                                     <router-link tag="a" :to="'/innovator/profile/' + startup.slug">
                                      <a>{{startup.slug}}</a>
                                    </router-link> 
                                    </span>
                                <span class="small pull-right">{{ postedOn(startup) }}</span><br><span class="small pull-right"><div class="rw-ui-container" v-bind:data-title="startup.id"></div></span></h4>
                                
                                <div class="row cntainer-fluid">
                                    <a v-bind:href="'/startup/' + startup.slug" class="col-xs-12 col-sm-4 col-md-4 col-lg-5">
                                        <img v-bind:src="'uploads/' + startup.image" width="100%" class="img-responsive">
                                    </a>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
                                         <p class="text-center text-justify lead small"><span style="text-decoration: underline; colr: gray !important;"> Brief description:</span> {{ startup.short_desc }} <br>
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
                <small>search by</small> <img src="static-pics/algolia-dark.svg" style="height:30px;">
              <!--startups-->
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
var csr;
    export default {
        data() {
            return {
                startups: [],
                loading: '',
                loaded: '',
                countstartups: '',
                auth: '',
                query: 'Search innovations, people',
                searchloading: false,
                searchloaded: false,

            }
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this 
            axios.post('/list-items')
            .then(function(response) { 
                self.loading = false,
                self.loaded = true,
                responsive();
                csr = document.getElementById('csrf').innerHTML;
                document.getElementById('csval').innerHTML= csr;
                }); 
        },
        methods: {
            search(searchurl) {
              this.searchloading = true,
              this.searchloaded = false,
              self = this 
              axios({ 
                  method: 'post',
                  url: searchurl,
                  data: {
                    qu: self.query
                  }
                })
              .then(function(response) {
                  self.startups = response.data,
                  self.countstartups = response.data.length,
                  self.searchloading = false,
                  self.searchloaded = true,
                  console.log(response.data)
                });  
            },
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

