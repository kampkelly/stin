@if(!checkPermission(['admin', 'superadmin']))
    <script type='text/javascript'> document.location = '/oops'; </script>
@endif
@extends('layouts.new_master')

@section('content')
<!--STARTUPS ROW BEGINS-->
<div class="body-container">
<div class="row" style="position: relative;">
     @include('/partials/admin_left_sidebar')
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
    @include('/partials/searchform')
    <section class="middle-column backgroud-primary">
    <!--LOOP STARTUP STARTS-->
        <div class="container-fluid">
            <h4 class="text-center">Edit {{$category->name}} Category</h4>
            @include('/partials/errors')
            <form action="/category/{{$category->id}}" method="post" value="PUT" class="form-horizontal" role="form" files="true" enctype="multipart/form-data">
            {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="control-label">Category Name</label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" name="name" id="name" value="{{$category->name}}" class="form-control" placeholder="Enter Category Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Brief Description</label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" name="description" id="description" value="{{$category->description}}" class="form-control" placeholder="Enter Category Description">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="fileupload" class="control-label">Image</label>
                        <div class="col-sm-10 col-sm-offset-2">
                        <input type="file" name="image" class="btn btn-success">
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
    </section>
    </div>
    @include('/partials/sidebar')
</div>
</div>
<!--STARTUPS ROW ENDS-->
<div style="height: 500px;"></div>
@endsection
