@extends('layout')

@section('title', 'Get Started')

@section('home-header')
	<div class="home-header">
		<div class="image">
			<img src="/img/couple-in-kitchen.jpg" alt="Husband shows wife a recently received text alert while in their kitchen" />
		</div>
		<div class="text">
			<div class="text-inner-wrap">
				<h1>Time-Of-Use (TOU)<br> Text Alert Enrollment</h1>
				<img src="/img/off-peak.png" alt="Clock and mobile device receiving a text alert." />
			</div>
		</div>
	</div>
@endsection

@section('content')
	<p>Thank you for switching to a Residential Time-of-Use (TOU) rate. Recognizing higher priced peak period hours, and adjusting your usage accordingly, is the best way to get the most of your new rate structure. To help you remember these key times of day, we are pleased to offer you TOU Text Alerts.</p>

	<p>TOU Text Alerts are daily text notifications, sent on <strong>weekdays only</strong>, to help remind you of on-peak and/or off-peak periods. You may select to receive alert messages when they’ll help you the most. And, if you decide you no longer want to receive text alerts, you can simply reply &ldquo;END&rdquo; to one of the messages and you will be promptly removed.</p>

	<p>To receive TOU Text Alerts, simply provide your service account number below and click &ldquo;Get Started.&rdquo;</p>

    @include('partials.errors')
	{!!Form::open(array('route' => ['enrollment']))!!}
		<div class="highlight-box bold-label">
			{!! Form::label('service_account_number', 'Service Account Number') !!}
			<div class="input-wrap">
				<div class="pre-input">3-</div>
				{!! Form::text('service_account_number', $input['service_account_number'], array( 'placeholder'=>'###-####-##', 'maxlength'=>'11')) !!}
			</div>
		</div>

    <button type="submit">Get Started</button>
	{!!Form::close()!!}
@endsection
