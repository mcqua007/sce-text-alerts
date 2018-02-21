
@extends('layout')

@section('title', 'Account Verification')

@section('content')
    <svg class="progress-bar" width="952" height="102">
        <image style="-webkit-user-select: none" xlink:href="/img/step_1.svg" src="/img/step_1.gif" width="952" height="102" alt="Progress Bar at Step 1 of 3: Account Verification"/>
    </svg>
    <h1>Account Verification</h1>
    <p>Please confirm your account information and continue.</p>

    <div class="highlight-box">
        <p><strong>Service Account Number: </strong>{{Session::get('service_account_number')}}</p>
        <p><strong>Phone Number: </strong>{{Session::get('phone')}}</p>
        <p><strong>Number is Mobile: </strong>{{Session::get('number_is_mobile')}}</p>
        <p><strong>Mobil Opt In: </strong>{{Session::get('mobile_optin')}}</p>
        <p><strong>Email: </strong>{{Session::get('email')}}</p>
        <p><strong>Email Opt In: </strong>{{Session::get('email_optin')}}</p>
    </div>
    {!!Form::open(array('route' => ['confirmation']))!!}
    <button type="submit">Continue</button>
    <a href="{{route('enrollment')}}" class="go-back">Go Back</a>
    <a href="{{route('not-me')}}" class="not-me">This is not my Account</a>
    {!!Form::close()!!}

@endsection
