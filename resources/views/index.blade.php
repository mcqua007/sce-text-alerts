@extends('layout')

@section('title', 'Get Started')

@section('content')
	<h1>Time-Of-Use (TOU)<br> Text Alert Enrollment</h1>

	<p>Thank you for switching to a Time-of-Use (TOU) rate. Recognizing higher priced peak period hours, and adjusting your usage accordingly, is the best way to get the most of your new rate structure. To help you remember these key times of day, we are pleased to offer you TOU Text Alerts.</p>

	<p>TOU Text Alerts are daily text notifications, sent on <strong>weekdays only</strong>, to help remind you of on-peak and/or off-peak periods. You may select to receive alert messages when they’ll help you the most. And, if you decide you no longer want to receive text alerts, you can simply reply &ldquo;STOP&rdquo; to one of the messages and you will be promptly removed.</p>

	<p>To receive TOU Text Alerts, simply provide your service account number below and click &ldquo;Get Started.&rdquo;</p>

    @include('partials.errors')
	{!!Form::open(array('route' => ['enrollment']))!!}
		<div class="highlight-box bold-label">
			{!! Form::label('service_account_number', 'Service Account Number') !!}
			{!! Form::text('service_account_number', $input['service_account_number'], array('placeholder'=>'3-###-####-##', 'maxlength'=>'13')) !!}
		</div>

    <button type="submit">Get Started</button>
	{!!Form::close()!!}
@endsection
