<?php

namespace App\Services;

class AuthService 
{
    public function validationMessages() : array
    {
        return 
        [
            'email.required' => __('view.validation.required.email'),
            'password.required' => __('view.validation.required.password'),
        ];
    }
}