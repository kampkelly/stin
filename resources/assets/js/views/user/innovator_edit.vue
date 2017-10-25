<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <div class="container-fluid create-startup" style="padding-left: 30px" v-show="loaded">  <!--loaded starts-->
            <div class="alert alert-success notifications_panel" role="alert" v-show="status" style="position: fixed; top: 80px; width: 30%; z-index: 60;">
                {{message}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <div class="pan panel-default">
                <div class="panel-heading text-center">Update Profile Details</div>
                <div id="user" style="display: none;">{{user}}</div><br>
                <div class="panel-body">  <!--panel body-->
                    <form class="form-horizontal" role="form" method="POST" v-bind:action="'/innovator/update/' + id">
                          <!--csrf input-->

                        <div class="form-group">
                         <label for="firstname" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" v-model="user.fullname" required autofocus disabled="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" v-model="user.email" required disabled="true">
                            </div>
                        </div>
                    </form>
                    <!--EDITED FIELDS START HERE-->
                        <hr>
                        <h4 class="text-center">Location</h4>
                    <form class="form-horizontal" role="form" method="post" value="PUT" v-bind:action="'/innovator/update/' + id" v-on:submit.prevent="savelocation('/innovator/update/' + id)">
                        
                        <div class="form-group"> <!--address-->
                            <label for="address" class="col-md-4 control-label">Address <span id="asterisks">*</span></label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" name="address" v-model="address">
                            </div>
                        </div>
                          <div class="form-group">  <!--state-->
                            <label for="state" class="col-md-4 control-label">State <span id="asterisks">*</span></label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" name="state" v-model="state">
                            </div>
                        </div>
                        <div class="form-group"> <!--country-->
                            <label for="country" class="col-md-4 control-label">Country <span id="asterisks">*</span></label>
                            <div class="col-md-6">
                                <select name="country" class="form-control" id="country" required v-model="country">
                                    <option v-model="user.country">{{user.country}}</option>
                                    
                                        <option v-for="country in countries" v-model="country.currency">{{country.name}}</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block" v-show="locationsave">
                                    Save
                                </button>
                                <button class="btn btn-primary btn-block" v-show="locationloading">
                                    Saving <img src="/Ellipsis.svg">
                                </button>
                            </div>
                        </div>
                        </form>
                        <hr>     
                    <div v-if="user.is_permission == 0">
                        <h4 class="text-center">Social</h4>
                        <form class="form-horizontal" role="form" method="POST" v-bind:action="'/innovator/update/' + id" v-on:submit.prevent="savesocial('/innovator/update/' + id)">
                        <!--csrf-->
                        <div class="form-group">  <!--age-->
                            <label for="age" class="col-md-4 control-label">Age</label>

                            <div class="col-md-6">
                                <select id="text" for="age" class="form-control" name="age" v-model="age">
                                    <option v-model="user.age">{{user.age}}</option>
                                    <option value="10-18">10-18</option>
                                    <option value="18-35">18-35</option>
                                    <option value="36-60">36-60</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">  <!--twitter-->
                            <label for="phone" class="col-md-4 control-label">Phone no. <span id="asterisks">*</span></label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" placeholder="Enter phone number" v-model="contacts">
                            </div>
                        </div>
                        <div class="form-group">  <!--website-->
                            <label for="website" class="col-md-4 control-label">Website</label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" name="website" v-model="website">
                            </div>
                        </div>
                        <div class="form-group">  <!--facebook-->
                            <label for="facebook" class="col-md-4 control-label">Facebook</label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" name="facebook" v-model="facebook">
                            </div>
                        </div> 
                        <div class="form-group">  <!--linkedin-->
                            <label for="linkedin" class="col-md-4 control-label">Linkedin</label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" name="linkedin" v-model="linkedin">
                            </div>
                        </div> 
                        <div class="form-group">  <!--twitter-->
                            <label for="twitter" class="col-md-4 control-label">Twitter</label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" name="twitter" v-model="twitter">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block" v-show="socialsave">
                                    Save
                                </button>
                                <button class="btn btn-primary btn-block" v-show="socialloading">
                                    Saving <img src="Ellipsis.svg">
                                </button>
                            </div>
                        </div>
                        </form>
                        <hr>
                    </div>
                    <div v-if="user.is_permission == 0">
                        <h4 class="text-center">Other</h4>
                        <form class="form-horizontal" role="form" method="POST" v-bind:action="'/innovator/update/' + id" v-on:submit.prevent="saveother('/innovator/update/' + id)">
                         <!--csrf input-->
                        <div class="form-group">  <!--bio-->
                            <label for="bio" class="col-md-4 control-label">About Me <span id="asterisks">*</span></label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" name="bio" v-model="bio">
                            </div>
                        </div>
                        <div class="form-group">  <!--education-->
                            <label for="education" class="col-md-4 control-label">Highest Education <span id="asterisks">*</span></label>
                            <div class="col-md-6">
                                <select name="education" for="education" class="form-control" required v-model="education">
                                    <option v-model="education">{{education}}</option>
                                    <option value="High School">High School</option>
                                    <option value="Degree">Degree(Bsc.)</option>
                                    <option value="Masters">Masters(Msc.)</option>
                                    <option value="Phd">Phd</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">  <!--profession-->
                            <label for="profession" class="col-md-4 control-label">Profession</label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" name="profession" v-model="profession">
                            </div>
                        </div> 
                        <div class="form-group">  <!--interests-->
                            <label for="interests" class="col-md-4 control-label">Interests</label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" name="interests" v-model="interests">
                            </div>
                        </div>                       
                        <!--EDITED FIELDS END HERE-->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block" v-show="othersave">
                                    Save
                                </button>
                                <button class="btn btn-primary btn-block" v-show="otherloading">
                                    Saving <img src="Ellipsis.svg">
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>  <!--panel body-->

                    
            </div>
        </div>  <!--loaded ends-->
     

        </section>
    </div> 
</div>
</template>

<script>

import moment from 'moment';

    export default {
        data() {
            return {
                thedata: [],
                loading: '',
                loaded: '',
                user: '',
                startups: '',
                countries: '',
                id: '',  //user details start here
                address: '',
                state: '',
                country: '',
                age: '',
                contacts: '',
                website: '',
                facebook: '',
                linkedin: '',
                twitter: '',
                bio: '',
                education: '',
                profession: '',
                interests: '',
                message: '',
                status: false,
                locationsave: true,  //to save button
                locationloading: false,  //saving button
                socialsave: true,
                socialloading: false,
                othersave: true,
                otherloading: false

            }
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this 
            axios.post('/innovator/edit')
         //   .then(({data}) => this.categories = data);  //object desturcturing syntax in ecma 6(ES2015)
            .then(function(response) {
                response => this.thedata = response.data,
                self.countries = response.data[2][0],
                self.user = response.data[0],
                self.id = self.user.id,
                self.address = self.user.address,
                self.state = self.user.state,
                self.country = self.user.country,
                self.age = self.user.age,
                self.contacts = self.user.contacts,
                self.website = self.user.website,
                self.facebook = self.user.facebook,
                self.linkedin = self.user.linkedin,
                self.twitter = self.user.twitter,
                self.bio = self.user.bio,
                self.education = self.user.education,
                self.profession = self.user.profession,
                self.interests = self.user.interests,
                self.startus = response.data[1],
                self.countries = response.data[2], 
                //console.log(response.data[2]),
                self.loading = false,
                self.loaded = true,
                responsive();
                });  
        },
        methods: {
            postedOn(startup) {
                return moment(startup.created_at).fromNow();
            },
            savelocation(saveurl) {  //save location method
              self = this,
              this.locationsave = false,
              this.locationloading = true
               axios({ 
                  method: 'post',
                  url: saveurl,
                  data: {
                    address: self.address,
                    state: self.state,
                    country: self.country
                  }
                })
               .then(function(response) { 
                  self.locationsave = true,
                  self.locationloading = false,
                  self.status = true,  //set message status to be shown to be true
                  self.message = response.data  //set message to be shown on saved to response from controller
                  setTimeout(function(){   
                       self.status = false //set message status to false after xxx seconds
                    }, 7000);
               });
            },
            savesocial(saveurl) {  //save social method
              self = this,
              this.socialsave = false,
              this.socialloading = true
               axios({ 
                  method: 'post',
                  url: saveurl,
                  data: {
                    age: self.age,
                    contacts: self.contacts,
                    website: self.website,
                    facebook: self.facebook,
                    linkedin: self.linkedin,
                    twitter: self.twitter
                  }
                })
               .then(function(response) { 
                  self.socialsave = true,
                  self.socialloading = false,
                  self.status = true,
                  self.message = response.data
                  setTimeout(function(){   
                       self.status = false //set message status to false after xxx seconds
                    }, 7000);
               });
            },
             saveother(saveurl) {  //save other method
              self = this,
              this.othersave = false,
              this.otherloading = true
               axios({ 
                  method: 'post',
                  url: saveurl,
                  data: {
                    bio: self.bio,
                    education: self.education,
                    profession: self.profession,
                    interests: self.interests
                  }
                })
               .then(function(response) { 
                  self.othersave = true,
                  self.otherloading = false,
                  self.status = true
                  self.message = response.data
                  setTimeout(function(){   
                       self.status = false //set message status to false after xxx seconds
                    }, 7000);
               });
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

