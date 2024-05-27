<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getById(Request $request)
    {
        $userId = $request->id;

        return $this->user->getById($userId);
    }
}
