<?php

namespace App\Services;

use App\Helpers\ImageHelper;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;

class AccountService 
{

    public function updateUserAvatar(Application $application, Request $request, $id) : User
    {
        $input = $request->all();
        $user = User::where('id', $id)->first();

        if (!empty($input['deleteAvatar']))
        {
            ImageHelper::Delete($application, $user, 'avatar');
        }
            
        if (!empty($input['avatar']) || !empty($input['deleteAvatar']))
        {
            $input['avatar'] = ImageHelper::Save($application, $request, 'avatar');
            $user->update(['avatar' => $input['avatar']]);
        }

        return $user;
    }

    public function validationMessages() : array
    {
        return 
        [
            'name.required' => __('view.validation.required.first_last_name'),
            'email.required' => __('view.validation.required.email'),
            'email.email' => __('view.validation.error.email'),
            'email.unique' => __('view.validation.unique.emai'),
            'password.required' => __('view.validation.required.password'),
            'password.min' => __('view.validation.lenght.password'),
        ];
    }
}