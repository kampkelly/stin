@extends('layouts.new_master')


@section('content')

<div class="container docs">
	<div style="height:55px;"></div>
     <h4 class="text-center">Contact us below!<br> </h4>
     <p class="text-center"><span class="small">or send an email to support@theinnovestors.com</span></p><br><br>
            <form action="/contact" method="POST" class="form-horizontal first-form offset-sm-2 offset-md-3 offset-lg-4" role="form" files="true" enctype="multipart/form-data">
            {{ csrf_field() }}
                    <div class="form-group">
                        <label for="contact_name" class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">Name <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-7">
                            <input type="text" name="contact_name" id="contact_name" class="form-control" required="required" placeholder="Name" required="true" minlength="4">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="contact_email" class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">Email <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-7">
                            <input type="text" name="contact_email" id="contact_email" class="form-control" required="required" placeholder="Email Address" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact_msg" class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">Message <span class="asterisks">*</span></label>
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-7">
                        <textarea class="form-control" rows="5" placeholder="Your Message" name="contact_msg"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-7 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary btn-block btn-sm">
                                Send
                            </button>
                        </div>
                    </div>
            </form>
    <div style="height:200px;"></div>
</div>
@endsection
