@component('mail::message')
Thanks for signing up. We just need you to verify your account that it is really you.

Please click the fllowing link to verify your account. <a href="http://theinnovestors.dev/verifyemail/{{$token}}/{{$username}}">http://theinnovestors.dev/verifyemail/{{$verification_token}}/{{$username}}</a>

@component('mail::button', ['url' => 'http://theinnovestors.dev/verifyemail/{{$token}}/{{$username}}'])
	Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
