@component('mail::message')
# News Notification


<b>Author:</b> {{ $details['author'] }} <br>
<b>Title:</b> {{ $details['title'] }} <br>
<b>Date:</b> {{ date('d M Y', strtotime($details['date'])) }} <br>
<b>Content:</b> {!! $details['content'] !!} <br>



Thanks,<br>
{{ config('app.name') }}
@endcomponent
