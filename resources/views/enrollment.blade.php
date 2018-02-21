
@extends('layout')

@section('title', 'Enrollment')

@section('content')
    <svg class="progress-bar" width="952" height="102">
        <image style="-webkit-user-select: none" xlink:href="/img/step_2.svg" src="/img/step_2.gif" width="952" height="102" alt="Progress Bar at Step 2 of 3: Enrollment"/>
    </svg>
    <h1>Enrollment</h1>
    <div class="highlight-box enrollment">
        <p>Please confirm below you want to change to the optional TOU rate.</p>

        {!! Form::open(array('route' => ['verification'])) !!}
        <div class="bold-label checkbox-label">
            {!! Form::checkbox('agreement_1', 1, true, ['id'=>'agreement_1']) !!}
            {!! Form::label('agreement_1', 'Yes! I would like my rate plan changed to the new rate.' ) !!}
        </div>
        <div class="checkbox-label">
            {!! Form::checkbox('agreement_2', 1, true, ['id'=>'agreement_2']) !!}
            {!! Form::label('agreement_2', 'I fully understand all the provisions contained in the requested optional rate schedule and that any rate analysis performed on my service account is simply an estimate of costs and savings based on available information and that my actual bill may differ from this estimate. I also understand that I have the option to choose an alternate rate plan at any time. But, if I switch to an alternate rate plan, I will not be able to make another change for a full 12 months. I further understand that service under the new TOU rate plan will typically become effective at the start of the next routine billing cycle date following SCE&#39;s processing of a rate change request. This rate change form is a free form version of CSD-179-B. All terms and conditions shall remain consistent and applicable to customers signing any effective variation of Form CSD-179-B.') !!}
        </div>
        <p class="required-text">* <span class="smaller">Indicates a Required Field</span></p>
        <div class="bold-label">
            {!! Form::label('phone', 'Phone Number') !!} <span class="required-text">*</span>
            {!! Form::text('phone', $input['phone']) !!}
        </div>
        <div class="checkbox-label">
            {!! Form::checkbox('number_is_mobile', 1, $input['number_is_mobile'], ['id'=>'number_is_mobile']) !!}
            {!! Form::label('number_is_mobile', 'Yes, this is a mobile phone number.') !!}
        </div>
        <div class="checkbox-label">
            {!! Form::checkbox('mobile_optin', 1, $input['mobile_optin'], ['id'=>'mobile_optin']) !!}
            {!! Form::label('mobile_optin', 'Yes, I would like to receive occasional text message updates from SCE, including information about rebates, savings, and promotions.') !!} <span class="smaller">Text message alerts may be subject to charges by your wireless carrier.</span>
        </div>
        <div class="bold-label">
                {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', $input['email']) !!}
        </div>
        <div class="checkbox-label">
            {!! Form::checkbox('email_optin', 1, $input['email_optin'], ['id'=>'email_optin']) !!}
            {!! Form::label('email_optin', 'Yes, I would like to receive occasional email updates from SCE, including information about rebates, savings, and promotions.') !!}
        </div>
    </div>
    <p>For further assistance please call <strong>1-866-678-7964</strong> Monday-Friday from 8 a.m. to 5 p.m.</p>
    <button type="submit">Submit</button>
    <a href="{{route('index', $account)}}" class="go-back">Go Back</a>
    {!!Form::close()!!}

@endsection
