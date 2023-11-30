<?php

namespace App\Controllers\Role;
namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
