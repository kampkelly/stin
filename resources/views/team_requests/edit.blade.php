@extends('layouts.new_master')

@section('content')

<div class="container docs">
	<div style="height:45px;"></div>
     <h4 class="text-center">Update Position for {{$find->position}} by {{$find->company_name}} </h4><br><br>
            <form action="/partner/update/{{$find->slug}}" method="POST" class="form-horizontal" role="form" files="true" enctype="multipart/form-data">
            {{ csrf_field() }}
                    <div class="form-group">
                        <label for="company_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Company/Business Name <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                            <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company/Business Name" minlength="4" value="{{$find->company_name}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_desrciption" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Company Description <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                        <textarea class="form-control" rows="5" placeholder="About Your Company/Business" name="company_description" minlength="50" required>{{$find->company_description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Position<span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                            <select name="position" id="position" class="form-control" required>
                                <option>Choose Position</option>
                                <option selected value="{{$find->position}}">{{$find->position}}</option>
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
                        <textarea class="form-control" rows="5" placeholder="What is the position about?" name="position_description" minlength="50" required>{{$find->position_description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Type<span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                            @if($find->type == 'remote')
                                <input type="radio" name="type" value="remote" checked> Remote &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="type" value="onsite"> Onsite
                            @else
                                 <input type="radio" name="type" value="remote"> Remote &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="type" value="onsite" checked> Onsite
                            @endif
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="phone" class="col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label">Phone <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="We only use it, people don’t get to see it!" required value="{{$find->phone}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-5 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-3">
                            <button type="submit" class="btn btn-success btn-block btn-md">
                               Update
                            </button>
                        </div>
                    </div>
            </form>
    <div style="height:200px;"></div>
</div>
@endsection
