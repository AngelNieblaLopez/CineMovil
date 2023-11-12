<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Exceptions\RedirectException;
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
        $users = $this->userModel->orderBy('id', 'asc')->findAll();
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

        $this->userModel->save([
            "nombre" =>$this->request->getVar('nombre'),
            "apellido_paterno" => $this->request->getVar('apellido_paterno'),
            "apellido_materno" => $this->request->getVar('apellido_materno')
        ]);


        session()->setFlashdata("success", "Se agregó un nuevo usuario");
        return redirect()->to(site_url('/users'));
    }

    public function edit($id = null) {
        $user = $this->userModel->find($id);
        if($user) {
            return view('users/edit', compact("user"));
        } else {
            session()->setFlashdata('failed', 'Usuario no encontrado');
            return redirect()->to('/users');
        }
    }

    public function update($id = null) {
        $this->userModel->save([
            'id' => $id,
            'nombre' => $this->request->getVar('nombre'),
            'apellido_paterno' => $this->request->getVar('apellido_paterno'),
            "apellido_materno" => $this->request->getVar('apellido_materno')
        ]);

        session()->setFlashdata('success', "Se modificaron los datos del usuario");
        return redirect()->to(base_url('/users'));
    }

    public function delete($id = null) {
        $this->userModel-> delete($id);
        session()->setFlashdata('success', 'Usuario eliminado');
        return redirect()->to(base_url('/users'));
    }
    
}
