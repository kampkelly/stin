<template>
<div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 singlethread" style="padding-left:0px;" >
             <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
                <div class="container-fluid" v-show="loaded">
                 <div class="alert alert-success notifications_panel" role="alert" v-show="status" style="position: fixed; top: 80px; width: 30%; z-index: 60;">
                    {{returnmessage}}
                </div>
                
                <div style="padding-left:40px;" id="divstyle">
                    <router-link tag="a" :to="'/' + auth.username + '/threads'" class="btn btn-primary btn-xs">
                    <a style="color:white; cursor:pointer;"><span class="glyphicon glyphicon-th-list" style="color:white;"></span> Threads</a>
                  </router-link>
                    <h4 class="small text-info" id="viewnewthread" style="cursor: pointer;">Create new thread with {{user.fullname}}<span class="small-font"> (click to show)</span></h4>
                    <h4 class="small text-warning" id="hidenewthread" style="cursor: pointer; display: none;">Create new thread with this {{user.fullname}}<span class="small-font"> (click to hide)</span></h4>
                    <div id="expand_thread" style="display: none;">
                        <form action="/messages" method="POST" class="form-horizontal" role="form">
                        <!--csrf field-->
                         <input type="hidden" name="_token" :value="csrf">
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
                    <h4 class="text-center">Thread - {{thread.title}}</h4>
                  
                    
                    <ul class="list-group row thread_message" style="overflow-y: scroll; max-height:360px; height:360px; padding-bottom:40px; border-top: 1px solid #f2f2f2; border-bottom: 1px solid #f2f2f2;" data-spy="affix" data-offset-top="0">
                        <span v-for="message in messages"> 
                            <li class="list-group-item col-lg-8 col-lg-offset-0" v-if="message.user_id == auth.id"><span class="pull-right smallest-font text-muted">Me; {{ postedOn(message) }}</span><span class="small">{{message.body}}</span></li>
                            <li class="list-group-item col-lg-8 col-lg-offset-4" v-else><span class="pull-right small smallest-font text-muted"> {{user.fullname}}; {{ postedOn(message) }}</span><span class="small">{{message.body}}</span></li>
                            <div style="height:40px;"></div>
                        </span>
                        <div id="usb"></div>
                    </ul>
                      <form :action="'/threads/' + user.username + '/' + thread.slug" method="POST" value="PUT" class="form-horizontal" role="form" v-on:submit.prevent="sendMessage('/threads/' + user.username + '/' + thread.slug)">
                      <!--csrf field-->
                          <div class="form-group">
                              <label for="message" class="control-label" style="display:none;">Reply</label>
                            <div class="input-group col-sm-10 col-sm-offset-2">
                                <input type="text" class="form-control msg" name="message" id="message" v-model="message"
                                placeholder="Type Message"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary send-msg" v-show="messagesend">
                                        <span class="glyphicon glyphicon-send" style="height: 1.35em; color:white;"></span>
                                    </button>
                                    <button class="btn btn-primary btn-block send-msg" v-show="messageloading">
                                      <span class="glyphicon glyphicon-send" style="height: 1.35em; color:white;"></span> <img src="/Ellipsis.svg" style="height: 1.35em;">
                                  </button>
                                </span>
                            </div>

                          </div>
                          <input type="text" name="user_id" :value="user.id" hidden="true">
                      </form>
                    <input type="text" name="myid" :value="thread.id" id="myid" hidden="true" />
                    <input type="text" name="myid" :value="auth.id" id="thid" hidden="true" />
                    
                    </div> <!--end of position fixed-->
                </div>

        </div>

</div>
</template>


<script>
import moment from 'moment';
var csrf_token = $('meta[name="csrf-token"]').attr('content');
var myid;
var threadd_id;
let date = Date();
//myid = document.getElementById('myid').value;
    export default {
        data() {
            return {
                threads: [],
                loading: '',
                loaded: '',
                thread: '',
                messages: '',
                user: '',
                auth: '',
                game: '',
                message: '',
                auth_id: '',
                thread_id: '',
                status: '',
                returnmessage: '',
                messageloading: false,
                messagesend: true,
                csrf: ''

            }
        },
         beforeRouteUpdate: function(to, from, next) {
            console.log("beforeRouteEnter");
            next();
            this.fetchData();
        },
        beforeRouteLeave (to, from, next) {
            // called when the route that renders this component is about to
            // be navigated away from.
            // has access to `this` component instance.
            $('.allthreads').show();
            next();
          },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this
            toggleallthreads();
            this.fetchData();     
        },
        methods: {
            fetchData () {
                axios.post('/thisthread/' + this.$route.params.username + '/' + this.$route.params.slug)
                .then(function(response) { 
                self.game = response.data
                self.thread = response.data[0],
                self.thread_id = response.data[0].id,
                self.messages = response.data[1],
                self.user = response.data[2], 
                self.auth = response.data[3], 
                self.auth_id = response.data[3].id, 
              //  response => this.categories = response.data,
                self.loading = false,
                self.loaded = true,
                self.csrf = csrf_token,
                myid = self.auth_id;
                threadd_id = self.thread_id;
                responsive();
                setInterval(function() {
               
                }, 2000);
                mysock(myid, threadd_id);
                }); 
            },
            sendMessage(sendurl) {  //save location method
              self = this,
              this.messagesend = false,
              this.messageloading = true
               axios({ 
                  method: 'post',
                  url: sendurl,
                  data: {
                    message: self.message,
                    user_id: self.auth_id,
                    thread_id: self.thread_id 
                  }
                })
               .then(function(response) { 
                  self.messagesend = true,
                  self.messageloading = false,
                  self.status = true,  //set message status to be shown to be true
                  self.returnmessage = response.data  //set message to be shown on saved to response from controller
                  $( "#usb" ).append(
                       '<li class="list-group-item col-lg-8 col-lg-offset-0" v-if="message.id == auth.id"><span class="pull-right smallest-font text-muted">Me; '+moment(String(date)).format('MMMM Do YYYY hh:mm:ss a')+'</span><span class="small">'+self.message+'</span></li>' 
                       ); 
                        $('.thread_message').animate({scrollTop: 
                            $('.thread_message').prop("scrollHeight")}, 500); 
                  self.message = '',
                  setTimeout(function(){   
                       self.status = false //set message status to false after xxx seconds
                    }, 7000);
               });
            },
            postedOn(message) {
                return moment(String(message.created_at)).format('MMMM Do YYYY hh:mm:ss a');
            }
        },
    } 
import Pusher from 'pusher-js'
import Echo from "laravel-echo"
    function mysock(myid, threadd_id) {
        console.log(myid);
        console.log(threadd_id);
        console.log('this got');
        window.Echo = new Echo({  //start of echo and pusher receive
               broadcaster: 'pusher',
               key: 'ddc158fa13ebad9c3fdf',
               cluster: 'us2',
               encrypted: true
          });

            window.Echo.channel('threadmessage')
            .listen('NewThreadMessage', (e) => {
                console.log('sjksk');
                console.log(e.message.auth_id);
                console.log(e.message.user_id);
                console.log(e.message.username);
                console.log('from the message vue received an event');
                if( (e.message.auth_id != myid) && (e.message.thread_id == threadd_id) && (e.message.user_id == myid) ) {
                  $( "#usb" ).append(
                   '<li class="list-group-item col-lg-8 col-lg-offset-4" ><span class="pull-right smallest-font text-muted"> '+ e.message.username +'; '+ moment(String(date)).format('MMMM Do YYYY hh:mm:ss a')+'</span><span class="small">'+e.message.body+'</span><div style="height:40px;"></div></li>' 
                   ); 
                  $('.thread_message').animate({scrollTop: 
                    $('.thread_message').prop("scrollHeight")}, 500); 
                } 
            });     //end of echo and pusher receive
    }
    function toggleallthreads() {
    if ($(window).width() < 1200) {
          $('.allthreads').hide();
      }else{$('.allthreads').show();}
      window.addEventListener("resize", myFunction);
      function myFunction() {
         var w = window.outerWidth;
          var h = window.outerHeight;
         if (w < 1200) {
              $('.allthreads').hide();
          } else {
             $('.allthreads').show();
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

          $("#viewnewthread").click(function(){
                $("#expand_thread").slideDown("slow");
                $("#viewnewthread").hide();
                $("#hidenewthread").show();
            });
            $("#hidenewthread").click(function(){
                $("#expand_thread").slideUp("slow");
                $("#viewnewthread").show();
                $("#hidenewthread").hide();
            });
    }

   
    //event
</script>
