<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div> 
             <div class="container-fluid row listitems" v-show="loaded">
              <ul class="list-group" style="height:80vh;">
                  <router-link tag="a" to="/" class="list-group-item small" exact>
                    <a>Home</a>
                  </router-link>
                  <router-link tag="a" to="/innovation/create" class="list-group-item small">
                    <a>Pitch Innovation</a>
                  </router-link>
                  <router-link tag="a" :to="'/innovator/profile/' + auth.username" class="list-group-item small" v-if="auth.is_permission == 1">
                    <a>My Profile</a>
                  </router-link> 
                  <router-link tag="a" :to="'/innovator/profile/edit/' + auth.username" class="list-group-item small">
                    <a>Update Profile</a>
                  </router-link>
                  <router-link tag="a" :to="'/' + auth.username + '/innovations'" class="list-group-item small">
                    <a>My Innovations</a>
                  </router-link>
                  <router-link tag="a" :to="'/' + auth.username + '/threads'" class="list-group-item small" v-if="auth.is_permission == 1">
                    <a>My Messages</a>
                  </router-link>
                  <a href="/request_team" class="list-group-item small">Find Team Members</a>
                  <a href="/team_requests" class="list-group-item small">Team Requests</a>
                  <router-link tag="a" to="/posts" class="list-group-item small">
                    <a>News Updates</a>
                  </router-link>
                  <a href="/contact" class="list-group-item small">Contact Us</a>
                  <a href="/about" class="list-group-item small">About</a>
                  <a href="/privacy" class="list-group-item small">Privacy Policy</a>
                  <a href="/terms" class="list-group-item small">Terms and Conditions</a>
                   <router-link tag="a" to="/logout" class="list-group-item small">
                  <a href="/logout"  
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
                      </a>
                  </router-link>
                  <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        <div id="logout_csrf"></div>
                  </form>
                  
              </ul>
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
                auth: ''
            }
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this,
            hashchange();
            axios.post('/list-items')
            .then(function(response) { 
               $(document).scrollTop(1);
                self.auth = response.data,
                self.loading = false,
                self.loaded = true,
              //  hashchange();
                csr = document.getElementById('csrf').innerHTML;
                document.getElementById('logout_csrf').innerHTML= csr;
                }); 
        },
        methods: {
            
        }
    }

    function hashchange() {
       $('.third-row').hide();
        $('footer').hide();
        if ($(window).width() > 768) {
         //   window.location.href == "http://www.theinnovestors.dev/dashboard#/";
            document.location.replace == "http://www.google.com";
        }
           $('.third-row').hide();
           $('.footer').hide();
    //    });
    }
</script>

