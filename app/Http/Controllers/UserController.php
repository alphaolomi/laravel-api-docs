<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

class UserController
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
}
