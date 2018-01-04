<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $casts = [
        'updated' => 'boolean',
        'number_is_mobile' => 'boolean',
        'mobile_optin' => 'boolean',
        'email_optin' => 'boolean'
    ];

    protected $fillable = [
            'updated',
			'phone',
			'number_is_mobile',
			'mobile_optin',
			'email',
			'email_optin'
    ];

    public function last_four() {
        return substr($this->attributes['service_account_number'], -4);
    }
}
