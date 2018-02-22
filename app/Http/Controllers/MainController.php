<?php

namespace App\Http\Controllers;

use App\Account;
use App\Exceptions\TooManyAttemptsException;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\EnrollmentRequest;
use App\Http\Requests;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;


/**
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * Index Page
     *
     * @param Request $request
     * @param Account $account
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Account $account)
    {

        // Get the service_account_number if in the session and display it in the view
        $input = [
            'service_account_number' => ($request->session()->has('service_account_number')) ? $request->session()->get('service_account_number') : ''
        ];

    	return view('index')->with(['account' => $account, 'input' => $input]);
    }

    /**
     * Enrollment Page
     *
     * @param IndexRequest $request
     * @param Account $account
     * @param RateLimiter $limiter
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws TooManyAttemptsException
     */
    public function enrollment(IndexRequest $request, Account $account, RateLimiter $limiter)
    {
        // How long before the rate limiter resets
        $decayMinutes = 30; //minuets

        // Get the request unique signature
        $key = $request->fingerprint();

        /**
         * Check if they already hit the limit and throw a exceptions.
         * we catch the exception and display a view w/ message in app/Exceptions/Handler.php
         */
        if ($limiter->tooManyAttempts($key, 5, $decayMinutes)) {
            throw new TooManyAttemptsException();
        }

        // Record all the inputs into the session
        $request->session()->put($request->all());  

        //Check if user trying to skip into this step without a set service_account_number
        if(!$request->session()->has('service_account_number')){
            $request->session()->flush();
            return redirect()->route('index');
        }

        // Get the inputs if in the session and display it in the view
        $input = [
            'phone' => ($request->session()->has('phone')) ? $request->session()->get('phone') : '',
            'first_name' => ($request->session()->has('first_name')) ? $request->session()->get('first_name') : '',
            'last_name' => ($request->session()->has('last_name')) ? $request->session()->get('last_name') : '',
            'street_number' => ($request->session()->has('street_number')) ? $request->session()->get('street_number') : '',
            'street_name' => ($request->session()->has('street_name')) ? $request->session()->get('street_name') : '',
            'zip_code' => ($request->session()->has('zip_code')) ? $request->session()->get('zip_code') : '',
            'mobile_optin' => ($request->session()->has('mobile_optin')) ? $request->session()->get('mobile_optin') : '',
            'email' => ($request->session()->has('email')) ? $request->session()->get('email') : '',
            'email_optin' => ($request->session()->has('email_optin')) ? $request->session()->get('email_optin') : '',
            'on_peak_alert' => ($request->session()->has('on_peak_alert')) ? $request->session()->get('on_peak_alert') : '',
            'off_peak_alert' => ($request->session()->has('off_peak_alert')) ? $request->session()->get('off_peak_alert') : ''
        ];

        return view('enrollment')->with(['account' => $account, 'input' => $input]);
    }

    /**
     * Verification Page
     *
     * @param EnrollmentRequest $request
     * @param Account $account
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function verification(EnrollmentRequest $request, Account $account)
    {

        // Make sure that session is also updated when false 0 values are passed
        if ( $request->input('mobile_optin') != 1){
            $request->merge(array('mobile_optin' => false));
        }
        if ( $request->input('email_optin') != 1){
            $request->merge(array('email_optin' => false));
        }
        if ( $request->input('on_peak_alert') != 1){
            $request->merge(array('on_peak_alert' => false));
        }
        if ( $request->input('off_peak_alert') != 1){
            $request->merge(array('off_peak_alert' => false));
        }

        // Record all the inputs into the session
        $request->session()->put($request->all());


        //Check if user trying to skip into this step without a set service_account_number
        if(!$request->session()->has('service_account_number') || !$request->session()->has('phone') ){
            $request->session()->flush();
            return redirect()->route('index');
        }

        // Everything checks out so we display the verification page
    	return view('verification')->with('account', $account);
    }

    /**
     * Confirmation Page
     *
     * @param Request $request
     * @param Account $account
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function confirmation(Request $request, Account $account)
    {
        //Check if user trying to skip into this step without a set service_account_number or phone
        if($request->method() !== 'POST' || !$request->session()->has('service_account_number') || !$request->session()->has('phone') ){
            $request->session()->flush();
            return redirect()->route('index');
        }


        // Record all the inputs into the session
        $request->session()->put($request->all());

        // Get all the session data and update the model with it
        $account = $account->fill($request->session()->all());

        // Save the model.
        $account->save();


        // Clear inputs stored in session
        $request->session()->forget('service_account_number');
        $request->session()->forget('first_name');
        $request->session()->forget('last_name');
        $request->session()->forget('street_number');
        $request->session()->forget('street_name');
        $request->session()->forget('zip_code');
        $request->session()->forget('phone');
        $request->session()->forget('mobile_optin');
        $request->session()->forget('email');
        $request->session()->forget('email_optin');
        $request->session()->forget('on_peak_alert');
        $request->session()->forget('off_peak_alert');


        return view('confirmation')->with('account', $account);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function start_over(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('index');
    }

}
