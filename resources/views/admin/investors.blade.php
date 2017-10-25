@if(!checkPermission(['admin', 'superadmin']))
    <script type='text/javascript'> document.location = '/oops'; </script>
@endif
@extends('layouts.new_master')

@section('content')
<div class="container">
        
</div>
<!--STARTUPS ROW BEGINS-->
<div class="body-container">
<div class="row" style="position: relative;">
     @include('/partials/admin_left_sidebar')
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
    <section class="middle-column backgroud-primary">
    <!--LOOP STARTUP STARTS-->
        <div class="container-fluid all_innovations" style="padding-left: 30px">
            <h3 class="text-center">Investors</h3>        
	            <div class="table-responsive">
	            	<table class="table table-hover">
	            		<thead>
	            			<tr>
	            				<th class="td0_5">S/N</th>
	            				<th class="td1">Fullname</th>
	            				<th>Type</th>
	            				<th>Status</th>
	            				<th>Put on hold</th>
	            				<th>Block</th>
	            				<th>Approve</th>
	            			</tr>
	            		</thead>
	            		<tbody>
	            		@foreach($users as $user)  
	            			<tr>
	            				<td class="td0_5">{{$loop->iteration}}</td>
	            				<td class="td1"><a href="/investor/profile/{{$user->username}}">{{ str_limit($user->company_name, 50) }}</a></td>
	            				<td>Investor</td>
	            				<td>{{$user->status}}</td>
	            				<td><a href="/admin/innovators/hold/{{$user->username}}" class="btn btn-info btn-xs">Put on hold</a></td>
	            				<td><a href="/admin/innovators/block/{{$user->username}}" class="btn btn-danger btn-xs">Block</a></td>
	            				<td><a href="/admin/innovators/approve/{{$user->username}}" class="btn btn-success btn-xs">Approve</a></td>
	            			</tr>
	            		 @endforeach
	            		</tbody>
	            	</table>
	            </div>
           
            
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
