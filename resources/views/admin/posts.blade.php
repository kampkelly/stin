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
            <h3 class="text-center">All Posts</h3>        
	            <div class="table-responsive">
	            	<table class="table table-hover">
	            		<thead>
	            			<tr>
	            				<th class="td0_5">S/N</th>
	            				<th class="td1">Title</th>
	            				<th>Admin</th>
	            				<th>Edit</th>
	            				<th>Delete</th>
	            			</tr>
	            		</thead>
	            		<tbody>
	            		@foreach($posts as $post)  
	            			<tr>
	            				<td class="td0_5">{{$loop->iteration}}</td>
	            				<td class="td1"><a href="/news/{{$post->slug}}">{{ str_limit($post->title, 50) }}</a></td>
	            				<td><a href="/innovator/profile/{{$post->user->username}}">{{$post->user->fullname}}</a></td>
	            				<td><a href="/admin/post/edit/{{$post->slug}}" class="btn btn-info btn-xs">Edit</a></td>
	            				<td><a href="/admin/post/delete/{{$post->slug}}" class="btn btn-danger btn-xs">Delete</a></td>
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
