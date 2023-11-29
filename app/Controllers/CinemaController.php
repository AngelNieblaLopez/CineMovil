<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use Error;
use Exception;
use Predis\Connection\Cluster\RedisCluster;

class CinemaController extends BaseController
{
    protected $cinemaModel;
    protected $locationModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->cinemaModel = model('CinemaModel');
        $this->locationModel = model('LocationModel');
    }

    public function index()
    {
        $whereFetch = "cinema.status = 1";
        $cinemas = $this->cinemaModel
        ->select("
        cinema.id,
        cinema.name,
        location.description AS location_description, 
        location.lat AS location_lat, 
        location.longi AS location_longi") 
        ->join('location', 'location.id = cinema.location_id')
        ->where($whereFetch)->orderBy('location.id', 'asc')->findAll();
        return view('cinemas/index', compact('cinemas'));
    }


    public function show($id = null) {
        $whereFetch = "cinema.status = 1";
        $cinema = $this->cinemaModel
        ->join('location', 'cinema.location_id = location.id') 
        ->where($whereFetch)->find((int)$id);

        if($cinema) {
            return view('cinemas/show', compact('cinema'));
        } else {
            return redirect()->to(site_url('/cinemas'));
        }
    }

    public function new() {
        return view('cinemas/new');
    }

    public function create() {
        
        $this->locationModel->save([
            "description" => $this->request->getVar('description'),
            "longi" => $this->request->getVar('longi'),
            "lat" => $this->request->getVar('lat'),
        ]);

        $locationId = $this->db->insertID();

        $this->cinemaModel->save([
            "name" =>$this->request->getVar('name'),
            "location_id" =>$locationId,
        ]);


        session()->setFlashdata("success", "Se agregó un nuevo cine");
        return redirect()->to(site_url('/cinemas'));
    }

    public function edit($id = null) {
        $whereFetch = "cinema.status = 1";
        $cinema = $this->cinemaModel
        ->select("
        cinema.id,   
        user.name, 
        user.last_name, 
        user.second_last_name,
        user.email,
        auth.password,
        user.role_id,
        cinema.type_of_worker_id") 
        ->join('user', 'cinema.user_id = user.id')
        ->join('auth', 'auth.id = user.auth_id')
        ->join('role', 'role.id = user.role_id')
        ->join('type_of_worker', 'type_of_worker.id = cinema.type_of_worker_id')
        ->where($whereFetch)->find((int)$id);

        $roles = $this->roleModel->where("status = 1")->orderBy('id', 'asc')->findAll();
        $typeOfWorkers = $this->typeOfWorkerModel->where("status = 1")->orderBy('id', 'asc')->findAll();

        if($cinema) {
            return view('cinemas/edit', compact("cinema", "roles", "typeOfWorkers"));
        } else {
            session()->setFlashdata('failed', 'Trabajador no encontrado');
            return redirect()->to('/cinemas');
        }
    }

    public function update($id = null) {

      /*   try { */
        $roleId = $this->request->getVar('roleId');
        $typeOfWorkerId = $this->request->getVar('typeOfWorkerId');
        $password = $this->request->getVar('password');
        $name = $this->request->getVar('name');
        $lastName = $this->request->getVar('lastName');
        $secondLastName = $this->request->getVar('secondLastName');
        $email = $this->request->getVar('email');


        // $this->db->transException(true)->transStart();
        $whereWorkerFetch = "cinema.status = 1";
        $cinema = $this->cinemaModel
        ->select('u.auth_id, cinema.user_id')
        ->join('type_of_worker as tof', 'tof.id = cinema.type_of_worker_id')
        ->join('user as u', 'u.id = cinema.user_id')
        ->join('auth as a', 'a.id = u.auth_id')
        ->join('role as r', 'r.id = u.role_id')
        ->where($whereWorkerFetch)->find($id);

        if(!$cinema) {
            throw new Exception("Trabajador no encontrado");
        }

        $role =  $this->roleModel
        ->where("status = 1")
        ->find($roleId);

        if(!$role) {
            throw new Exception("Role no encontrado");
        }


        $typeOfWorker =  $this->typeOfWorkerModel
        ->where("status = 1")
        ->find($typeOfWorkerId);

        if(!$typeOfWorker) {
            throw new Exception("Tipo de trabajador no encontrado");
        }

        /* UPDATE */
        $this->authModel->save([
            "id" => (int)$cinema["auth_id"],
            "password" => $password,
        ]);


        $this->userModel->save([
            "id" => (int)$cinema["user_id"],
            "name" => $name,
            "last_name" => $lastName,
            "second_last_name" => $secondLastName,
            "role_id" => (int)$roleId,
            "email" => $email,
        ]);

        $this->cinemaModel->save([
            "id" => $id,
            "type_of_worker_id" => $typeOfWorkerId,
        ]);

        // $this->db->transComplete();
        session()->setFlashdata('success', "Se modificaron los datos del trabajador");
        return redirect()->to(base_url('/cinemas'));
/*     } catch(DatabaseException $e) {
        // error
        $this->db->transRollback();
        return session()->setFlashdata('failed', 'Trabajador no encontrado');
    } */

    }

    public function delete($id = null) {

        $whereWorkerFetch = "cinema.status = 1 AND user.status = 1";
        $cinema = $this->cinemaModel
        ->where($whereWorkerFetch)
        ->join("user", "user.id = cinema.user.id")
        ->find($id);

        



        $this->cinemaModel->save([
            "id" => $id,
            "status" => 0
        ]);


        session()->setFlashdata('success', 'Trabajador eliminado');
        return redirect()->to(base_url('/cinemas'));
    }
    
}
