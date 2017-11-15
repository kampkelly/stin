@component('mail::message', ['user' => $user])
# Welcome {{$user->fullname}} - Thanks for signing up at Theinnovestors

You can get started from the links below

- Pitch your innovation <a href="https://theinnovestors.com/innovation/create">here</a> 

- You can see your profile <a href="https://theinnovestors.com/dashboard#/innovator/profile/{{$user->email}}">here</a> 


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
