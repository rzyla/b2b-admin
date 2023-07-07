<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\BaseController;
use App\Helpers\ImageHelper;
use App\Models\User;
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

    public function show()
    {
        $this->init();

        $user = Auth::user();

        return view('account.show')
            ->with('application', $this->application)
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        $messages = 
        [
            'name.required' => __('validation.first_last_name_required'),
            'email.required' => __('validation.email_required'),
            'email.email' => __('validation.email_email_is_not_email'),
            'email.unique' => __('validation.email_unique'),
            'password.required' => __('validation.password_required'),
            'password.min' => __('validation.password_to_short'),
        ];
        
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
        ], $messages);
        
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
        $user = User::find(Auth::id());
    
        if(!empty($input['password']))
        {
            $input['password'] = Hash::make($input['password']);
        }
        else
        {
            unset($input['password']);
        }

        if (!empty($input['deleteAvatar']))
        {
            ImageHelper::Delete($this->application, $user, 'avatar');
        }
        
        if (!empty($input['avatar']) || !empty($input['deleteAvatar']))
        {
            $input['avatar'] = ImageHelper::Save($this->application, $request, 'avatar');
        }

        $user->update($input);

        return redirect()
            ->route('account')
            ->with('success', __('messages.edit_success'));
    }
}