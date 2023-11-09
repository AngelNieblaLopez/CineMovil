<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->userModel = model('UserModel');
    }

    public function index()
    {
        //
    }


    public function show($id = null) {
        
    }

    public function new() {
        
    }

    public function create() {
        
    }

    public function edit() {
        
    }

    public function update($id = null) {
        
    }

    public function delete($id = null) {
        
    }
    
}
