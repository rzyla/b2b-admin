<?php

namespace App\Models\Application;

use App\Models\User as Auth;

class User
{
    public ?string $avatar;
    public ?string $name;

    public function __construct(?Auth $user = null)
    {
        $this->avatar = $this->avatarUrl($user?->avatar);
        $this->name = $user?->name;
    }

    private function avatarUrl(?string $avatar)
    {
        return empty($avatar)
            ? "assets/images/avatar.png"
            : "uploads/account/".$avatar;
    }
}
