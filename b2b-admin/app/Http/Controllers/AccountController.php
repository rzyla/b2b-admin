<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Services\AccountService;
use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccountController extends BaseController
{
    function __construct()
    {
        parent::__construct('account');
    }

    public function edit()
    {
        $this->init();

        $user = Auth::user();

        return view('account.edit')
            ->with('application', $this->application)
            ->with('user', $user);
    }

    public function update(Request $request, AccountService $accountService, UsersService $usersService)
    {
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique(app(User::class)->getTable())->ignore(Auth::id())],
        ], 
        $accountService->validationMessages());
        
        $validator->sometimes('password', 'required|min:'.$this->application->minimumPasswordLength(), function ($input) 
        {
            return !empty($input->password);
        });
        
        if ($validator->fails()) 
        {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->except(['password']));
        }

        $input = $request->all();
        $usersService->updateUser($input, Auth::id());
        $accountService->updateUserAvatar($this->application, $request, Auth::id());

        return redirect()
            ->route('account')
            ->with('success', __('view.message.success.edit'));
    }
}