
@extends('layout')

@section('title', 'Enrollment')

@section('content')
    <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3"><span class="active">Provide Info</span><span>Verify Info</span><span>Confirmation</span></div>
    <h1>Enrollment</h1>
    <p>Please complete the form below. Remember, a valid mobile number is required to receive text message alerts.</p>
    <p>When selecting the alerts you would like to receive, please note, alerts will be sent at the beginning of the peak period(s) you select and on <strong>weekdays only</strong>. The on-peak alert would come between 2pm and 5pm, and the off-peak alert would come between 8pm and 9pm, depending on your TOU rate's peak hours.</p>
    <div class="alert-graphics">
        <div class="col1">
            <img src="/img/on-peak.png" alt="On-Peak Alert Time Graphic" />
            <p><strong>On-Peak</strong> Start Text Alert<br> 2pm-5pm</p>
        </div>
        <div class="col1">
            <img src="/img/off-peak.png" alt="Off-Peak Alert Time Graphic" />
            <p><strong>Off-Peak</strong> Start Text Alert<br> 8pm-9pm</p>
        </div>
    </div>

    @include('partials.errors')
    <div class="highlight-box enrollment">
        {!! Form::open(array('route' => ['verification'])) !!}
        <p class="required-text">* <span class="smaller">Indicates a Required Field</span></p>
        <div class="name-group">
            <div class="first-name bold-label">
                {!! Form::label('first_name', 'First Name') !!} <span class="required-text">*</span>
                {!! Form::text('first_name', $input['first_name'], array('placeholder'=>'Jane', 'maxlength'=>'50')) !!}
            </div>
            <div class="last-name bold-label">
                {!! Form::label('last_name', 'Last Name') !!} <span class="required-text">*</span>
                {!! Form::text('last_name', $input['last_name'], array('placeholder'=>'Doe', 'maxlength'=>'50')) !!}
            </div>
        </div>
        <div class="service-address-group">
            <div class="bold-label">
                <p>Service Address: <span class="required-text">*</span></p>
            </div>
            <div class="street-number">
                {!! Form::label('street_number', 'Street Number') !!} <span class="required-text">*</span>
                {!! Form::text('street_number', $input['street_number'], array('placeholder'=>'####', 'maxlength'=>'10')) !!}
            </div>
            <div class="street-name">
                {!! Form::label('street_name', 'Street Name') !!} <span class="required-text">*</span>
                {!! Form::text('street_name', $input['street_name'], array('placeholder'=>'Main St.', 'maxlength'=>'50')) !!}
            </div>
            <div class="zip-code">
                {!! Form::label('zip_code', 'Zip Code') !!} <span class="required-text">*</span>
                {!! Form::text('zip_code', $input['zip_code'], array('placeholder'=>'#####', 'maxlength'=>'5')) !!}
            </div>
        </div>
        <div class="contact-group">
            <div class="phone-group">
                <div class="bold-label">
                    {!! Form::label('phone', 'Mobile Phone') !!} <span class="required-text">*</span>
                    {!! Form::text('phone', $input['phone'], array('placeholder'=>'(###)-###-####', 'maxlength'=>'14')) !!}
                </div>
                <div class="checkbox-label">
                    {!! Form::checkbox('mobile_optin', 1, $input['mobile_optin'], ['id'=>'mobile_optin']) !!}
                    <label for="mobile_optin"><span class="required-text">*</span> Yes, I am the authorized user of this mobile number.</label>
                </div>
            </div>
            <div class="email-group">
                <div class="bold-label">
                    {!! Form::label('email', 'Email Address') !!}
                    {!! Form::text('email', $input['email'], array('placeholder'=>'email@example.com', 'maxlength'=>'254')) !!}
                </div>
                <div class="checkbox-label">
                    {!! Form::checkbox('email_optin', 1, $input['email_optin'], ['id'=>'email_optin']) !!}
                    {!! Form::label('email_optin', 'Yes, I agree to receive occasional emails from Southern California Edison.') !!}
                </div>
            </div>
        </div>
        <div class="bold-label alert-choices">
            <p>Please Select All That Apply: <span class="required-text">*</span></p>
        </div>
        <div class="checkbox-label">
            {!! Form::checkbox('on_peak_alert', 1, $input['on_peak_alert'], ['id'=>'on_peak_alert']) !!}
            <label for="on_peak_alert">Yes, I would like to receive a text alert at the beginning of the <strong>ON-PEAK</strong> Period. (when rates are higher)</label>
            <span class="smaller">Text message alerts may be subject to charges by your wireless carrier.</span>
        </div>
        <div class="checkbox-label">
            {!! Form::checkbox('off_peak_alert', 1, $input['off_peak_alert'], ['id'=>'off_peak_alert']) !!}
            <label for="off_peak_alert">Yes, I would like to receive a text alert at the beginning of the <strong>OFF-PEAK</strong> Period. (when rates are lower)</label>
            <span class="smaller">Text message alerts may be subject to charges by your wireless carrier.</span>
        </div>
    </div>
    <button type="submit">Submit</button>
    <a href="{{route('index', $account)}}" class="go-back">Go Back</a>
    {!!Form::close()!!}

@endsection
