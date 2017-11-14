<template>
    <div>
    <form action="/request_team" method="POST" class="form-horizontal" role="form" id="startup" files="true" enctype="multipart/form-data">
        <input type="hidden" name="_token" :value="csrf">
        <h4 class="text-center">A Startup Member Requests</h4>
            <input type="text" name="type" value="Startup" hidden>
            <div class="form-group">
                <label for="title" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Startup Name<span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="title" id="title" class="form-control" placeholder="Startup Name" minlength="4" required>
                </div>
            </div>
             <div class="form-group">
                <label for="description" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Brief Description <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                     <input type="text" name="description" id="description" class="form-control" placeholder="Brief Decription" minlength="4" required>
                </div>
            </div>
            <div class="form-group">
                <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Category <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                   <select class="form-control" name="category">
                        <option value="Engineering" selected>Engineering</option>
                            <option value="Agriculture">Agriculture</option>
                            <option value="Power and Energy">Power and Energy</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Education">Education</option>
                            <option value="Design">Design</option>
                            <option value="Environment">Environment</option>
                    </select>
                </div>
            </div>
                 <section class="row" style="margin-bottom: 10px;">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"><a href="#" class="btn" v-on:click="addtwo()" style="color:#27ad60;">Add Team Member <span class="glyphicon glyphicon-plus small" style="color:#27ad60;"></span></a></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="role1" id="role1" class="form-control" placeholder="Team member title e.g 'Developer'" minlength="4" required>
                </div>
                 <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="function_1" id="function_1" class="form-control" placeholder="Member's function" minlength="4" required>
                </div>
            </section>
            <section id="two" class="row two" style="margin-bottom: 10px; display: none;" v-show="two">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"><a href="#" class="btn" v-on:click="addthree()" style="color:#27ad60;">Add Team Member <span class="glyphicon glyphicon-plus small" style="color:#27ad60;"></span></a></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="role2" id="role2" class="form-control" placeholder="Team member title e.g 'Developer'" minlength="4">
                </div>
                 <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="function_2" id="function_2" class="form-control" placeholder="Member's function" minlength="4">
                </div>
                <a href="#" style="color:red;" v-on:click="removetwo()"> <span class="glyphicon glyphicon-minus" style="color: red;"></span> remove</a>
            </section>
            <section id="three" class="row" style="margin-bottom: 10px; display: none;" v-show="three">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"><a href="#" class="btn" v-on:click="addfour()" style="color:#27ad60;">Add Team Member <span class="glyphicon glyphicon-plus small" style="color:#27ad60;"></span></a></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="role3" id="role3" class="form-control" placeholder="Team member title e.g 'Developer'" minlength="4">
                </div>
                 <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="function_3" id="function_3" class="form-control" placeholder="Member's function" minlength="4">
                </div>
                <a href="#" style="color:red;" v-on:click="removethree()"> <span class="glyphicon glyphicon-minus" style="color: red;"></span> remove</a>
            </section>
            <section id="four" class="row" style="margin-bottom: 10px; display: none;" v-show="four">
                 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"><a href="#" class="btn">&nbsp;</a></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="role4" id="role4" class="form-control" placeholder="Team member title e.g 'Developer'" minlength="4">
                </div>
                 <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="function_4" id="function_4" class="form-control" placeholder="Member's function" minlength="4">
                </div>
                <a href="#" style="color:red;" v-on:click="removefour()"> <span class="glyphicon glyphicon-minus" style="color: red;"></span> remove</a>
            </section>
            <div class="form-group">
                <label for="additional" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Additional Info</label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                   <textarea placeholder="Additional Information" name="additional" id="additional" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Phone <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="phone" id="phone" class="form-control" required placeholder="We only use it, people don’t get to see it!" required>
                </div>
            </div>
            <div class="form-group">
                <label for="contactname" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Name <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="name" id="name" class="form-control" required placeholder="Name" required minlength="4">
                </div>
            </div>
             <div class="form-group">
                <label for="email" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Email <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="email" id="email" class="form-control" required placeholder="Email Address" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Password <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="password" name="password" id="password" class="form-control" required placeholder="Type password (at least 6 letters)" required="true">
                </div>
            </div>
             <div class="form-group">
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-3">
                    <button type="submit" class="btn btn-success btn-block btn-md">
                        Request Now
                    </button>
                </div>
            </div>
    </form>
</div>
</template>

<script>
   
    export default {
        data() {
            return {
                one: '',
                two: '',
                three: '',
                four: '',
                 csrf: ''
            }
        },
        methods: {
            addtwo() {
                this.two = true
              }, 
              addthree() {
                this.three = true
              }, 
              addfour() {
                this.four = true
              },
              removetwo() {
                this.two = false,
                $("#two :input").val('');
              }, 
              removethree() {
                this.three = false
                $("#three :input").val('');
              }, 
              removefour() {
                this.four = false
                $("#four :input").val('');
              }
        },
        mounted(){
            this.csrf = window.Laravel.csrfToken
        }
    }
</script>

<style>

</style>