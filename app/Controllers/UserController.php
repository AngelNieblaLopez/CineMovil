<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Predis\Connection\Cluster\RedisCluster;

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
        $users = $this->userModel->orderBy('id', 'desc')->findAll();
        return view('users/index', compact('users'));
    }


    public function show($id = null) {
        $user = $this->userModel->find($id);

        if($user) {
            return view('users/show', compact('user'));
        } else {
            return redirect()->to(site_url('/users'));
        }
    }

    public function new() {
        return view('users/new');
    }

    public function create() {
        
    }

    public function edit($id = null) {
        $user = $this->userModel->find($id);
        if($user) {
            return view('users/edit');
        } else {
            session()->setFlashdata('failed', 'Usuario no encontrado');
            return redirect()->to('/users');
        }
    }

    public function update($id = null) {
        
    }

    public function delete($id = null) {
        
    }
    
}
