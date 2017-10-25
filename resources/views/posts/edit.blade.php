@if(!checkPermission(['admin', 'superadmin']))
    <script type='text/javascript'> document.location = '/oops'; </script>
@endif
@extends('layouts.new_master')

@section('content')
<!--postS ROW BEGINS-->
<div class="body-container">
<div class="row" style="position: relative;">
     @include('/partials/admin_left_sidebar')
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
    @include('/partials/searchform')
    <section class="middle-column backgroud-primary">
    <!--LOOP post STARTS-->
        <div class="container-fluid all_innovations" style="padding-left: 30px">
            <h3 class="text-center">Edit {{$news->title}}</h3>        
	        <form action="/admin/post/{{$news->slug}}" method="POST" value="PUT" class="form-horizontal" role="form">
            {{ csrf_field() }}
                    <div class="form-group">
                        <label for="post_title" class="control-label">Title</label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="post_title" id="post_title" class="form-control" placeholder="Post Title" value="{{$news->title}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="body" class="control-label">Post Body</label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <textarea name="body" id="body" class="form-control" rows="5" style="resize:none;" placeholder="Body of Post" value="{{$news->body}}"></textarea>
                        </div>
                    </div>
                    <div id="thebody" style="display: none;"> {{$news->body}}</div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-0">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
            </form>
            
        </div>
        <!--LOOP post ENDS-->
        </section>
    </div>
    @include('/partials/sidebar')
</div>
</div>
<!--postS ROW ENDS-->
<div style="height: 500px;"></div>
<script type="text/javascript">
    $(document).ready(function () {
        var $thebody = $('#thebody').text();
        $('#body').val($thebody);
    });
</script>
@endsection