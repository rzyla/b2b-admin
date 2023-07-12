<?php

namespace App\Http\Controllers;

use App\Enums\AlertsTypesEnum;
use App\Http\Controllers\BaseController;
use App\Services\AuthService;
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

    public function login(Request $request, AuthService $authService)
    {
        $request->validate(
        [
            'email' => 'required',
            'password' => 'required',
        ], 
        $authService->validationMessages());
    
        $credentials = $request->only('email', 'password');
        $remember = !empty($request['remember']) ? true : false;

        if (Auth::attempt($credentials, $remember)) 
        {
            return redirect()
                ->intended(route('dashboard'));
        }

        return redirect()
                ->back()
                ->withErrors(__('view.validation.error.login_password'))
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