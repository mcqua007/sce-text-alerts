<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Http\Request as LaravelRequest;

class EnrollmentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(LaravelRequest $request)
    {
        if ($request->method() !== 'POST' ) {
            return [];
        }
        return [
            'first_name' => ['required', 'regex:/^[a-zA-Z \-]+$/'],
            'last_name' => ['required', 'regex:/^[a-zA-Z \-]+$/'],
            'street_number' => ['required', 'max:10', 'regex:/^[0-9 \/\-]+$/'],
            'street_name' => ['required', 'regex:/^[0-9a-zA-Z \.\-]+$/'],
            'zip_code' => ['required', 'max:10', 'regex:/^[0-9 \-]+$/'],
            'phone' => ['required', 'min:7', 'max:25', 'regex:/^[\+0-9 \(\)\-]+$/'],
            'mobile_optin' => ['required', 'boolean'],
            'email' => ['required_with:email_optin', 'email'],
            'email_optin' => ['boolean'],
            'on_peak_alert' => ['required_without:off_peak_alert'],
            'off_peak_alert' => ['required_without:on_peak_alert']
        ];
    }
}
