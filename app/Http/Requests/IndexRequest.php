<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Http\Request as LaravelRequest;

class IndexRequest extends Request
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
            'service_account_number.required' => 'Service Account Number is required.',
            'service_account_number.min' => 'Service Account Number must be 10 digits.',
            'service_account_number.max' => 'Service Account Number must be 10 digits.',
            'service_account_number.regex' => 'Service Account Number format is invalid.',
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
            'service_account_number' => ['required', 'min:11', 'max:11', 'regex:/^[0-9 \-]+$/']
        ];
    }
}
