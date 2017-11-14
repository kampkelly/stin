@component('mail::message', ['user' => $user])
# Hi {{$user->fullname}}, we have received your request for team member(s) at Theinnovestors.

- Thank you for this request, we will get in touch with you shortly. Meanwhile you can see and manage your requests <a href="https://theinnovestors.com/myrequests">here</a>  


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
