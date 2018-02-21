<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $casts = [
        'number_is_mobile' => 'boolean',
        'mobile_optin' => 'boolean',
        'email_optin' => 'boolean'
    ];

    protected $fillable = [
            'service_account_number',
			'phone',
			'number_is_mobile',
			'mobile_optin',
			'email',
			'email_optin'
    ];

}
