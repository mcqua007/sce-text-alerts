<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    public $timestamps = false;

    protected $casts = [
        'mobile_optin' => 'boolean',
        'email_optin' => 'boolean',
        'on_peak_alert' => 'boolean',
        'off_peak_alert' => 'boolean'
    ];

    protected $fillable = [
            'service_account_number',
            'first_name',
            'last_name',
            'street_number',
            'street_name',
            'zip_code',
            'phone',
			'mobile_optin',
			'email',
            'email_optin',
            'on_peak_alert',
            'off_peak_alert'
    ];

}
