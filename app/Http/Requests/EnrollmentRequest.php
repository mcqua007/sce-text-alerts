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
            'agreement_1' => ['accepted'],
            'agreement_2' => ['accepted'],
            'phone' => ['required', 'min:7', 'max:25', 'regex:/^[\+0-9 \(\)\-]+$/'],
            'number_is_mobile' => ['boolean'],
            'mobile_optin' => ['boolean'],
            'email' => ['required_with:email_optin', 'email'],
            'email_optin' => ['boolean']
        ];
    }
}
