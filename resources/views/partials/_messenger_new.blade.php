<section class="messenger_container">

	<div class="">
		<div class="bg-info fixed-bottom messenger_preview rounded pt-2 clearfix text-center">
		<span class="float-right mt-1 pr-2"> <i class="fa fa-expand float-right" aria-hidden="true"></i> </span>	
		<p>Messages (3)</p> 
		</div>
	</div>

	<div class="bg-secondary messenger">
		<h5 class="text-center pt-2">  <span class="float-right mr-2 minimize_messenger"><i class="fa fa-window-minimize" aria-hidden="true" style="color: white;"></i></span> Messages</h5>
		<ul class="list-group" style="overflow-y: scroll; max-height:360px; height:360px;">
			@foreach($userfriends as $friend)
				@foreach($threads as $thread)
					@if( ($friend->id == $thread->sender_id && Auth::user()->id == $thread->receiver_id) || (Auth::user()->id == $thread->sender_id && $friend->id == $thread->receiver_id) )
					<router-link tag="a" to="/innovation/create" class="btn btn-success btn-sm">
			           {{$friend->fullname}}
			          </router-link>
						 
					@endif
				@endforeach
			@endforeach
		
		  <li class="list-group-item d-flex justify-content-between align-items-center">
		    Mary
		    <span class="badge badge-primary badge-pill">1</span>
		  </li>
		</ul>
	</div>

</section>