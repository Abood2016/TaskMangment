@component('mail::message')

Hello {{ $details['username'] }}

# {{ $details['message'] }}


   

   
Thanks,<br>
{{ config('app.name') }}
@endcomponent