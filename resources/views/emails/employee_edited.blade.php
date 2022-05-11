@component('mail::message')
<h1>{{ $EditEmployee['title'] }}</h1>
<p>Name: {{ $EditEmployee['name'] }}</p>
<p>Email: {{ $EditEmployee['email'] }}</p>
@endcomponent
Thanks,<br>
{{ config('app.name') }}