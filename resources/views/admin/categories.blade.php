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
            <h3 class="text-center">All categories</h3>        
	            <div class="table-responsive">
	            	<table class="table table-hover">
	            		<thead>
	            			<tr>
	            				<th class="td0_5">S/N</th>
	            				<th class="td1">Name</th>
	            				<th>Edit</th>
	            				<th>Remove</th>
	            			</tr>
	            		</thead>
	            		<tbody>
	            		@foreach($categories as $category)  
	            			<tr>
	            				<td class="td0_5">{{$loop->iteration}}</td>
	            				<td class="td1"><a href="/category/{{$category->id}}">{{ str_limit($category->name, 50) }}</a></td>
	            				<td><a href="/category/edit/{{$category->id}}" class="btn btn-info btn-xs">Update</a></td>
	            				@if(checkPermission(['superadmin']))
	            				<td><a href="/category/remove/{{$category->id}}" class="btn btn-danger btn-xs">Remove</a></td>
	            				@endif
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
