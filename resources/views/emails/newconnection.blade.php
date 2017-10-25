@component('mail::message', ['user' => $user, 'auth' => $auth])
# Hi, you have a new connection request from {{$auth->fullname}}

- You can see your connections here <a href="https://theinnovestors.com/dashboard#/{{$user->email}}/connections">here</a> 


@component('mail::button', ['url' => 'https://theinnovestors.com'])
Proceed
@endcomponent

<small> If this was a mistake, please <a href="https://theinnovestors.com/contact/"> contact us</a> </small>

@component('mail::panel', ['url' => ''])
To know more about us, visit <a href="https://theinnovestors.com/about">here</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
