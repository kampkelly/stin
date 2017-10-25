@if(checkPermission(['investor', 'investor_upgrade']))
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
        <div class="container-fluid create-startup" style="padding-left: 30px">
            <h4 class="text-center">Add Your Innovation</h4>
            @include('/partials/errors')
            <form action="/startups" method="POST" class="form-horizontal" role="form" files="true" enctype="multipart/form-data">
            {{ csrf_field() }}
                    <div class="form-group">
                        <label for="startup_title" class="control-label"><small>Startup Name</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_title" id="startup_title" class="form-control" placeholder="Enter Startup Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fileupload" class="control-label"><small>Display Picture</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                        <input type="file" name="startup_image" id="fileupload" placeholder="Enter Title" class="btn btn-success">
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
                            <input type="text" name="startup_company" id="startup_company" class="form-control" placeholder="Enter Company or Group/Team Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_desc" class="control-label"><small>Brief Description</small><span class="small text-muted"> sell your idea here (not more than 150 words)</span></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <textarea name="short_desc" id="short_desc" class="form-control" rows="2" style="resize:none;" placeholder="Briefly descrbie your product"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="full_desc" class="control-label"><small>Full Description</small><span class="small text-muted"> - discuss your idea</span></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <textarea name="full_desc" id="full_desc" class="form-control" rows="5" style="resize:none;" placeholder="Describe Fully"></textarea>
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
                            <input type="text" name="startup_aim" id="startup_aim" class="form-control" placeholder="State What You intend to achieve">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_imp" class="control-label"><small>Why Its Important</small><span class="small text-muted"> (not more than 100 words)</span></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_imp" id="startup_imp" class="form-control" placeholder="What are its benefits?">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_achievements" class="control-label"><small>Notable Achievements</small><span class="small text-muted"> - seperate each with a comma</span></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_achievements" id="startup_achievements" class="form-control" placeholder="Previous Achievements">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_features" class="control-label"><small>Features</small><span class="small text-muted"> - seperate each with a comma</span></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_features" id="startup_features" class="form-control" placeholder="Product Features">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_category" class="control-label"><small>Category</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <select name="startup_category" id="startup_category" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_contacts" class="control-label"><small>Contacts</small></label>
                        <div class="col-sm-12 col-sm-offset-0">
                            <input type="text" name="startup_contacts" id="startup_contacts" class="form-control" placeholder="Group/Company/Team Contacts">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-0">
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
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
<script type="text/javascript">
    $(function () {
  $("#fileupload").change(function () {
    $("#dPreview").html("");
    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
    if (regex.test($(this).val().toLowerCase())) {
      if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
        $("#dPreview").show();
        $("#dPreview")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
      } else {
        if (typeof (FileReader) != "undefined") {
          $("#dPreview").show();
          $("#dPreview").append("<img />");
          var reader = new FileReader();
          reader.onload = function (e) {
            $("#dPreview img").attr("src", e.target.result);
          }
          reader.readAsDataURL($(this)[0].files[0]);
        } else {
          alert("This browser does not support FileReader.");
        }
      }
    } else {
      alert("Please upload a valid image file.");
    }
  });
});


</script>
@endsection
