@component('mail::message', ['contact_data' => $contact_data])
# New message from {{$contact_data}}

- 

@component('mail::panel', ['url' => ''])
To know more about us, visit <a href="https://theinnovestors.com/about">here</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
