<template>
    <div>
        <ul class="list-group" style="overflow-y: scroll; max-height:450px; height:450px;">
            <div v-for="msg_friend in msg_friends">
                <div v-for="msg_thread in msg_threads">
                    <div v-if=" (msg_friend.id == msg_thread.sender_id && auth.id == msg_thread.receiver_id) || (auth.id == msg_thread.sender_id && msg_friend.id == msg_thread.receiver_id)">
                        <a href="#" class="list-group-item click_theuser" v-on:click="showmessages($event, msg_thread.slug)" :id="'detect' + msg_thread.slug">
                             <span class="float-right mr-2 minimize_messenger open_message"><i class="fa fa-chevron-down" aria-hidden="true" style="color: grey;"></i></span>
                             <span class="float-right mr-2 minimize_messenger close_message" style="display:none;"><i class="fa fa-chevron-up" aria-hidden="true" style="color: grey;"></i></span>
                             {{msg_friend.fullname}} 
                            <span class="badge badge-primary badge-pill d-none">1</span>
                          </a>
                          <!--messages here-->
                          <!--messages here-->
                          <!--hmm-->
                        <div class="message_container mt-1" :id="msg_thread.slug" style="display:none;">
                            <ul class="list-group row thread_message d-block p-4 bg-info mb-3" style="overflow-y: scroll; max-height:450px; height:450px; padding-bottom:40px; border-top: 1px solid #f2f2f2; border-bottom: 1px solid #f2f2f2; position: relative;">
                                    <span v-for="msg_message in msg_messages" v-if="msg_message.thread_id == msg_thread.id" class="clearfix"> 
                                        <li class="list-group-item bg-ligh col-9 col-sm-8 col-lg-12 col-lg-offset-0 mb-3 w-75 border-0 clearfix" style="background-color:#e1e1e1" v-if="msg_message.user_id == auth.id">
                                            <span class="float-right smallest-font text-muted row w-75 d-none">Me; {{ postedOn(msg_message) }}</span>
                                            <span class="small row w-100">{{msg_message.body}}</span>
                                            <span class="float-right smallest-fon text-muted row" style="font-size:40%;">Me; {{ postedOn(msg_message) }}</span>
                                          </li>
                                        <li class="list-group-item col-9 col-sm-8 col-lg-12 col-lg-offset-4 mb-3 border-0 clearfix float-right" v-else>
                                            <span class="float-right small smallest-font text-muted row w-75 d-none"> {{msg_friend.fullname}}; {{ postedOn(msg_message) }}</span>
                                            <span class="small row w-100">{{msg_message.body}}</span>
                                            <span class="float-right smallest-fon text-muted row" style="font-size:40%;">{{msg_friend.fullname}}; {{ postedOn(msg_message) }}</span>
                                          </li>
                                    </span>
                                <div :id="msg_thread.id"></div>
                            </ul>

                        <!--form here-->
                        <form :action="'/threads/' + msg_friend.username + '/' + msg_thread.slug" method="POST" value="PUT" class="form-horizontal bg-danger" role="form" v-on:submit.prevent="sendMessage('/threads/' +msg_friend.username + '/' + msg_thread.slug, msg_thread.id)" style="position: fixed; bottom: 0px; width: 96%; margin-left: -20px;">
                              <!--csrf field-->
                               <input type="hidden" name="_token" :value="csrf">
                               <input type="text" name="user_id" :value="msg_friend.id" hidden="true">
                                  <div class="form-group row">
                                    <div class="input-group col-sm-12">
                                        <input type="text" class="form-control msg d-none" name="message" id="message" v-model="written_message"
                                        placeholder="Type Message"> 
                                        <textarea class="form-control msg" name="message" id="message" v-model="written_message"
                                        placeholder="Type Message" rows="1" resize="none"></textarea>
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-light send-msg" v-show="messagesend">
                                                <i class="fa fa-paper-plane" aria-hidden="true" style="height: 1.35em; color:green;"></i>
                                            </button>
                                            <button class="btn btn-light btn-block send-msg" v-show="messageloading">
                                              <i class="fa fa-paper-plane" aria-hidden="true" style="height: 1.35em; color:green;"></i> <img src="/Ellipsis.svg" style="height: 1.35em;">
                                          </button>
                                        </span>
                                    </div>
                                  </div>
                              </form>
                              <input type="text" name="myid" :value="msg_thread.id" id="myid" hidden="true" />
                                <input type="text" name="myid" :value="auth.id" id="thid" hidden="true" />
                        <!--form here-->

                        </div>
                          <!--hmm-->

                    </div>
                </div>
            </div>
        
        </ul>
    </div>
</template>

<script>
//var csrf_token = $('meta[name="csrf-token"]').attr('content');
import moment from 'moment';
let date = Date();
var myid;
var threadds;
    export default {
        data() {
            return {
                msg_friends: '',
                msg_threads: '',
                msg_messages: '',
                auth: '',
                csrf: '',
                written_message: '',
                messagesend: true,
                messageloading: false,
                open_message: true,
                close_message: false
            }
        },
        created() {  
          //  this.loading = true,
            //this.loaded = false,
            var _self = this
         //   this.$router.push('/m')
            axios.post('/messeng')
       
            .then(function(response) { 
             //  $(document).scrollTop(1);
                _self.msg_friends = response.data[0],
                _self.msg_threads = response.data[1],
                _self.auth = response.data[2],
                _self.msg_messages = response.data[3],
                 myid = _self.auth.id;
                threadds = _self.msg_threads;
                mysock(myid, threadds);
                console.log('oka'),
                console.log(_self.msg_threads),
                console.log('oka'),
                console.log('oka')
                });  
        },
        methods: {
            addtwo() {
                this.two = true
              },
              showmessages(e, slug) {
                let clickedElement;
                clickedElement = e.currentTarget; 
               // $(clickedElement).attr("disabled", true);
            //   $(clickedElement).siblings().hide();
               $(".click_theuser").not(clickedElement).toggle();
               $(".open_message").toggle();
               $(".close_message").toggle();
              // $(".click_theuser").hide("slow");
                $('#'+slug).toggle();
                $(clickedElement).css("background-color", "white"); 
                $(clickedElement).toggleClass("make_fixed");

              },
                sendMessage(sendurl, tr_id) {  //save location method
                  var _self = this;
                  this.messagesend = false,
                  this.messageloading = true
                   axios({ 
                      method: 'post',
                      url: sendurl,
                      data: {
                        message: _self.written_message,
                        user_id: _self.auth.id,
                        thread_id: tr_id 
                      }
                    })
                   .then(function(response) { 
                      _self.messagesend = true,
                      _self.messageloading = false,
                        $(`#${tr_id}`).append(
                           '<li class="list-group-item bg-ligh col-9 col-sm-8 col-lg-8 col-lg-offset-0 mb-3 w-75 border-0 clearfix" style="background-color:#e1e1e1; margin-top:10px;"><span class="float-right smallest-font text-muted row w-75 d-none">Me; '+moment(String(date)).format('hh:mm a MM/D/YY')+'</span><span class="small row w-100">'+_self.written_message+'</span> <span class="float-right smallest-fon text-muted row" style="font-size:40%;">Me; '+moment(String(date)).format('hh:mm a MM/D/YY')+'</span></li>' 
                           );  
                      /*$( '#'+tr_id).append(
                           '<h1 style="color:blue;">Gotten it</h1>' 
                           );  
                           document.getElementById(`${tr_id}`).innerHTML = "Paragraph changed!"; */
                    //  alert('Gotten it');
                            $('.thread_message').animate({scrollTop: 
                                $('.thread_message').prop("scrollHeight")}, 360);  
                      _self.written_message = ''
                   });
                },
               postedOn(msg_message) {
                    return moment(String(msg_message.created_at)).format('hh:mm a MM/D/YY');
                }
        },
        mounted(){
            this.csrf = window.Laravel.csrfToken
        },
    }

import Pusher from 'pusher-js'
import Echo from "laravel-echo"
    function mysock(myid, threadds) {
        console.log('detect event');
        console.log('detect event');
        console.log('detect event');
        console.log('detect event');
        console.log('detect event');
        console.log('detect event');
        console.log('detect event');
        console.log(myid);
        console.log(threadds);
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

              //  threadds.forEach(function(threadd) {
                console.log('cool one there');
                console.log(threadds);
                for (var i = 0, len = threadds.length; i < len; i++) {
                    console.log('cool one there nice');
                    if( (e.message.auth_id != myid) && (e.message.thread_id == threadds[i].id) && (e.message.user_id == myid) ) {
                      $(`#${threadds[i].id}`).append(
                       '<li class="list-group-item bg-light col-9 col-sm-8 col-lg-8 col-lg-offset-0 mb-3 float-right w-75 border-0 clearfix"><span class="float-right smallest-font text-muted row w-75 d-none"> '+ e.message.fullname +'; '+ moment(String(date)).format('hh:mm a MM/D/YY')+'</span><span class="small row w-100">'+e.message.body+'</span><span class="float-right smallest-fon text-muted row" style="font-size:40%;">' + e.message.fullname + ' ' +moment(String(date)).format('hh:mm a MM/D/YY')+'</span></li>' 
                       ); 
                      $(`#detect${threadds[i].slug}`).css("background-color", "#27AE60"); 
                      $('#is_there_new_message').show(); 
                      $('.thread_message').animate({scrollTop: 
                        $('.thread_message').prop("scrollHeight")}, 500); 
                    } 
                }

            });     //end of echo and pusher receive
    }
</script>

<style>

</style>