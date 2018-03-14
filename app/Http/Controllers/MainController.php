<?php

namespace App\Http\Controllers;

use App\Account;
use App\Exceptions\TooManyAttemptsException;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\EnrollmentRequest;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;


/**
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{

    private function verifySessionHasInputs(Array $array, $session) {
        $inputVerification = array_map(function($key) use ($array, $session)  {
            return $session->has($key);
        }, $array);
        return !in_array(false, $inputVerification);
    }

    /**
     * Index Page
     *
     * @param Request $request
     * @param Account $account
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Account $account)
    {
        if ($request->session()->has('saved')) {
            $request->session()->flush();
            return redirect()->route('index');
        }

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
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws TooManyAttemptsException
     */
    public function enrollment(IndexRequest $request, Account $account)
    {
        if ($request->session()->has('saved')) {
            $request->session()->flush();
            return redirect()->route('index');
        }

         // Get the inputs if in the session and display it in the view
        $getInput = function() use ($request) {
            return [
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
        };

        // MUST be before everything. Check if user trying to skip into this step without a set service_account_number
        if($request->method() !== 'POST'){
            //Array of required session keys to display page via Get
            $requiredInStep = [
                'service_account_number',
            ];
            // Check if they're set in session
            if($this->verifySessionHasInputs($requiredInStep, $request->session())){
                // Good render page
                return view('enrollment')->with(['account' => $account, 'input' => $getInput()]);
            } else {
                // Bad redirect
                $request->session()->flush();
                return redirect()->route('index');
            }
        }

        // Record all the inputs into the session
        $request->session()->put($request->all());

        return view('enrollment')->with(['account' => $account, 'input' => $getInput()]);
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
        if ($request->session()->has('saved')) {
            $request->session()->flush();
            return redirect()->route('index');
        }

        //Check if user trying to skip into this step without a set service_account_number
        if($request->method() !== 'POST'){
            //Array of required session keys to display page
            $requiredInStep = [
                'phone',
                'first_name',
                'last_name',
                'street_number',
                'street_name',
                'zip_code',
                'mobile_optin',
                'service_account_number',
            ];
            // Check if they're set in session
            if($this->verifySessionHasInputs($requiredInStep, $request->session())){
                // Good render page
                return view('verification')->with('account', $account);
            } else {
                // Bad redirect
                $request->session()->flush();
                return redirect()->route('index');
            }
        }

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

        if($request->method() !== 'POST'){
            //Array of required session keys to display page
            $requiredInStep = [
                'phone',
                'first_name',
                'last_name',
                'street_number',
                'street_name',
                'zip_code',
                'mobile_optin',
                'service_account_number',
            ];
            // Check if they're set in session
            if($this->verifySessionHasInputs($requiredInStep, $request->session())){
                // Good render page
                return view('confirmation')->with('account', $account);
            } else {
                // Bad redirect
                $request->session()->flush();
                return redirect()->route('index');
            }
        }


        // Record all the inputs into the session
        $request->session()->put($request->all());

        // Get all the session data and update the model with it
        $account = $account->fill($request->session()->all());

        //Clean the SAN (remove dashes and leading 0s)
        $originalSAN = $request->session()->get('service_account_number');
        $cleanSAN = str_replace('-','',$originalSAN);
        $cleanSAN = ltrim($cleanSAN, '0');
        $account->service_account_number = $cleanSAN;

        //Clean the Mobile number (remove parentheses and dashes then add a 1 to start of number)
        $originalPhone = $request->session()->get('phone');
        $cleanPhone = '1' . str_replace(array('-',' ','(',')'),'',$originalPhone);
        $account->phone = $cleanPhone;

        if (!$request->session()->has('saved')) {
            // Save the model.
            $account->save();
            $request->session()->put('saved', true);
        }


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
