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
            'name.required' => __('view.validation.required.first_last_name'),
            'email.required' => __('view.validation.required.email'),
            'email.email' => __('view.validation.error.email'),
            'email.unique' => __('view.validation.unique.emai'),
            'password.required' => __('view.validation.required.password'),
            'password.min' => __('view.validation.lenght.password'),
        ];
    }
}