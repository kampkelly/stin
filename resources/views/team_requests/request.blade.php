@extends('layouts.new_master')

@section('content')
<style type="text/css">
    footer {
        display: none;
    }
</style>
<div class="teamup">
<div class="container docs">
	<div style="height:75px;"></div>
     <h4 class="text-center" style="text-decoration: underline; color: white;">Request For Team Members! </h4><br><br>
    <form action="/requestpartner" method="POST" class="form-horizontal" role="form" id="idea" files="true" enctype="multipart/form-data">
      <div class="form-group row">
            <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-1 offset-lg-3 control-label">Type <span class="asterisks">*</span></label>
            <div class="col-xs-12 col-sm-8 col-md-7 col-lg-4">
                <select class="form-control" v-model="type">
                    <option>Choose what you want to request for</option>
                    <option>Idea</option>
                    <option>Startup</option>
                </select>
            </div>
        </div>
    </form>
    <p v-text="idea"></p>
   
     

    @if(Auth::check())
        <idea v-if="type == 'Idea'"></idea>
        <startup v-if="type == 'Startup'"></startup>
    @else
         <idea-auth v-if="type == 'Idea'"></idea-auth>
        <startup-auth v-if="type == 'Startup'"></startup-auth>
    @endif

     
    <div style="height:100px;"></div>
</div>

</div>

@endsection
