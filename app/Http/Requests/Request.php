<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



abstract class Request extends FormRequest
{
    public function response(array $errors)
    {
        if ($this->ajax() || $this->wantsJson()) {
            return new JsonResponse($errors, 422);
        }

        return $this->redirector->to($this->getRedirectUrl().'#error-box')
                                        ->withInput($this->except($this->dontFlash))
                                        ->withErrors($errors, $this->errorBag);
    }
}
