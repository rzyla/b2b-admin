<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Filter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersService 
{
    public function indexInitShow() : array
    {
        return  
        [
            'search' => false
        ];
    }

    public function editInitShow() : array
    {
        return  
        [
            'basic' => false
        ];
    }

    public function grid(Filter $filter, int $pager_size)
    {
        $query = User::select('id', 'name', 'email');

        if(!empty($filter->getFilter('search')))
        {
            $query->where('name', 'like', '%' . $filter->getFilter('search') . '%')
                ->orWhere('email', 'like', '%' . $filter->getFilter('search') . '%');
        }

        if(!empty($filter->getOrderBy()))
        {
            $query->orderBy($filter->getOrderBy(), $filter->getOrderDir());
        }
 
        return $query->paginate($pager_size);
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