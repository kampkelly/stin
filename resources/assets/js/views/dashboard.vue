<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <section v-show="loaded">
        <div class="container-fluid">
              <!--if innovator-->
               <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2" >
                          <div id="messagesss" ></div>
                        </div>
                    </div>
                </div>
                <div v-if="auth.is_permission == 0">
                    <h5 class="text-center" style="color: #242525;">Have something interesting? Let the world know, Let people know, Showcase it….</h5><span id="width" style="display: none;"></span>
                     <!--javascript every 1 second set intFrameWidth-->
                    <div class="text-center">
                    <router-link tag="a" to="/innovation/create" class="btn btn-succes newbk btn-lg">
                        <a style="color:white;">Pitch an Innovation</a>
                      </router-link>
                    </div>
                </div>
                <div style="height: 20px;"></div>
              <!--end if innovator-->
                <h4 class="text-center" style="color: gray;">Explore The Categories: See Amazing Startups/Innovations Right Now</h4>
                <div style="height: 20px;"></div>
        </div>
        <div class="row dashboard-category continer-fluid">
        <div class="container-fluid">
              <!--foreach begins-->
              <!--if loop is 4 or 5-->
              
                <div href="#" class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="bacground-color: #003B7D" v-for="(category, index) in categories">
                    <div class="pan panl-default">
                        <div class="panl-headin row">
                            <div class="col-sm-12" style="height:42px; padding-top: 5px;">
                                <h4 class="panel-title text-center"><span>
                                <router-link tag="a" :to="'/category/' + category.id">
                                    <a>{{category.name}}</a>
                                  </router-link>
                                </span></h4>
                            </div>
                            <router-link tag="a" :to="'/category/' + category.id" class="col-sm-12 dashboard_images">
                                <img v-bind:src="'static-pics/categories/' + category.image" width="100%" class="img-responsive" style="cursor:pointer;">
                              </router-link>
                        </div>
                        <div class="pan-body">
                            <h5 class="text-center">{{category.description | truncate(100) }}</h5>
                        </div>
                        <div class="panl-footer">
                            
                        </div>
                    </div>
                    <hr>
                </div>
         
      
            
            
             <!--end if loop is 4 or 5-->
             <!--end foreach begins-->
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
                categories: [],
                auth: '',
                loading: '',
                loaded: ''
            }
        },
        created() {  //fire off ajax request
            this.loading = true,
            this.loaded = false,
            self = this 
            axios.post('/categories_dashboard')
         //   .then(({data}) => this.categories = data);  //object desturcturing syntax in ecma 6(ES2015)
        //    .then(
           //     response => this.categories = response.data,
            .then(function(response) { 
               $(document).scrollTop(1);
                self.categories = response.data[0],
                self.loading = false,
                self.loaded = true,
                self.auth = globalauth,
                responsive()
              //  console.log(this.categories)
                }); 
        },
        methods: {
            postedOn(status) {
                return moment(category.created_at).fromNow();
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

