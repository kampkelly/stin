@extends('layouts.new_master')

@section('content')

<div class="container docs">
	<div style="height:45px;"></div>
     <h4 class="text-center">Request For A Partner Below! </h4><br><br>
    <form action="/requestpartner" method="POST" class="form-horizontal" role="form" id="idea" files="true" enctype="multipart/form-data">
      <div class="form-group">
            <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Type <span class="asterisks">*</span></label>
            <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                <select class="form-control" v-model="type">
                    <option>Choose what you want to request for</option>
                    <option>Idea</option>
                    <option>Startup</option>
                </select>
            </div>
        </div>
    </form>
    <p v-text="idea"></p>
   
     <form action="/requestpartner" method="POST" class="form-horizontal" role="form" id="idea" files="true" enctype="multipart/form-data" v-if="type == 'Idea'">
         <h4 class="text-center">Idea Team Member's Requests</h4>
            {{ csrf_field() }}
            <div class="form-group">
                <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">I have a working idea on: <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company/Business Name" minlength="4" value="Self" required>
                </div>
            </div>
             <div class="form-group">
                <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Category <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                     <select class="form-control">
                            <option>Technology</option>
                            <option>Agriculture</option>
                        </select>
                </div>
            </div>
            <div class="form-group">
                <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Seeking to build a team of: <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="number" name="company_name" id="company_name" class="form-control" placeholder="Number of members" minlength="4" required>
                </div>
            </div>
            <div class="form-group">
                <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Team members specialization: <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Team members specialization; seperate each with comma" minlength="4" value="Self" required>
                </div>
            </div>
            <a href="#" class="btn" v-on:click="addone()">Add Team Member</a>
             <div class="form-group">
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-3">
                    <button type="submit" class="btn btn-primary btn-block btn-md">
                        Request Now
                    </button>
                </div>
            </div>
    </form>
    
    <form action="/requestpartner" method="POST" class="form-horizontal" role="form" id="startup" files="true" enctype="multipart/form-data" v-if="type == 'Startup'">
        <h4 class="text-center">Startup Member Requests</h4>
            {{ csrf_field() }}
            <div class="form-group">
                <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Startups  <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company/Business Name" minlength="4" value="Self" required>
                </div>
            </div>
             <div class="form-group">
                <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Brief Description <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                     <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Team members specialization" minlength="4" value="Self" required>
                </div>
            </div>
            <div class="form-group">
                <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Category <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                   <select class="form-control">
                        <option>Technology</option>
                        <option>Agriculture</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Seeking additional team members <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Team members specialization" minlength="4" value="Self" required>
                </div>
            </div> 
            <div class="form-group">
                <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Team members specialization: <span class="asterisks">*</span></label>
                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                    <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Team members specialization; seperate each with comma" minlength="4" value="Self" required>
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
     <div style="height: 200px;"></div>
            <form action="/requestpartner" method="POST" class="form-horizontal" role="form" files="true" enctype="multipart/form-data">
            {{ csrf_field() }}
                    <div class="form-group">
                        <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Company/Business Name <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                            <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company/Business Name" minlength="4" value="Self" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_desrciption" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Company Description <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                        <textarea class="form-control" rows="5" placeholder="About Your Company/Business" name="company_description" minlength="50" required>We are a company focused on improving the self-esteem of individuals by providing feel-good services.</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Position<span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                            <select name="position" id="position" class="form-control" required>
                                <option>Choose Position</option>
                                <option selected value="Partner">Partner</option>
                                <option value="Developer">Developer</option>
                                <option value="Marketter">Marketter</option>
                                <option value="Legal Matters">Legal Issues</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position_description" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Position Description <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                        <textarea class="form-control" rows="5" placeholder="What is the position about?" name="position_description" minlength="50" required>You will be in charge of several outlets managing and maing sure the services are in line with our standard.</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Type<span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                            <input type="radio" name="type" value="remote" checked> Remote &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <input type="radio" name="type" value="onsite"> Onsite
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="phone" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Phone <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                            <input type="text" name="phone" id="phone" class="form-control" required placeholder="We only use it, people don’t get to see it!" required="true" value="012334567">
                        </div>
                    </div>
                    @if(Auth::guest())
                    <div class="form-group">
                        <label for="contactname" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Name <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                            <input type="text" name="name" id="name" class="form-control" required placeholder="Name" required="true" minlength="4" value="James Bolton">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="email" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Email <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                            <input type="text" name="email" id="email" class="form-control" required placeholder="Email Address" required="true" value="jamesbolt@yahko.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Password <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                            <input type="password" name="password" id="password" class="form-control" required placeholder="Type password (at least 6 letters)" required="true" value="password">
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-3">
                            <button type="submit" class="btn btn-success btn-block btn-md">
                                Request Now
                            </button>
                        </div>
                    </div>
            </form>
    <div style="height:200px;"></div>
</div>
@endsection
