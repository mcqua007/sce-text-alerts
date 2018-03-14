
@extends('layout')

@section('title', 'Confirmation')

@section('content')
    <div class="progress-bar" role="progressbar" aria-valuenow="3" aria-valuemin="1" aria-valuemax="3"><span class="complete">Provide Info</span><span class="complete">Verify Info </span><span class="active">Confirmation</span></div>
    <h1>Confirmation</h1>
    <p class="highlight-text">Thank you for enrolling in TOU Text Alerts!</p>
    <p>You will start receiving your text alerts soon. Please allow up to five business days for your enrollment to be processed.</p>
    <a href="{{route('start-over')}}" class="basic-link">Enroll another mobile number</a> 
@endsection
