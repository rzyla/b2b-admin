<?php

namespace App\Http\Controllers;

use App\Enums\AlertsTypesEnum;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function form(Request $request)
    {
        $this->init();

        if(Auth::check())
        {
            return redirect()
                ->intended(route('dashboard'));
        }

        return view('auth.form')
            ->with('application', $this->application)
            ->with('alertsTypesEnum', $this->alertsTypesEnum);
    }

    public function login(Request $request)
    {
        $messages = 
        [
            'email.required' => __('validation.email_required'),
            'password.required' => __('validation.password_required'),
        ];
        

        $request->validate(
        [
            'email' => 'required',
            'password' => 'required',
        ], $messages);
    
        $credentials = $request->only('email', 'password');
        $remember = !empty($request['remember']) ? true : false;

        if (Auth::attempt($credentials, $remember)) 
        {
            return redirect()
                ->intended(route('dashboard'));
        }

        return redirect()
                ->back()
                ->withErrors(__('validation.login_password_error'))
                ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        $request
            ->session()
            ->flush();
            
        Auth::logout();
   
        return redirect(route('login'));
    }
}