<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <div class="container-fluid create-startup" style="padding-left: 30px" v-show="loaded">
            <div class="alert alert-success notifications_panel" role="alert" v-show="status" style="position: fixed; top: 80px; width: 30%; z-index: 60;">
                {{message}}
            </div>
            <h4 class="text-center">Add Your Innovation</h4>
              <!--include partials errors-->
          <form action="/startups" method="POST" class="form-horizontal" role="form" files="true" enctype="multipart/form-data">
            <!--<form action="/startups" method="POST" class="form-horizontal" role="form" files="true" enctype="multipart/form-data" v-on:submit.prevent="savestartup()"> -->
              <!--csrf_field-->
              <div id="csval"></div>
                    <div class="form-group">
                        <label for="startup_title" class="control-label"><small>Title of Innovation/Startup</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_title" id="startup_title" class="form-control" placeholder="Enter Startup Name" v-model="title" required maxlength="50" minlength="9">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fileupload" class="control-label"><small>Display Picture</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                        <input type="file" name="startup_image" id="fileupload" placeholder="Enter Title" class="btn btn-success" required>
                        </div>
                    </div>
                    <div style="display: none;">
                        <b>Live Preview</b>
                        <br />
                        <br />
                        <div id="dPreview">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_company" class="control-label"><small>Company/Group Name</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_company" id="startup_company" class="form-control" placeholder="Enter Company or Group/Team Name" v-model="group_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_desc" class="control-label"><small>Brief Description</small><span class="small text-muted"> sell your idea here (not more than 250 characters)</span></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <textarea name="short_desc" id="short_desc" class="form-control" rows="2" style="resize:none;" placeholder="Briefly descrbie your product" v-model="short_desc" required maxlength="300" minlength="50"></textarea>
                        </div>
                    </div>
                    <div class="form-group hide-all">
                        <label for="full_desc" class="control-label"><small>Full Description</small><span class="small text-muted"> - discuss your idea</span></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <textarea name="full_desc" id="full_desc" class="form-control" rows="5" style="resize:none;" placeholder="Describe Fully" v-model="full_desc" required></textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="fileupload" class="control-label"><small>Product photos (can attach more than one):</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                         <input type="file" name="photos[]" class="btn btn-success" multiple />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_aim" class="control-label"><small>Aim</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_aim" id="startup_aim" class="form-control" placeholder="State What You intend to achieve" v-model="aim" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_imp" class="control-label"><small>Why Its Important</small><span class="small text-muted"> (not more than 100 words)</span></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_imp" id="startup_imp" class="form-control" placeholder="What are its benefits?" v-model="importance" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_achievements" class="control-label"><small>Notable Achievements</small><span class="small text-muted"> - seperate each with a comma</span></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_achievements" id="startup_achievements" class="form-control" placeholder="Previous Achievements" v-model="achievements" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_features" class="control-label"><small>Features</small><span class="small text-muted"> - seperate each with a comma</span></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_features" id="startup_features" class="form-control" placeholder="Product Features" v-model="features" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_category" class="control-label"><small>Category</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <select name="startup_category" id="startup_category" class="form-control" required v-model="category_id">
                                  <!--foreach category-->                                    
                                        <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_contacts" class="control-label"><small>Contacts</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_contacts" id="startup_contacts" class="form-control" placeholder="Group/Company/Team Contacts" v-model="contacts" required>
                        </div>
                    </div>
                     <div class="form-group">
                         <label for="consent" class="control-label"><small>By checking the box below, you agree to the <a href="/terms" target="blank" style="color:#2980B8;">terms and conditions</a></small></label>
                         <div class="col-sm-12 col-sm-offset-0">
                            <input type="checkbox" name="consent" id="consent" required title="I agree to the terms and conditions" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-0">
                            <button type="submit" class="btn btn-success btn-block" v-show="updatesave">
                                Create
                            </button>
                            <button class="btn btn-success btn-block" v-show="updateloading">
                                Creating <img src="Ellipsis.svg">
                            </button>
                            
                        </div>
                    </div>
            </form>
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
                categories: [],
                loading: '',
                loaded: '',
                title: '',
                pic: '',
                group_name: '',
                short_desc: '',
                full_desc: '',
                photos: '',
                aim: '',
                importance: '',
                achievements: '',
                features: '',
                category_id: '',
                contacts: '',
                updatesave: true,
                updateloading: false,
                message: '',
                status: false,
            }
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this 
            axios.post('/categories_dashboard')
         //   .then(({data}) => this.categories = data);  //object desturcturing syntax in ecma 6(ES2015)
            .then(function(response) {
                self.categories = response.data,
                self.loading = false,
                self.loaded = true,
                responsive();
                csr = document.getElementById('csrf').innerHTML;
                document.getElementById('csval').innerHTML= csr;
                }); 
        },
        methods: {
             savestartup() {  //save location method
                 self = this,
                 this.updatesave = false,
                this.updateloading = true
               axios({ 
                  method: 'post',
                  url: '/innovation/new/save/',
                  data: {
                    startup_title: self.title,
                    startup_image: self.pic,
                    startup_company: this.group_name,
                    short_desc: self.short_desc,
                    full_desc: self.full_desc,
                    photos: self.photos,
                    startup_aim: self.aim,
                    startup_imp: self.importance,
                    startup_achievements: self.achievements,
                    startup_features: self.features,
                    startup_category: self.category_id,
                    startup_contacts: self.contacts
                  }
                })
               .then(function(response) { 
                  self.updatesave = true,
                  self.updateloading = false,
                  self.status = true,
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
 //   document.getElementById('cs_val').text = myname;
 
</script>

