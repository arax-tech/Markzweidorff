@component('mail::message')
# Document Status is Updated



@component('mail::panel')
	<b>User Name:</b> {{ $details['userName'] }} <br>
	<b>User Email:</b> {{ $details['userEmail'] }} <br>
	<b>User Phone:</b> {{ $details['userPhone'] }} <br>
	<b>User Address:</b> {{ $details['userAddress'] }} <br>
	<b>Reason:</b> {{ $details['reason'] }} <br>
	<b>Document Title:</b> {{ $details['title'] }} <br>
	<b>Document Subtitle:</b> {{ $details['subtitle'] }} <br>
	<b>Document Status:</b> {{ $details['status'] }} <br>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent