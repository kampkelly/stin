@if(checkPermission(['investor', 'investor_upgrade']))
    <script type='text/javascript'> document.location = '/startups'; </script>
@endif
@if( Auth::user()->id != $startup->user_id )
    <script type='text/javascript'> document.location = '/startups'; </script>
@endif
@extends('layouts.new_master')

@section('content')
<!--STARTUPS ROW BEGINS-->
<div class="body-container">
<div class="row" style="position: relative;">
    @if(checkPermission(['admin']))
        @include('/partials/admin_left_sidebar')
    @else
        @include('/partials/left_sidebar')
    @endif
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
    @include('/partials/searchform')
     <section class="middle-column background-primary">
    <!--LOOP STARTUP STARTS-->
        <div class="container-fluid show-startups">
            <h4 class="text-center">Edit Innovation</h4>
            @include('/partials/errors')
            <form action="/startup/{{$startup->slug}}" method="post" value="PUT" class="form-horizontal" role="form" files="true" enctype="multipart/form-data">
            {{ csrf_field() }}
                    <div class="form-group">
                        <label for="startup_title" class="control-label">Startup Name</label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" name="startup_title" id="startup_title" class="form-control" placeholder="Enter Startup Name" value="{{$startup->title}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fileupload" class="control-label">Preview Image</label>
                        <div class="col-sm-10 col-sm-offset-2">
                        <input type="file" name="startup_image" id="fileupload" placeholder="Enter Title" class="btn btn-success">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_company" class="control-label">Company/Group Name</label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" name="startup_company" id="startup_company" class="form-control" placeholder="Enter Company or Group/Team Name" value="{{$startup->group_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_desc" class="control-label">Brief Description<span class="small text-muted"> sell your idea here (not more than 150 words)</span></label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <textarea name="short_desc" id="short_desc" class="form-control" rows="2" style="resize:none;" placeholder="Briefly descrbie your product" value="{{$startup->short_desc}}"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="full_desc" class="control-label">Full Description<span class="small text-muted"> - discuss your idea</span></label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <textarea name="full_desc" id="full_desc" class="form-control" rows="5" style="resize:none;" placeholder="Describe Fully" value="{{$startup->full_desc}}"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_aim" class="control-label">Aim</label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" name="startup_aim" id="startup_aim" class="form-control" placeholder="State What You intend to achieve" value="{{$startup->aim}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_imp" class="control-label">Why Its Important<span class="small text-muted"> (not more than 100 words)</span></label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" name="startup_imp" id="startup_imp" class="form-control" placeholder="What are its benefits" value="{{$startup->importance}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_achievements" class="control-label">Notable Achievements<span class="small text-muted"> - seperate each with a comma</span></label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" name="startup_achievements" id="startup_achievements" class="form-control" placeholder="Previous Achievements" value="{{$startup->achievements}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_features" class="control-label">Features</label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" name="startup_features" id="startup_features" class="form-control" placeholder="Product Features" value="{{$startup->features}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fileupload" class="control-label">Product photos-add images (can attach more than one):</label>
                        <div class="col-sm-10 col-sm-offset-2">
                         <input type="file" name="photos[]" class="btn btn-success" multiple />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_category" class="control-label">Category</label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <select name="startup_category" id="startup_category" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_contacts" class="control-label">Contacts</label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" name="startup_contacts" id="startup_contacts" class="form-control" placeholder="Group/Company/Team Contacts" value="{{$startup->contacts}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </div>
            </form>
        </div>
        <!--LOOP STARTUP ENDS-->
    </div>
    </section>
    @include('/partials/sidebar')
</div>
</div>
<!--STARTUPS ROW ENDS-->
<div style="height: 500px;"></div>
@endsection
