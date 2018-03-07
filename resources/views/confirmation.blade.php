
@extends('layout')

@section('title', 'Confirmation')

@section('content')
    <div class="progress-bar" role="progressbar" aria-valuenow="3" aria-valuemin="1" aria-valuemax="3"><span class="complete">Provide Info</span><span class="complete">Verify Info </span><span class="active">Confirmation</span></div>
    <h1>Confirmation</h1>
    <p class="highlight-text">Thank you for enrolling in TOU Text Alerts!</p>
    <p>You will start receiving your text alerts soon. Please allow up to five business days for your enrollment to be processed.</p>

    
    <br><br><br><br><br><br><br>
    <h2 style="color:#cccccc;">Data Below Displayed For Testing Only (To Be Removed in Production Version)</h2>
    <p><strong style="color:#cccccc;">service_account_number:</strong> 3-{{$account->service_account_number}}</p>
    <p><strong style="color:#cccccc;">first_name:</strong> {{$account->first_name}}</p>
    <p><strong style="color:#cccccc;">last_name:</strong> {{$account->last_name}}</p>
    <p><strong style="color:#cccccc;">street_number:</strong> {{$account->street_number}}</p>
    <p><strong style="color:#cccccc;">street_name:</strong> {{$account->street_name}}</p>
    <p><strong style="color:#cccccc;">zip_code:</strong> {{$account->zip_code}}</p>
    <p><strong style="color:#cccccc;">phone:</strong> 1-{{$account->phone}}</p>
	<p><strong style="color:#cccccc;">mobile_optin:</strong> <?php if ($account->mobile_optin){echo 'yes';}else{echo 'no';} ?></p>
	<p><strong style="color:#cccccc;">email:</strong> <?php if ($account->email){echo $account->email;}else{echo '-';} ?></p>
    <p><strong style="color:#cccccc;">email_optin:</strong> <?php if ($account->email_optin){echo 'yes';}else{echo 'no';} ?></p>
    <p><strong style="color:#cccccc;">on_peak_alert:</strong> <?php if ($account->on_peak_alert){echo 'yes';}else{echo 'no';} ?></p>
    <p><strong style="color:#cccccc;">off_peak_alert:</strong> <?php if ($account->off_peak_alert){echo 'yes';}else{echo 'no';} ?></p>

@endsection
