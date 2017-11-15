@component('mail::message', ['sender' => $sender, 'sender' => $receiver])
# Hi {{$receiver->fullname}}, you have a new message from {{$sender->fullname}}

- You can see your messages here <a href="https://theinnovestors.com/dashboard#/{{$receiver->username}}/threads">here</a> 


@component('mail::button', ['url' => 'https://theinnovestors.com'])
Home
@endcomponent

<small> If this was a mistake, please <a href="https://theinnovestors.com/contact/"> contact us</a> </small>

@component('mail::panel', ['url' => ''])
To know more about us, visit <a href="https://theinnovestors.com/about">here</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
