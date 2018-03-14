@if (count($errors) > 0)
    <div id="error-box" class="alert alert-danger">
        <ul class="bullet-list">
            @foreach ($errors->all() as $error)
                {{-- Don't Show On / Off Peak Alerts Errors Here --}}
                @unless($error == 'You must choose to receive at least one of the TOU Alerts.')
                    <li>{{ $error }}</li>
                @endunless
            @endforeach
            {{-- Show On / Off Peak Alert Only Once --}}
            @if( $errors->has('on_peak_alert') || $errors->has('off_peak_alert') )
                <li>{{ $error }}</li>
            @endif
        </ul>
    </div>
@endif