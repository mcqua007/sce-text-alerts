
@extends('layout')

@section('title', 'Account Verification')

@section('content')
    <svg class="progress-bar" width="952" height="102">
        <image style="-webkit-user-select: none" xlink:href="/img/step_1.svg" src="/img/step_1.gif" width="952" height="102" alt="Progress Bar at Step 1 of 3: Account Verification"/>
    </svg>
    <h1>Account Verification</h1>
    <p>Please confirm your account information and continue.</p>

    <div class="highlight-box">
        <p><strong>Service Account Number ending in:</strong> {{$account->last_four()}}</p>
        <p><strong>Service Address:</strong> {{$account->address}}</p>
    </div>
    {!!Form::open(array('route' => ['enrollment', $account->code]))!!}
    <button type="submit">Continue</button>
    <a href="{{route('index', $account->code)}}" class="go-back">Go Back</a>
    <a href="{{route('not-me', $account->code)}}" class="not-me">This is not my Account</a>
    {!!Form::close()!!}

@endsection
