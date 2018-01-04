<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use Illuminate\Http\Request as LaravelRequest;


class CodeLookupRequest extends Request
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
            'service_account_number' => 'required|digits:4|numeric',
        ];
    }
}
