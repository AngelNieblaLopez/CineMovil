<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use Error;
use Exception;
use Predis\Connection\Cluster\RedisCluster;

class WorkerController extends BaseController
{
    protected $roleModel;
    protected $authModel;
    protected $typeOfWorker;
    protected $userModel;
    protected $workerModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->roleModel = model('RoleModel');
        $this->authModel = model('AuthModel');
        $this->typeOfWorker = model('TypeOfWorkerModel');
        $this->userModel = model('UserModel');
        $this->workerModel = model('WorkerModel');
    }

    public function index()
    {
        $whereFetch = "status = 1";
        $workers = $this->userModel
        ->join('role', 'role.id = user.role_id')
        ->join('worker', 'worker.user_id = user.id')
        ->join('type_of_worker', 'type_of_worker.id = worker.type_of_seller_id')
        ->where($whereFetch)->orderBy('user.id', 'asc')->findAll();
        return view('workers/index', compact('workers'));
    }


    public function show($id = null) {
        $whereFetch = "status = 1";
        $user = $this->userModel
        ->join('role', 'role.id = user.role_id')
        ->join('worker', 'worker.user_id = user.id')
        ->join('type_of_worker', 'type_of_worker.id = worker.type_of_seller_id')
        ->where($whereFetch)->find($id);

        if($user) {
            return view('workers/show', compact('user'));
        } else {
            return redirect()->to(site_url('/workers'));
        }
    }

    public function new() {
        return view('workers/new');
    }

    public function create() {
        
        $this->authModel->save([
            "password" => $this->request->getVar('password'),
        ]);

        $authId = $this->db->insertID();

        $this->userModel->save([
            "auth_id" => $authId,
            "first_name" =>$this->request->getVar('firstName'),
            "second_name" => $this->request->getVar('secondName'),
            "last_name" => $this->request->getVar('lastName'),
            "second_last_name" => $this->request->getVar('secondLastName'),
            "role_Id" => $this->request->getVar('roleId'),
            "email" => $this->request->getVar('email'),
        ]);

        $userId = $this->db->insertID();

        $this->workerModel->save([
            "user_id" => $userId,
            "type_of_seller_id" => $this->request->getVar('typeOfSellerId'),
        ]);

        session()->setFlashdata("success", "Se agregó un nuevo usuario");
        return redirect()->to(site_url('/workers'));
    }

    public function edit($id = null) {
        $whereFetch = "status = 1";
        $user = $this->userModel
        ->join('role', 'role.id = user.role_id')
        ->join('worker', 'worker.user_id = user.id')
        ->join('type_of_worker', 'type_of_worker.id = worker.type_of_seller_id')
        ->where($whereFetch)->find($id);
        if($user) {
            return view('workers/edit', compact("user"));
        } else {
            session()->setFlashdata('failed', 'Trabajador no encontrado');
            return redirect()->to('/workers');
        }
    }

    public function update($id = null) {

        try {
        define("ROLE_ID", $this->request->getVar('role_id'));

        $this->db->transException(true)->transStart();
        $whereWorkerFetch = "status = 1";
        $worker = $this->workerModel
        ->select('u.auth_id, w.user_id')
        ->join('type_of_seller as tof', 'tof.id = worker.type_of_seller_id')
        ->join('user as u', 'u.id = worker.user_id')
        ->join('auth as a', 'a.id = u.auth_id')
        ->join('role as r', 'r.id = u.role_id')
        ->where($whereWorkerFetch)->find($id);

        if(!$worker) {
            throw new Exception("Usuario no encontrado");
        }

        $roleFinded =  $this->roleModel
        ->where("status = 1")
        ->find(ROLE_ID);

        if(!$roleFinded) {
            throw new Exception("Role no encontrado");
        }


        $roleFinded =  $this->roleModel
        ->where("status = 1")
        ->find(ROLE_ID);

        if(!$roleFinded) {
            throw new Exception("Role no encontrado");
        }

        /* UPDATE */
        $this->authModel->save([
            "id" => $worker->auth_id,
            "password" => $this->request->getVar('password'),
        ]);


        $this->userModel->save([
            "id" => $worker->id,
            "first_name" =>$this->request->getVar('firstName'),
            "second_name" => $this->request->getVar('secondName'),
            "last_name" => $this->request->getVar('lastName'),
            "second_last_name" => $this->request->getVar('secondLastName'),
            "role_Id" => ROLE_ID,
            "email" => $this->request->getVar('email'),
        ]);

        $this->workerModel->save([
            "id" => $id,
            "user_id" => $worker->user_id,
            "type_of_seller_id" => $this->request->getVar('typeOfSellerId'),
        ]);

        $this->db->transComplete();
        session()->setFlashdata('success', "Se modificaron los datos del usuario");
        return redirect()->to(base_url('/workers'));
    } catch(DatabaseException $e) {
        // error
        $this->db->transRollback();
        return session()->setFlashdata('failed', 'Trabajador no encontrado');
    }

    }

    public function delete($id = null) {

        $whereWorkerFetch = "status = 1";
        $worker = $this->workerModel->where($whereWorkerFetch)->find($id);


        $this->workerModel->save([
            "id" => $id,
            "status" => 0
        ]);


        session()->setFlashdata('success', 'Usuario eliminado');
        return redirect()->to(base_url('/workers'));
    }
    
}
