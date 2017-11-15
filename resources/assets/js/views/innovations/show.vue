<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <div class="container-fluid create-startup" style="padding-left: 0px" v-show="loaded">
                 <div class="container-fluid show-startups">
        <!--STARTUP FIRST-BOX STARTS-->
            <div class="row">
                <div class="container-fluid">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h4 class="text-ceter">{{startup.title}}<span class="small"> by {{startup.group_name}}</span>
                        <br><span class="smallest-font">Uploaded by: 
                         <router-link tag="a" :to="'/innovator/profile/' + startup.user.username" style="color: #227FBB;">
                              <a>{{startup.user.fullname}}</a>
                            </router-link> 
                        </span>
                        <a :href="'/startup/edit/' + startup.slug" class="pull-right small" style="color: #139DFD; display: none;">Edit</a><br><span class="small pull-right"> <span style="color:#27AD60; font-size:15px;" v-if="startup.featured == 'yes'">Featured</span> {{ postedOn(startup) }}</span><span class="small pull-right"><div class="rw-ui-container" :data-title="startup.id"></div></span></h4>
                        <div id="startup_img" class="panel panel-body">
                            
                            <img :src="'uploads/startup_photos/' + startup.image" class="img-responsive" width="100%" style="height:300px;">
                        </div>
                    </div>
                </div>
            </div> 
            <!--STARTUP FIRST-BOX ENDS-->
            <hr>
            <h4 class="text-center" style="text-decoration: underline;">Description On {{startup.title}}</h4>
            <p style="color: #525252 !important;">{{startup.short_desc}}</p>
            <hr>
            <h4 class="text-center" style="text-decoration: underline;">Aim:</h4>
            <p class="text-justify">{{startup.aim}}</p>
            <hr>
            <h4 class="text-center" style="text-decoration: underline;">Why It's Important:</h4>
            <p class="text-justify">{{startup.importance}}</p>
            <hr>
            <h4 class="text-center" style="text-decoration: underline;">Features</h4>
            <ul class="text-center list-unstyled">
                <li class="text-center">{{startup.feature}}</li> 
            </ul>
            <hr>
            <h4 class="text-center" style="text-decoration: underline;">Explanatory Images</h4>
                <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 more-images" v-if="startupsphotoslen >= 1" v-for="startupsphoto in startupsphotos">
                             <img :src="'uploads/startup_photos/' + startupsphoto.filename" class="img-responsive" width="100%">
                                 <form :action="'/startup/' + startup.id + '/image-deleted'" method="post" value="DELETE" role="form" v-if="auth.id == startup.user_id">
                                 <!--csrf field-->
                                 <input type="hidden" name="_token" :value="csrf">
                                 
                                 <input type="text" name="photo_id" :value="startupsphoto.id" hidden="true">
                                 <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                 </form> 
                        </div>
                    <h4 class="text-warning" v-else>No images here!</h4>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <br>
                    <form :action="'/startup/' + startup.slug + '/photo_added'" method="post" value="PUT" class="form-horizontal" role="form" files="true" enctype="multipart/form-data" v-if="auth.id == startup.user_id">
                        <input type="hidden" name="_token" :value="csrf">
                    <!--csrf field--> 
                        <div class="form-group">
                            <label for="fileupload" class="control-label">Add image(s) (can attach multiple):</label>
                            <div class="col-sm-10 col-sm-offset-2">
                             <input type="file" name="photos[]" accept="image/*" class="btn btn-success btn-xs" multiple />
                            </div>
                        </div>
                        <div class="for-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary btn-xs btn-block">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
                <hr>
                <h4 class="text-center" style="text-decoration: underline;">Explanatory Videos</h4>
                            <div class="row" v-if="youtubevideoslen >= 1" v-for="youtubevideo in youtubevideos">
                                 <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <iframe width="100%" height="205" :src="'https://www.youtube.com/embed/' + youtubevideo.video_id" frameborder="0" allowfullscreen></iframe>
                                  <p class="sm-medium-font"> <span style="text-decoration: underline;">Title:</span> {{youtubevideo.title}}<br>
                                    <span style="text-decoration: underline;">Description:</span> {{youtubevideo.description}}</p>
                                 </div>
                            
                                <form action="/video/delete" method="post" value="DELETE" role="form" v-if="auth.id == startup.user_id">
                                     <!--csrf field--> 
                                     <input type="hidden" name="_token" :value="csrf">
                                     <input type="text" name="video_id" :value="youtubevideo.id" hidden="true">
                                     <input type="text" name="youtube_id" :value="youtubevideo.video_id" hidden="true">
                                     <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-xs">
                                </form> 
                            </div>
                        <h4 class="text-warning" v-else>No videos uploaded!</h4>
                    <br>
                        <form action="/videos" method="POST" class="form-horizontal" role="form" files="true" enctype="multipart/form-data" v-if="auth.id == startup.user_id">
                        <!--csrf field-->
                        <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="video" class="col-xs-12 col-sm-4 col-md-10 col-lg-2 control-label">Upload video:</label>
                                    <div class="col-xs-12 col-sm-4 col-md-10 col-lg-4">
                                         <input type="text" name="title" placeholder="title" class="form-control">
                                        <input type="text" name="description" placeholder="video description" class="form-control">
                                         <input type="file" name="video" accept="video/*" class="btn btn-success btn-xs">
                                         <input type="text" name="startup_id" :value="startup.id" hidden="true">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-md-10 col-lg-4 col-lg-offset-2">
                                    <button type="submit" class="btn btn-primary btn-xs btn-block">Upload</button>
                                </div>
                            </div>
                        </form>
                <hr>
                <h4 class="text-center" style="text-decoration: underline;">Notable Achievements</h4>
                <ul class="text-center list-unstyled">
                       <li>{{startup.achievement}}</li>
                </ul>
                <hr>
                <h4 class="text-center">Share
                    <div class="text-center">
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                <span class="small"><a :href="'/connect/' + startup.user.username">Connect</a> with this innovator.</span></h4>
                <div>            
                    <h6 class="text-center">Rate this:</h6><div class="col-xs-8 col-sm-7 col-md-7 col-lg-7 col-xs-offset-4 col-sm-offset-5 col-md-offset-5 col-lg-offset-5"> <div class="rw-ui-container" :data-title="startup.id"></div></div>
                    <div>
                        <h4 class="text-center" style="text-decoration: underline;">Reviews</h4>
                            <div class="col-xs-12 col-sm-8 col-sm-offset-4 comments" style="margin-left: 10px;" v-for="comment in comments">
                                    <ul class="list-unstyled">
                                        <li><h4>{{comment.name}}</h4> <span class="pull-right text-muted small-font">{{ postedOn(comment) }}</span></li>
                                         <li><p class="sm-medium-font">{{comment.comment}}</p></li>
                                    </ul>
                                    
                                       <!--if check permission is admin-->
                            </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="height: 15px;">
                            
                        </div>
                        <form :action="'/startup/' + startup.id + '/comments'" method="post" class="form-horizontal" role="form">
                        <!--csrf field--> 
                        <input type="hidden" name="_token" :value="csrf">
                             <div class="form-group">
                                <label for="comment_name" class="col-sm-2 control-label">Name:</label>
                                <div class="col-sm-5">
                                    <input name="comment_name" id="comment_name" class="form-control" placeholder="Name" style="width: 60%;" required>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="comment" class="col-sm-2 control-label">Review:</label>
                                <div class="col-sm-10">
                                    <textarea name="comment" id="comment" class="form-control" placeholder="Type review" required rows="4" style="width: 90%;"></textarea>
                                </div>
                            </div>
                            <input type="text" name="startup_id" :value="startup.id" hidden="true">
                            <div class="form-group">
                                <label for="input" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-block" style="width: 90%;">Leave Review</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            </div>
     

        </section>
    </div> 
</div>
</template>


<script>
import moment from 'moment';
/*var csr;
csr = document.getElementById('csrf').innerHTML;
var csrf_token = $('meta[name="csrf-token"]').attr('content'); */
    export default {
        data() {
            return {
                categories: [],
                loading: '',
                loaded: '',
                startup: '',
                comments: '',
                startupsphotos: '',
                startupsphotoslen: '',
                youtubevideos: '',
                youtubevideoslen: '',
                auth: '',
                csrf: ''
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
         mounted(){
            this.csrf = window.Laravel.csrfToken
        },
        methods: {
            fetchData () {
                axios.post('/innovation/' + this.$route.params.slug)
                .then(function(response) { 
                self.loading = false,
                self.loaded = true,
                self.startup = response.data[0],
                self.comments = response.data[1],
                self.startupsphotos = response.data[2],
                self.startupsphotoslen = response.data[2].length,
                self.youtubevideos = response.data[3],
                self.youtubevideoslen = response.data[3].length,
                self.auth = response.data[4],
             //   self.csrf = csrf_token;
                responsive();
                }); 
            },
            postedOn(startup) {
                return moment(startup.created_at).fromNow();
            },
            postedOn(comment) {
                return moment(comment.created_at).fromNow();
            },
        }
    }

    function responsive() {
      if ($(window).width() > 1199) {
         $(".first-row").show();
         $("#innovator_top_div").hide(); //innovator profile top div
          $('.first-row').css("position", "fixed");
          $('.second-row').css("margin-left", "16.666667%");
         $('.first-row').css("width", "16.666667%");
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

