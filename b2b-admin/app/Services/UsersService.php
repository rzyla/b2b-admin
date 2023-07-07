<?php

namespace App\Services;

use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersService 
{
    public function grid(Application $application)
    {
        $query = User::select('id', 'name', 'email');

        if(!empty($application->getFilter('search')))
        {
            $query->where('name', 'like', '%' . $application->getFilter('search') . '%')
                ->orWhere('email', 'like', '%' . $application->getFilter('search') . '%');
        }

        if(!empty($application->getOrderBy()))
        {
            $query->orderBy($application->getOrderBy(), $application->getOrderDir());
        }
 
        return $query->paginate($application->paginate());
    }

    public function getUser($id) : User
    {
        return User::where('id', $id)->first();
    }

    public function createUser(array $input) : User
    {
        if(!empty($input['password']))
        {
            $input['password'] = Hash::make($input['password']);
        }
        else
        {
            unset($input['password']);
        }

        return User::create($input);
    }

    public function updateUser(array $input, $id) : User
    {
        if(!empty($input['password']))
        {
            $input['password'] = Hash::make($input['password']);
        }
        else
        {
            unset($input['password']);
        }

        $user = User::where('id', $id)->first();
        $user->update($input);

        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function validationMessages() : array
    {
        return 
        [
            'name.required' => __('validation.first_last_name_required'),
            'email.required' => __('validation.email_required'),
            'email.email' => __('validation.email_email_is_not_email'),
            'email.unique' => __('validation.email_unique'),
            'password.required' => __('validation.password_required'),
            'password.min' => __('validation.password_to_short'),
        ];
    }
}