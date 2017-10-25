<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <div class="container-fluid" v-show="loaded">
            <h4 class="text-center">My Threads</h4>
           <!--insert-->
            <div class="row">
                <div class="col-xs-5 col-sm-3 col-md-3 col-lg-4">
                     <ul class="list-group" style="height: 80vh; background-color:#FAFAFA;">
                        <div v-for="thread in threads">
                            <span v-if="auth.id == thread.receiver_id">
                                <li class="list-group-item small" style="border: none !important;background-color: #FAFAFA;padding-bottom: 0px;" v-for="user in users" v-if="user.id == thread.user_id">
                                <router-link tag="a" :to="'/' + user.username + '/threads/' + thread.slug" class="text-muted">
                                    <a>{{thread.title}}</a>
                                  </router-link>
                                </li>
                            </span>
                            <span v-else>
                                <li class="list-group-item small" style="border: none !important;background-color: #FAFAFA;padding-bottom: 0px;" v-for="user in users" v-if="user.id == thread.receiver_id">
                                <router-link tag="a" :to="'/' + user.username + '/threads/' + thread.slug" class="text-muted">
                                    <a>{{thread.title}}</a>
                                  </router-link>
                                </li>
                            </span>
                        </div>
                    </ul>
                </div>
                    <router-view></router-view>
            </div>
             <div style="height:600px;"></div>
            <!--insert-->
                <ul class="list-group">
                <div v-for="thread in threads">
                    <span v-if="auth.id == thread.receiver_id">
                        <li class="list-group-item" v-for="user in users" v-if="user.id == thread.user_id"><a :href="'/thread/' + user.username + '/' + thread.slug" class="text-muted">{{thread.title}} {{user.username}}</a></li>
                    </span>
                    <span v-else>
                        <li class="list-group-item" v-for="user in users" v-if="user.id == thread.receiver_id"><a :href="'/thread/' + user.username + '/' + thread.slug" class="text-muted">{{thread.title}} {{user.username}}</a></li>
                    </span>
                </div>
                </ul>
           
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
                threads: [],
                loading: '',
                loaded: '',
                auth: '',
                users: ''

            }
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this,
            this.fetchData()
        },
        methods: {
             fetchData () {
                axios.post('/' + this.$route.params.username + '/threads')
             //   .then(({data}) => this.categories = data);  //object desturcturing syntax in ecma 6(ES2015)
                .then(function(response) { 
                console.log(response.data[0]),
                self.threads = response.data[0],
                self.auth = response.data[1],
                self.users = response.data[2],
              //  response => this.categories = response.data,
                self.loading = false,
                self.loaded = true
                }); 
            },
            postedOn(thread) {
                return moment(thread.created_at).fromNow();
            },
        }
    }
    
</script>

