<?php

namespace App\Http\Controllers;

use App\Account;
use App\Exceptions\TooManyAttemptsException;
use App\Http\Requests\EnrollmentRequest;
use App\Http\Requests;
use App\Http\Requests\CodeLookupRequest;
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
    public function index(Request $request ,Account $account)
    {

        // Remove any old optional inputs stored in session
        $request->session()->forget('number_is_mobile');
        $request->session()->forget('mobile_optin');
        $request->session()->forget('email_optin');

        // Get the service_account_number if in the session and display it in the view
        $input = [
            'service_account_number' => ($request->session()->has('service_account_number')) ? $request->session()->get('service_account_number') : '',
        ];

    	return view('index')->with(['account' => $account, 'input' => $input]);
    }

    /**
     * Verification Page
     *
     * @param CodeLookupRequest $request
     * @param Account $account
     * @param RateLimiter $limiter
     * @return \Illuminate\Http\Response
     * @throws TooManyAttemptsException
     */
    public function verification(CodeLookupRequest $request, Account $account, RateLimiter $limiter)
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

        //Check if user trying to skip into this step without a set service_account_number
        if(!$request->has('service_account_number') && !$request->session()->has('service_account_number')){
            // Flush the session because the users doing something sketchy
            $request->session()->flush();
            return redirect()->route('index', $account->code);
        }

        // Check if last 4 of service_account_number belongs to the 6 digit random code
        if($request->has('service_account_number') && $account->last_four() !== $request->get('service_account_number')) {
            // Only hit (count up) the rate limiter when its not a match
            $limiter->hit($key, $decayMinutes);
            return back()->withErrors(new MessageBag(['Code and service account number do not match']))->withInput($request->all());
        }

        // Write the POST service_account_number data into the session
        $request->session()->put('service_account_number', $account->last_four());

        // If the account is already enrolled lets redirect them over to the confirmation route
        if($account->updated){
            return redirect()->route('confirmation', $account->code);
        }

        // Everything checks out so we display the verification page
    	return view('verification')->with('account', $account);
    }

    /**
     * Enrollment Page
     *
     * @param Request $request
     * @param Account $account
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function enrollment(Request $request, Account $account)
    {

        //Check if user trying to skip into this step without a set service_account_number
        if(!$request->session()->has('service_account_number')){
            $request->session()->flush();
            return redirect()->route('index', $account->code);
        }

        // Check if last 4 of service_account_number belongs to the 6 digit random code
        if($account->last_four() !== $request->session()->get('service_account_number')) {
            return redirect()->route('index', $account->code)->withErrors(new MessageBag(['Code and service account number do not match']))->withInput($request->all());
        }

        // If the account is already enrolled lets redirect them over to the confirmation route
        if($account->updated){
            return redirect()->route('confirmation', $account->code);
        }

        return view('enrollment')->with('account', $account);
    }

    /**
     * Confirmation Page
     *
     * @param EnrollmentRequest $request
     * @param Account $account
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function confirmation(EnrollmentRequest $request, Account $account)
    {

        //Check if user trying to skip into this step without a set service_account_number
        if(!$request->session()->has('service_account_number')){
            $request->session()->flush();
            return redirect()->route('index', $account->code);
        }

        // Check if last 4 of service_account_number belongs to the 6 digit random code
        if($account->last_four() !== $request->session()->get('service_account_number')) {
            $request->session()->flush();
            return redirect()->route('index', $account->code)->withInput($request->all());
        }

        // Don't allow user to deep-link into the confirmation page until they complete the enrollment
        if($request->method() !== 'POST' && !$account->updated) {
            return redirect()->route('index', $account->code);
        }

        // Check if updated then update the record in the database
        if(!$account->updated){

            // Record all the inputs into the session
            $request->session()->put($request->all());

            // Get all the session data and update the model with it
            $account = $account->fill($request->session()->all());

            // Set the updated model property to true
            $account->updated = true;

            // Save the model.
            $account->save();

        }

        return view('confirmation')->with('account', $account);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function not_me(Request $request)
    {

        // Remove any old service account number in session
        if ($request->session()->has('service_account_number')) {
            $request->session()->forget('service_account_number');
        }

        return view('errors.not-me');
    }

}
