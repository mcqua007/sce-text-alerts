
@extends('layout')

@section('title', 'Confirmation')

@section('content')
    <svg class="progress-bar" width="952" height="102">
        <image style="-webkit-user-select: none" xlink:href="/img/step_3.svg" src="/img/step_3.gif" width="952" height="102" alt="Progress Bar at Step 3 of 3: Confirmation"/>
    </svg>
    <h1>Confirmation</h1>
    <p class="highlight-text">Thank you. Your rate plan change request was successful!</p>
    <p>We are committed to helping you manage your energy use and costs. If you have any questions, please call <strong>1-866-678-7964</strong> Monday-Friday from 8 a.m. to 5 p.m. or visit <a class="basic-link" href="http://on.sce.com/residentialrates" target="_blank">on.sce.com/residentialrates</a>.</p>
    
    <h2 style="color:#cccccc;">Data Below Displayed For Testing Only</h2>
	<p><strong style="color:#cccccc;">phone:</strong> {{$account->phone}}</p>
	<p><strong style="color:#cccccc;">number_is_mobile:</strong> <?php if ($account->number_is_mobile){echo 'yes';}else{echo 'no';} ?></p>
	<p><strong style="color:#cccccc;">mobile_optin:</strong> <?php if ($account->mobile_optin){echo 'yes';}else{echo 'no';} ?></p>
	<p><strong style="color:#cccccc;">email:</strong> <?php if ($account->email){echo $account->email;}else{echo '-';} ?></p>
	<p><strong style="color:#cccccc;">email_optin:</strong> <?php if ($account->email_optin){echo 'yes';}else{echo 'no';} ?></p>

@endsection
