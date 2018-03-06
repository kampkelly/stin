<template>
<div class="col-xs-2 col-sm-12 col-md-8 col-lg-8 col-xl-7 second-row" id="secondDiv" style="padding-top: 70px; margin-right: 0px !important;">
        <div>
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div>
        <div class="container-fluid create-startup" style="padding-left: 30px" v-show="loaded">
            <div class="alert alert-success notifications_panel" role="alert" v-show="status" style="position: fixed; top: 80px; width: 30%; z-index: 60;">
                {{message}}
            </div>
            <h4 class="text-center">Update {{startup.title}}</h4>
            <form :action="'/startup/' + startup.slug" method="POST" class="form-horizontal" role="form" files="true" enctype="multipart/form-data">
              <!--csrf_field-->
             <input type="hidden" name="_token" :value="csrf">
              <div id="cr"></div>
                    <div class="form-group">
                        <label for="startup_title" class="control-label"><small>Startup Name</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_title" id="startup_title" class="form-control" placeholder="Enter Startup Name" v-model="title" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fileupload" class="control-label"><small>Cover Photo</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                        <input type="file" name="startup_image" id="fileupload" placeholder="Enter Title" class="btn btn-success btn-sm">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="fileupload" class="control-label"><small>More photos (can attach more than one):</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                         <input type="file" name="photos[]" class="btn btn-success btn-sm" multiple />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_company" class="control-label"><small>Company/Group Name</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_company" id="startup_company" class="form-control" placeholder="Enter Company or Group/Team Name" v-model="group_name" required>
                        </div>
                    </div>
                    <div class="form-group" v-if="auth.is_permission == 0">
                        <label for="short_desc" class="control-label"><small>Brief Description</small><span class="small text-muted"> sell your idea here (not more than 150 words)</span></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <textarea name="short_desc" id="short_desc" class="form-control" rows="2" style="resize:none;" placeholder="Briefly descrbie your product" v-model="short_desc" required></textarea>
                        </div>
                    </div>
                    <div v-else>
                        <label class="control-label"><small>Type of editor</small></label>
                        <select v-model="type_of_editor" class="form-control">
                            <option selected="selected">Standard</option>
                            <option>Advanced</option>
                        </select>
                        <div class="form-group" v-if="type_of_editor == 'Standard'">
                            <label for="short_desc" class="control-label"><small>Standard Description</small><span class="small text-muted"> sell your idea here (not more than 150 words)</span></label>
                            <div class="col-sm-12 col-sm-offset-0">
                                <textarea name="short_desc" id="short_desc" class="form-control" rows="2" style="resize:none;" placeholder="Descrbie your product" v-model="short_desc" required></textarea>
                            </div>
                        </div>
                        <tinymce v-if="type_of_editor == 'Advanced'" id="editor" :content="content" :options="options" v-model="short_desc" name="short_desc"></tinymce>
                        
                    </div>
                    <div class="form-group d-none">
                        <label for="full_desc" class="control-label"><small>Full Description</small><span class="small text-muted"> - discuss your idea</span></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <textarea name="full_desc" id="full_desc" class="form-control" rows="5" style="resize:none;" placeholder="Describe Fully" v-model="full_desc" required></textarea>
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
                                     
                                    
                                        <option v-for="category in categories" :value="category.id" v-if="category_id == category.id" selected>{{category.name}}</option>
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
                        <div class="col-sm-12 col-sm-offset-0">
                            <button type="submit" class="btn btn-success btn-block btn-sm" v-show="updatesave">
                                Update
                            </button>
                            <button class="btn btn-success btn-block btn-sm" v-show="updateloading">
                                Updating <img src="Ellipsis.svg">
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
var thecontent;
    export default {
        data() {
            return {
                categories: [],
                loading: '',
                loaded: '',
                startup: '',
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
                 csrf: '',
                 auth: '',
                 type_of_editor: '',
                 content: '',
                  options: {
                        style_formats: [
                            {title: 'Headers', items: [
                              {title: 'Header 1', format: 'h1'},
                              {title: 'Header 2', format: 'h2'},
                              {title: 'Header 3', format: 'h3'},
                              {title: 'Header 4', format: 'h4'},
                              {title: 'Header 5', format: 'h5'},
                              {title: 'Header 6', format: 'h6'}
                            ]},
                            {title: 'Classes', items: [
                              {title: 'innovationparagraph', inline: 'span', classes: 'innovation_description'},
                              {title: 'remove classes', inline: 'span', classes: 'none'}
                            ]},
                            {title: 'CustomCss', items: [
                              {title: 'Lineheight 35px', inline: 'span', styles: {lineHeight: '35px'}}
                            ]},
                            {title: 'Inline', items: [
                              {title: 'Bold', icon: 'bold', format: 'bold'},
                              {title: 'Italic', icon: 'italic', format: 'italic'},
                              {title: 'Underline', icon: 'underline', format: 'underline'},
                              {title: 'Strikethrough', icon: 'strikethrough', format: 'strikethrough'},
                              {title: 'Superscript', icon: 'superscript', format: 'superscript'},
                              {title: 'Subscript', icon: 'subscript', format: 'subscript'},
                              {title: 'span', inline: 'span'},
                              {title: 'Code', icon: 'code', format: 'code'}
                            ]},
                            {title: 'Blocks', items: [
                              {title: 'Paragraph', format: 'p'},
                              {title: 'Blockquote', format: 'blockquote'},
                              {title: 'Div', format: 'div'},
                              {title: 'Pre', format: 'pre'}
                            ]},
                            {title: 'Alignment', items: [
                              {title: 'Left', icon: 'alignleft', format: 'alignleft'},
                              {title: 'Center', icon: 'aligncenter', format: 'aligncenter'},
                              {title: 'Right', icon: 'alignright', format: 'alignright'},
                              {title: 'Justify', icon: 'alignjustify', format: 'alignjustify'}
                            ]}
                          ],
                            file_browser_callback_types: 'file image media',
                            plugins: [
                                "advlist autoresize autosave autolink link image lists charmap print preview hr anchor pagebreak",
                                "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
                                "table contextmenu directionality emoticons paste imagetools textcolor responsivefilemanager",
                            ],

                            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect fontselect quicklink",
                               toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
                               image_advtab: true ,
                               
                               external_filemanager_path:"/tinymce/js/tinymce/filemanager/",
                               filemanager_title:"Responsive Filemanager" ,
                               external_plugins: { "filemanager" : "/tinymce/js/tinymce/filemanager/plugin.min.js"},
                            //   external_plugins: { "filemanager" : "tinymce/js/tinymce/filemanager/plugin.min.js"},
                          //     external_plugins: { "filemanager" : "public/tinymce/js/tinymce/plugins/filemanager/plugin.min.js"},
                            // external_plugins: {
                            //'filemanager': 'https://cloud.tinymce.com/stable/plugins/filemanager/plugin.min.js'
                         // },
                            autosave_interval: "10s",
                            autosave_restore_when_empty: true,
                            autosave_retention: "30m",
                            imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
                            image_caption: true,
                            image_advtab: true,
                            image_title: true,
                            media_live_embeds: true,
                            image_list: [{
                                    title: 'My image 1',
                                    value: 'http://www.tinymce.com/my1.gif'
                                },
                                {
                                    title: 'My image 2',
                                    value: 'http://www.moxiecode.com/my2.gif'
                                }
                            ]
                  } //
            }
        },
        created() {  //fire off ajax request]
            this.loading = true,
            this.loaded = false,
            self = this 
            axios.post('/innovation/edit/' + this.$route.params.slug)
            .then(function(response) { 
                self.loading = false,
                self.loaded = true,
                self.categories = response.data[0],
                self.startup = response.data[1],
                self.auth = response.data[2],
                self.title = self.startup.title,
                self.group_name = self.startup.group_name,
                self.short_desc = self.startup.short_desc,
                thecontent = self.startup.short_desc,
                self.content = thecontent,
                self.full_desc = self.startup.full_desc,
                self.aim = self.startup.aim,
                self.importance = self.startup.importance,
                self.achievements = self.startup.achievements,
                self.features = self.startup.features,
                self.category_id = self.startup.category_id,
                self.contacts = self.startup.contacts,
                responsive();
                csr = document.getElementById('csrf').innerHTML;
                console.log(csr);
                document.getElementById('c').innerHTML= csr;
                 }); 
        },
         mounted(){
            this.csrf = window.Laravel.csrfToken
        },
        methods: {
             updatestartup() {  //save location method
                 self = this,
                 this.updatesave = false,
                this.updateloading = true
               axios({ 
                  method: 'post',
                  url: '/innovation/update/' + this.$route.params.slug,
                  data: {
                    startup_title: self.title,
                    startup_image: self.pic,
                    startup_company: this.group_name,
                    short_desc: self.short_desc,
                    full_desc: self.full_desc,
                    image: self.pic,
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
</script>

