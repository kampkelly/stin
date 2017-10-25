<footer style=" position: relative; padding-top: 2em; padding-bottom: 2em; max-height: 15em; z-index: 20 !important;">
	<div class="container">
		<div class="row">
			<div class="col-xs-3 col-sm-6 col-md-6 col-lg-6">
				<ul class="list-unstyled list-inline">
					<li><h6><a href="/">Home</a></h6></li>
					<li><h6><a href="/about">About</a></h6></li>
					<li><h6><a href="/contact">Contact</a></h6></li>
					<li><h6><a href="/terms">Terms</a></h6></li>
					<li><h6><a href="/privacy">Privacy</a></h6></li>
				</ul>
			</div>
			<div class="col-xs-9 col-sm-6 col-md-6 col-lg-6" style="heigt: 10em;">
				<ul class="list-inline">
				@if(Auth::check())
				<li><h6><a href="/dashboard#/">Categories</a></h6></li>
				<li><h6><a href="/dashboard#/innovations">Innovations</a></h6></li>
				<li><h6><a href="/dashboard#/my-feeds/{{Auth::user()->username}}">My feeds</a></h6></li>
				<li><h6><a href="/dashboard#/posts">News</a></h6></li>
				<li><a href="/logout">Logout</a></li>
				@endif
				</ul>
				<div style="position: abolute; bottom: 0%;">
					<p>&copy 2017 TheInnovestors<br>
					Email: support@theinnovestors.com</p>
				</div>
				
			</div>
		</div>
		
	</div>
</footer>