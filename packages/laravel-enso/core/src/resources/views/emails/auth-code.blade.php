@component('mail::message')
{{ __('Hi :name', ['name' => $name]) }},

{{ __("We've noticed you are logging-in from a new location.") }}
{{ __('Please use the following code to login to the system:', ['code' => $code]) }} 
<strong>{{$code}}</strong>

{{ __('Thank you') }},<br>
{{ __(config('app.name')) }}
@endcomponent
