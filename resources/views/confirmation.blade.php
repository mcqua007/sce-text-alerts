
@extends('layout')

@section('title', 'Confirmation')

@section('content')
    <h1>Confirmation</h1>
    <p class="highlight-text">Thank you for enrolling in TOU Text Alerts!</p>
    <p>You will start receiving your text alerts soon. Please allow up to five business days for your enrollment to be processed.</p>

    
    <br><br><br><br><br><br><br>
    <h2 style="color:#cccccc;">Data Below Displayed For Testing Only (To Be Removed in Production Version)</h2>
    <p><strong style="color:#cccccc;">service_account_number:</strong> {{$account->service_account_number}}</p>
    <p><strong style="color:#cccccc;">first_name:</strong> {{$account->first_name}}</p>
    <p><strong style="color:#cccccc;">last_name:</strong> {{$account->last_name}}</p>
    <p><strong style="color:#cccccc;">street_number:</strong> {{$account->street_number}}</p>
    <p><strong style="color:#cccccc;">street_name:</strong> {{$account->street_name}}</p>
    <p><strong style="color:#cccccc;">zip_code:</strong> {{$account->zip_code}}</p>
    <p><strong style="color:#cccccc;">phone:</strong> {{$account->phone}}</p>
	<p><strong style="color:#cccccc;">mobile_optin:</strong> <?php if ($account->mobile_optin){echo 'yes';}else{echo 'no';} ?></p>
	<p><strong style="color:#cccccc;">email:</strong> <?php if ($account->email){echo $account->email;}else{echo '-';} ?></p>
    <p><strong style="color:#cccccc;">email_optin:</strong> <?php if ($account->email_optin){echo 'yes';}else{echo 'no';} ?></p>
    <p><strong style="color:#cccccc;">on_peak_alert:</strong> <?php if ($account->on_peak_alert){echo 'yes';}else{echo 'no';} ?></p>
    <p><strong style="color:#cccccc;">off_peak_alert:</strong> <?php if ($account->off_peak_alert){echo 'yes';}else{echo 'no';} ?></p>

@endsection
