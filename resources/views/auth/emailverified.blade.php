@extends('layouts.landing_master')

@section('content')
<?php header( "refresh:5;url=/login" ); ?>
<section>
<div style="height: 60px;"></div>
	<div class="container">
	    <p style="color: black;">Your email is verified and your account activated! You will be redirected to the login page!</p>
	</div>
	<div style="height: 320px;"></div>
</section>
@endsection
