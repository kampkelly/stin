<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <div class="container-fluid" v-show="loaded">
            <div>
                 <form action="/upload_profile_pic" method="post" enctype="multipart/form-data" id="formId_profilepage" style="position: relative;" v-if="user.id == auth.id">
                    <div id="csval"></div>

                    <img :src="'uploads/profile-pic/' + user.image" class="img-responsive img-rounded oval show-only-smartphone">
                     <img :src="'uploads/profile-pic/' + user.image" class="img-responsive img-rounded oval hide-smartphone">
                    <span class="glyphicon glyphicon-camera" style="color: white; position: absolute; font-size: 150%; top: 100; margin-top:40px; left: 9%; z-index:90; cursor:pointer;"></span>
                      <input type="file" id="my_file_profilepage" name="my_file" style="position: absolute; bottom: 200; margin-top:30px; cursor:pointer; font-size: 200%; opacity: 0.001; width:20%; z-index:91;"/>
                </form>
                <div v-else>
                    <img :src="'uploads/profile-pic/' + user.image" class="img-responsive img-rounded oval show-only-smartphone">
                     <img :src="'uploads/profile-pic/' + user.image" class="img-responsive img-rounded oval hide-smartphone">
                </div>
                <a :href="'uploads/profile-pic/' + user.image" target="blank">View photo</a>

                 <img :src="'uploads/profile-pic/' + user.image" class="img-responsive img-rounded oval show-only-smartphone" style="display: none;">
                 <img :src="'uploads/profile-pic/' + user.image" class="img-responsive img-rounded oval" style="display: none;">
                 <h4 v-if="auth.id == user.id"><span style="font-size: 80%;">You are viewing</span> your <span style="font-size: 80%;">Profile</span></h4>
                 <h4 v-else><span style="font-size: 80%;">You are viewing</span> {{user.fullname}}'s <span style="font-size: 80%;">Profile</span></h4>
                 <p><b>Bio:</b> {{user.bio}}<br>
                    <b>Interests:</b> {{user.interests}}<br>
                 </p>
                  <p class="text-center sent-message btn btn-success btn-md" v-show="showrequestmessage" style="color: white; visibility: visible; position: fixed; top: 100px; left: 10%; z-index: 10;">{{sent}}</p> <!--connection sent message-->
                 <div v-if="auth.id != user.id">
                  <div v-if="isfriend === true">
                        <router-link tag="a" :to="'/innovator/profile/' + user.username" class="btn btn-primary btn-xs">
                        <a  style="text-transform: none; color: white !important; margin-right: 2px;">Message</a>
                        </router-link>
                        <a class="btn btn-warning btn-xs pul-right" href="#" style="text-transform: none; color: white !important; margin-right: 2px;" v-on:click.prevent="removeconnect($event, '/unconnect_friend/' + friend.username)">Unconnect</a><a class="btn btn-danger btn-xs pull-riht" href="/unfollow_friend/username" style="text-transform: none; color: white !important; display:none;" v-on:click.prevent="blockconnect($event, '/block_friend/' + friend.username)">Block</a>
                        <a  style="text-transform: none; color: green !important; margin-right: 2px; cursor:pointer;" id="showthread_form" v-if="isfriend === true">Create new thread with {{user.fullname}}</a>
                        <form action="/messages" method="POST" class="form-horizontal" role="form" style="display:none;" id="threadformshow">
                            <p v-if="threads >= 1">You have an open thread with {{user.fuulname}}, message with it 
                             <router-link tag="a" :to="user.username +'/threads'">
                                <a>here</a>
                            </router-link>,
                            or create a new one below</p>
                        <div id="csvalone"></div>
                         <div class="form-group">
                                <label for="title" class="control-label">Thread Title</label>
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Thread Title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message" class="control-label">Message</label>
                                <div class="col-sm-10 col-sm-offset-2">
                                    <textarea name="message" id="message" class="form-control" rows="5" style="resize:none;" placeholder="Enter Message"></textarea>
                                </div>
                            </div>
                            <input type="text" name="user_id" :value="user.id" hidden="true">
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <button type="submit" class="btn btn-primary btn-block">Send</button>
                                </div>
                            </div>
                        </form>
                  </div>
                  <div v-else>
                    <!--request-->
                    <div v-if="friendrequestfrom === true">
                        {{user.fullname}} sent you a request
                                <a :href="theurl" class="btn btn-info btn-xs small" v-on:click.prevent="acceptconnect($event, '/accept_request/' + user.username)">Accept Request</a> <a :href="theurl" class="btn btn-warning btn-xs small" v-on:click.prevent="rejectconnect($event, '/reject_request/' + user.username)">Reject Request</a>
                    </div>
                    <div v-else-if="sentfriendrequest == true">
                        <span class="text-warning">You have sent a friend request to {{user.fullname}}</span>
                    </div>
                    <div v-else>
                        <a class="btn btn-success btn-xs pul-right" :href="theurl" v-on:click.prevent="show($event)" style="text-transform: none; color: white !important; margin-right: 2px; cursor:pointer;">Connect With {{user.fullname}}</a>
                        <a class="btn btn-success btn-xs pul-right" :href="theurl" v-on:click.prevent="sendconnect($event, '/connect/' + user.username + '/' + connectform_message)" style="text-transform: none; color: white !important; margin-right: 2px; cursor:pointer; display: none;">Send Connect</a>
                  </div>
                  <!--request-->
                </div> 
            </div>
            <div style="height:40px;"></div>
                
                <div id="viewmore_div">  <!--view more-->
                    <p id="viewmore" class="text-center text-primary" style="background-color: lightgrey; border-bottom: 6px solid darkgrey; border-radius: 2%; cursor: pointer;">View More</p>
                    <p id="hidemore" class="text-center text-primary" style="background-color: lightgrey; border-bottom: 6px solid darkgrey; border-radius: 2%; cursor: pointer; display: none;">Hide</p>
                </div>
                <div id="expand_profile" style="disply: none;">
                    <h4>Address</h4>
                    <ul class="list-unstyled" style="padding-left: 40px;">
                        <div v-if="auth.is_permission == 4">
                            <li><p class="small">Address: {{user.address}}</p></li>
                            <li><p class="small">State: {{user.state}}</p></li>
                        </div>
                        <li><p class="small">Country: {{user.country}}</p></li>
                    </ul>
                    <h4>Social</h4>
                    <ul class="list-unstyled social" style="padding-left: 40px; padding-right: 40px;">
                        <li><span class="btn disabled">Website(s):</span> <i class="small">{{user.website}}</i> </li>
                        <li><span class="btn  disabled">Facebook:</span> <i class="small">{{user.facebook}}</i> </li>
                        <li><span class="btn disabled">Twitter:</span> <i class="small">{{user.twitter}}</i></li>
                        <li><span class="btn disabled">Linkedin:</span> <i class="small">{{user.linkedin}}</i></li>
                    </ul>
                </div>
                                        <!--view more-->
            <div v-if="auth.id != user.id">
                 <h4>({{countuserfriends}}) connections</h4> 
                 <h4>Mutual Connections ({{countmutualfriends}})</h4> 
                 <div v-if="countmutualfriends >= 1">  <!--mutualconnections-->
                    <ul class="list-unstyled list-inline" id="scrolly">
                        <li v-for="mutual in mutual_friends" class="suggest panel">
                               <h5>
                                    <router-link tag="a" :to="'/innovator/profile/' + mutual.username">
                                        {{mutual.fullname}}
                                    </router-link>
                               </h5>
                                <img :src="'uploads/profile-pic/' + mutual.image" class="img-responsive img-thumbnail" style="height: 60px;" width="90%" v-if="mutual.image == Null">
                            <div v-else>
                                    <img src="man.png" class="img-responsive img-thumbnail" style="height: 60px;" width="90%" v-if="mutual.gender == 'Male'">
                                    <img src="woman.jpg" class="img-responsive img-thumbnail" style="height: 60px;" width="90%" v-else>
                            </div>
                            <p class="smallest-font text-justify" style="font-size: 70%;">{{mutual.bio}}</p>
                        </li>

                    </ul>
                 </div>    <!--mutualconnections-->
            </div>  
            <div v-else>
                <h4>You have ({{countuserfriends}}) connections</h4> 
            </div>                          
                 <h4 class="text-center">Innovations</h4>       <!--innovations-->
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
                                              </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>                                               <!--innovations-->
                <h4 class="text-center">Videos</h4> 
                <div class="row" v-if="countyoutubevideos >= 1">
                     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" v-for="video in youtubevideos">
                            <iframe width="100%" height="250" :src="'https://www.youtube.com/embed/' + video.video_id" frameborder="0" allowfullscreen></iframe>
                            <p class="sm-medium-font"> <span style="text-decoration: underline;">Title:</span> {{video.title}}<br>
                            <span style="text-decoration: underline;">Description:</span> {{video.description}}</p>
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
var csr;
    export default {
        data() {
            return {
                threads: [],
                loading: '',
                loaded: '',
                auth: '',
                user: '',
                users: '',
                authfriends: '',
                userfriends: '',
                mutual_friends: '',
                startups: '',
                youtubevideos: '',
                threads: '',
                requests: '',
                isfriend: '',
                friendrequestfrom: '',
                sentfriendrequest: '',
                countrequests: '',
                countstartups: '',
                countauthfriends: '',
                countuserfriends: '',
                countmutualfriends: '',
                countyoutubevideos: '',
                showrequestmessage: false,
                connectform_message: 'the message',
                sent: ''

            }
        },
        beforeRouteUpdate: function(to, from, next) {
            console.log("beforeRouteCreate");
            next();
        //    showmore();
            this.fetchData();
        }, 
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this,
       //     showmore();
            this.fetchData();
        },
        methods: {
             fetchData () {
                axios.post('/myprofile/' + this.$route.params.username)
                .then(function(response) { 
                console.log(response.data[1]),
                self.threads = response.data[0],
                self.auth = response.data[0],
                self.user = response.data[1],
                self.users = response.data[2],
                self.authfriends = response.data[3],
                self.userfriends = response.data[4],
                self.mutual_friends = response.data[5],
                self.startups = response.data[6],
                self.youtubevideos = response.data[7],
                self.threads = response.data[8],
                self.requests = response.data[9],
                self.isfriend = response.data[10],
                self.friendrequestfrom = response.data[11],
                self.sentfriendrequest = response.data[12],
                self.countstartups = response.data[6].length,
                self.countauthfriends = response.data[3].length,
                self.countuserfriends = response.data[4].length,
                self.countmutualfriends = response.data[5].length,
                self.countyoutubevideos = response.data[7].length,
                self.countrequests = response.data[9].length,
                console.log(response.data[11]),
                console.log(response.data[12]),
              //  response => this.categories = response.data,
                self.loading = false,
                self.loaded = true,
                responsive();
                csr = document.getElementById('csrf').innerHTML,
                console.log(csr),
                document.getElementById('csval').innerHTML= csr,
                document.getElementById('csvalone').innerHTML= csr,
                console.log(document.getElementById('csvalone').innerHTML)
                }); 
            },
            //connection events
            show(e) {
                let clickedElement;
                clickedElement = e.currentTarget;
                var connectform_message;
                self = this,
                    swal({
                              //width: 500,
                              background: '#FAFAFA',
                             // input: 'text',
                          html: `<h3>Connect with ${self.user.fullname} ${self.connectform_message}</h3>
                          <h4>Send a message (optional)</h4>
                <textarea name="messa" id="messa" resize="none" rows="2" class="form-control"></textarea>`,
                        confirmButtonText: 'Send Connect!',
                        confirmButtonColor: 'green',
                        showCloseButton: true,
                        focusConfirm: false,
                        })
                    .then(function () {
                        connectform_message = $('#messa').val();
                    var connecturl = `/connect/${self.user.username}/${connectform_message}`; 
                    self.sendconnect(clickedElement, connecturl);
              })
            },
            sendconnect(e, connecturl) {
                let clickedElement;
                clickedElement = e.currentTarget;  //set clickedelement to the element that trigerred this function
                clickedElement = e;  //set clickedelement to the element that trigerred this function
                self = this,
               axios({ 
                  method: 'post',
                  url: connecturl
                })
               .then(function(response) { 
                  self.sent = 'Connection Request Sent!',
               //   self.sent = response.data,
                  self.showrequestmessage = true,
                  $(clickedElement).text('request sent');
                  $(clickedElement).attr("disabled", true);  
                  $('#messa').val() == '';
                  setTimeout(function(){   //timeout
                       self.showrequestmessage = false
                    }, 7000); 
               }); 
            },
            acceptconnect(e, connecturl) {
                let clickedElement;
                clickedElement = e.currentTarget;  //set clickedelement to the element that trigerred this function
                self = this,
               axios({ 
                  method: 'post',
                  url: connecturl
                })
               .then(function(response) { 
                  self.sent = 'You have accepted this connection!',
                  self.showrequestmessage = true,
                  $(clickedElement).text('connection accepted');
                  $(clickedElement).attr("disabled", true);  
                  setTimeout(function(){   //timeout
                       self.showrequestmessage = false
                    }, 7000);
               }); 
            },
            rejectconnect(e, connecturl) {
                let clickedElement;
                clickedElement = e.currentTarget;  //set clickedelement to the element that trigerred this function
                self = this,
               axios({ 
                  method: 'post',
                  url: connecturl
                })
               .then(function(response) { 
                  self.sent = 'You rejected this connection!',
                  self.showrequestmessage = true,
                  $(clickedElement).text('connection rejected');
                  $(clickedElement).attr("disabled", true);  
                  setTimeout(function(){   //timeout
                       self.showrequestmessage = false
                    }, 7000);
               }); 
            },
            removeconnect(e, connecturl) {
                let clickedElement;
                clickedElement = e.currentTarget;  //set clickedelement to the element that trigerred this function
                self = this,
               axios({ 
                  method: 'post',
                  url: connecturl
                })
               .then(function(response) { 
                  self.sent = 'Connection removed!',
                  self.showrequestmessage = true,
                  $(clickedElement).text('connection removed');
                  $(clickedElement).attr("disabled", true);  
                  setTimeout(function(){   //timeout
                       self.showrequestmessage = false
                    }, 7000);
               }); 
            },
            blockconnect(e, connecturl) {
                let clickedElement;
                clickedElement = e.currentTarget;  //set clickedelement to the element that trigerred this function
                self = this,
               axios({ 
                  method: 'post',
                  url: connecturl
                })
               .then(function(response) { 
                  self.sent = 'Connection blocked!',
                  self.showrequestmessage = true,
                  $(clickedElement).text('connection blocked');
                  $(clickedElement).attr("disabled", true);  
                  setTimeout(function(){   //timeout
                       self.showrequestmessage = false
                    }, 7000);
               }); 
            },
            //connection events
            postedOn(thread) {
                return moment(thread.created_at).fromNow();
            },
        }
    }
    function showmore() {
    $("#viewmore").click(function(){
                $("#expand_profile").slideDown("slow");
                $("#viewmore").hide();
                $("#hidemore").show();
            });
            $("#hidemore").click(function(){
                $("#expand_profile").slideUp("slow");
                $("#viewmore").show();
                $("#hidemore").hide();
            });
    }

    function responsive() {
        $("#showthread_form").click(function(){
                alert('show thread na');
                $("#threadformshow").slideDown("slow");
            });
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
           $("#viewmore").click(function(){   //////view more slide down
                $("#expand_profile").slideDown("slow");
                $("#viewmore").hide();
                $("#hidemore").show();
            });
            $("#hidemore").click(function(){
                $("#expand_profile").slideUp("slow");
                $("#viewmore").show();
                $("#hidemore").hide();
            });
            
    }

</script>

