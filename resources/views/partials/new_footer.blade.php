<footer style=" position: relative; padding-top: 2em; padding-bottom: 2em; max-height: 15em; z-index: 20 !important;">
	<div class="container">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<ul class="list-unstyled">
					<li><h6><a href="">Home</a></h6></li>
					<li><h6><a href="/about">About</a></h6></li>
					<li><h6><a href="/contact">Contact</a></h6></li>
					<li><h6><a href="/disclaimer">Disclaimer</a></h6></li>
					<li><h6><a href="/terms">Terms</a></h6></li>
				</ul>
			</div>
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="height: 10em;">
				<div class="btn-group" style="widt: 10em;">
					<a class="btn btn-primary btn-xs" href="#" role="button"><i class="fa fa-facebook-f"></i></a>
					<a class="btn btn-danger btn-xs" href="#" role="button"><i class="fa fa-google-plus"></i></a>
					<a class="btn btn-primary btn-xs" href="#" role="button"><i class="fa fa-twitter"></i></a>
					<a class="btn btn-primary btn-xs" href="#" role="button"><i class="fa fa-linkedin"></i></a>
					<a class="btn btn-prmary btn-xs cards-first" style="margin-left: 0.8em;" href="#" role="button"><i class="fa fa-cc-visa cards-icon" style="color: #1A1F71;"></i></a>
					<a class="btn btn-prmary btn-xs cards" href="#" role="button"><i class="fa fa-cc-paypal cards-icon" style="color: #005EA6;"></i></a>
					<a class="btn btn-prmary btn-xs cards" href="#" role="button"><i class="fa fa-cc-mastercard cards-icon" style="color: darkred"></i></a>
				</div>
				<ul class="list-inline">
				<li><a href="/startups">Innovations</a></li>
				@if(Auth::check())
				<li><a href="/logout">Logout</a></li>
				@endif
				</ul>
				<div style="position: absolute; bottom: 0%;">
					<p>&copy 2017 TheInnovestors<br>
					Email: support@theinnovestors.com</p>
				</div>
				
			</div>
		</div>
		
	</div>
</footer>