
@extends('layout')

@section('title', 'Verification')

@section('content')
    <h1>Verification</h1>
    <p>Please confirm your account information.</p>

    <div class="highlight-box">
        <p><strong>Service Account Number: </strong>{{Session::get('service_account_number')}}</p>
        <p><strong>Name: </strong>{{Session::get('last_name')}}, {{Session::get('first_name')}}</p>
        <p><strong>Service Address: </strong>{{Session::get('street_number')}} {{Session::get('street_name')}}, {{Session::get('zip_code')}}</p>
        <p><strong>Mobile Phone: </strong>{{Session::get('phone')}}</p>
        <p><strong>Text Alerts: </strong>@if( Session('on_peak_alert') == 1 )On-Peak @endif @if( Session('on_peak_alert') == 1 && Session('off_peak_alert') == 1 ) &amp; @endif
            @if( Session('off_peak_alert') == 1 )Off-Peak @endif</p>
        <p><strong>Email Address: </strong>{{Session::get('email')}}</p>
        <p><strong>Receive Email Alerts: </strong>@if( Session('email_optin') == 1 )Yes @else No @endif</p>
    </div>
    <h2>Terms and Conditions</h2>
    

    <p>For customers enrolled in TOU Text Alerts, Southern California Edison (SCE) will send daily notifications of peak hours based on the selected alert choice. Notifications can be delivered through text messages only. Message and data rates may apply. SCE does not guarantee receipt of text alerts. As a user of TOU Text Alerts, it is your responsibility to ensure that SCE has current and accurate contact information. Enrolled customers can update their alert selection or terminate participation in the program at any time by responding &ldquo;STOP&rdquo; or contacting SCE at 800-655-4555.</p>
    {!!Form::open(array('route' => ['confirmation']))!!}
    <button type="submit">Enroll Now</button>
    <a href="{{route('enrollment')}}" class="go-back">Go Back</a>
    <a href="{{route('start-over')}}" class="start-over">Start Over</a>
    {!!Form::close()!!}

@endsection


