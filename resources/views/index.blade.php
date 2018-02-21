@extends('layout')

@section('title', 'Get Started')

@section('content')

	<img src="/img/woman_with_laptop.jpg" alt="Man with tablet">

	<h1>Maintain Control and Maximize Savings</h1>

	<p>Switching to the optional rate. plan is easy, and you always have the opportunity to change back. To make the switch, please enter the last four digits of your Service Account Number found at the bottom of the letter you received or found on your SCE bill.</p>

	{!!Form::open(array('route' => ['enrollment']))!!}
		<div class="highlight-box bold-label">
			{!! Form::label('service_account_number', 'Service Account Number') !!} <span class="smaller">(last 4 digits only)</span>
			{!! Form::text('service_account_number', $input['service_account_number']) !!}
		</div>
		<p>You can still manage your monthly costs and realize the projected savings from the new optional rate. Additionally, you could achieve even greater savings by shifting some of your electricity use to the lower cost time periods.</p>
		<p>For further assistance please call <strong>1-866-678-7964</strong> Monday-Friday from 8 a.m. to 5 p.m.</p>

    <button type="submit">Get Started</button>
	{!!Form::close()!!}
@endsection
