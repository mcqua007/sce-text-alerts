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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required.',
            'first_name.max' => 'First Name must be less than 50 characters.',
            'first_name.regex' => 'First Name format is invalid.',

            'last_name.required' => 'Last Name is required.',
            'last_name.max' => 'Last Name must be less than 50 characters.',
            'last_name.regex' => 'Last Name format is invalid.',

            'street_number.required' => 'Street Number is required.',
            'street_number.max' => 'Street Number must be less than 10 characters.',
            'street_number.regex' => 'Street Number format is invalid.',

            'street_name.required' => 'Street Name is required.',
            'street_name.max' => 'Street Name must be less than 50 characters.',
            'street_name.regex' => 'Street Name format is invalid.',

            'zip_code.required' => 'Zip Code is required.',
            'zip_code.digits' => 'Zip Code must be 5 digits.',

            'phone.required' => 'Mobile Phone is required.',
            'phone.min' => 'Mobile Phone must be 10 digits.',
            'phone.max' => 'Mobile Phone must be 10 digits.',
            'phone.regex' => 'Mobile Phone format is invalid.',

            'mobile_optin.required' => 'You must be the authorized user of the Mobile Phone.',

            'email.required_with' => 'Email is required when choosing to receive emails.',

            'on_peak_alert.required_without' => 'You must choose to receive at least one of the TOU Alerts.',

            'off_peak_alert.required_without' => 'You must choose to receive at least one of the TOU Alerts.',
        ];
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
            'first_name' => ['required', 'max:50', 'regex:/^[0-9a-zA-Z \,\.\-\/]+$/'],
            'last_name' => ['required', 'max:50', 'regex:/^[0-9a-zA-Z \,\.\-\/]+$/'],
            'street_number' => ['required', 'max:10', 'regex:/^[0-9a-zA-Z \,\.\-\/]+$/'],
            'street_name' => ['required', 'max:50', 'regex:/^[0-9a-zA-Z \,\.\-\/]+$/'],
            'zip_code' => ['required', 'digits:5'],
            'phone' => ['required', 'min:14', 'max:14', 'regex:/^[\+0-9 \(\)\-]+$/'],
            'mobile_optin' => ['required', 'boolean'],
            'email' => ['required_with:email_optin', 'max:254', 'email'],
            'email_optin' => ['boolean'],
            'on_peak_alert' => ['required_without:off_peak_alert'],
            'off_peak_alert' => ['required_without:on_peak_alert']
        ];
    }
}
