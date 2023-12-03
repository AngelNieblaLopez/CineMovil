<?php

namespace App\Controllers\function;

use App\Controllers\BaseController;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use Error;
use Exception;
use Predis\Connection\Cluster\RedisCluster;

class WebController extends BaseController
{
    protected $session;
    protected $roomModel;
    protected $functionModel;
    protected $movieModel;
    protected $configModel;
    protected $functionStatusModel;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->roomModel = model('RoomModel');
        $this->functionModel = model('FunctionModel');
        $this->movieModel = model('MovieModel');
        $this->functionStatusModel = model('FunctionStatusModel');
        $this->configModel = model("ConfigModel");
    }

    public function index()
    {
        $whereFetch = "function.status = 1";
        $functions = $this->functionModel
            ->select("
        function.id,   
        function.start_date, 
        room.name AS room_name, 
        function_status.name AS function_status_name,  
        movie.name AS movie_name,
        ")
            ->join('room', 'room.id = function.room_id')
            ->join('function_status', 'function_status.id = function.function_status_id')
            ->join('movie', 'movie.id = function.movie_id')
            ->where($whereFetch)->orderBy('function.id', 'asc')->findAll();
        return view('functions/index', compact('functions'));
    }


    public function show($id = null)
    {
        $whereFetch = "status = 1";
        $function = $this->functionModel
            ->select("id, start_date, room_id, function_status_id, movie_id")
            ->where($whereFetch)->find((int)$id);

        $rooms = $this->roomModel->where("status = 1")->findAll();
        $functionsStatus = $this->functionStatusModel->where("status = 1")->findAll();
        $movies = $this->movieModel->where("status = 1")->findAll();

        if ($function) {
            return view('functions/show', compact('rooms', "functionsStatus", "movies"));
        } else {
            return redirect()->to(site_url('/functions'));
        }
    }

    public function new()
    {
        $rooms = $this->roomModel->where("status = 1")->findAll();
        $functionsStatus = $this->functionStatusModel->where("status = 1")->findAll();
        $movies = $this->movieModel->where("status = 1")->findAll();

        return view('functions/new', compact("rooms", "functionsStatus", "movies"));
    }

    public function create()
    {
        $roomId = $this->request->getVar('roomId');
        $movieId = $this->request->getVar('movieId');
        $startDate = $this->request->getVar('startDate');

        $envv = ENVIRONMENT;
        $config = $this->configModel
            ->join('enviroment_server', "enviroment_server.id = config.enviroment_server_id")
            ->where("config.status = 1 AND enviroment_server.name = '$envv'")->orderBy('config.id', 'asc')->findAll();


        if (count($config) == 0) {
            throw new Exception("Enviroment no establecido");
        }

        $this->functionModel->save([
            "room_id" => $roomId,
            "function_status_id" => $config["default_function_status_id"],
            "movie_id" => $movieId,
            "start_date" => $startDate,
        ]);

        session()->setFlashdata("success", "Se creó una nueva función");
        return redirect()->to(site_url('/functions'));
    }

    public function edit($id = null)
    {
        $whereFetch = "function.status = 1";
        $function = $this->functionModel
            ->select("
        function.id,   
        user.name, 
        user.last_name, 
        user.second_last_name,
        user.email,
        auth.password,
        user.role_id,
        function.type_of_worker_id")
            ->join('user', 'function.user_id = user.id')
            ->join('auth', 'auth.id = user.auth_id')
            ->join('role', 'role.id = user.role_id')
            ->join('type_of_worker', 'type_of_worker.id = function.type_of_worker_id')
            ->where($whereFetch)->find((int)$id);

        $roles = $this->roleModel->where("status = 1")->orderBy('id', 'asc')->findAll();
        $typeOfWorkers = $this->typeOfWorkerModel->where("status = 1")->orderBy('id', 'asc')->findAll();

        if ($function) {
            return view('functions/edit', compact("function", "roles", "typeOfWorkers"));
        } else {
            session()->setFlashdata('failed', 'Trabajador no encontrado');
            return redirect()->to('/functions');
        }
    }

    public function update($id = null)
    {

        /*   try { */
        $roleId = $this->request->getVar('roleId');
        $typeOfWorkerId = $this->request->getVar('typeOfWorkerId');
        $password = $this->request->getVar('password');
        $name = $this->request->getVar('name');
        $lastName = $this->request->getVar('lastName');
        $secondLastName = $this->request->getVar('secondLastName');
        $email = $this->request->getVar('email');


        // $this->db->transException(true)->transStart();
        $whereWorkerFetch = "function.status = 1";
        $function = $this->functionModel
            ->select('u.auth_id, function.user_id')
            ->join('type_of_worker as tof', 'tof.id = function.type_of_worker_id')
            ->join('user as u', 'u.id = function.user_id')
            ->join('auth as a', 'a.id = u.auth_id')
            ->join('role as r', 'r.id = u.role_id')
            ->where($whereWorkerFetch)->find($id);

        if (!$function) {
            throw new Exception("Trabajador no encontrado");
        }

        $role =  $this->roleModel
            ->where("status = 1")
            ->find($roleId);

        if (!$role) {
            throw new Exception("Role no encontrado");
        }


        $typeOfWorker =  $this->typeOfWorkerModel
            ->where("status = 1")
            ->find($typeOfWorkerId);

        if (!$typeOfWorker) {
            throw new Exception("Tipo de trabajador no encontrado");
        }

        /* UPDATE */
        $this->authModel->save([
            "id" => (int)$function["auth_id"],
            "password" => $password,
        ]);


        $this->userModel->save([
            "id" => (int)$function["user_id"],
            "name" => $name,
            "last_name" => $lastName,
            "second_last_name" => $secondLastName,
            "role_id" => (int)$roleId,
            "email" => $email,
        ]);

        $this->functionModel->save([
            "id" => $id,
            "type_of_worker_id" => $typeOfWorkerId,
        ]);

        // $this->db->transComplete();
        session()->setFlashdata('success', "Se modificaron los datos del trabajador");
        return redirect()->to(base_url('/functions'));
        /*     } catch(DatabaseException $e) {
        // error
        $this->db->transRollback();
        return session()->setFlashdata('failed', 'Trabajador no encontrado');
    } */
    }

    public function delete($id = null)
    {

        $whereWorkerFetch = "function.status = 1 AND user.status = 1";
        $function = $this->functionModel
            ->where($whereWorkerFetch)
            ->join("user", "user.id = function.user.id")
            ->find($id);





        $this->functionModel->save([
            "id" => $id,
            "status" => 0
        ]);


        session()->setFlashdata('success', 'Trabajador eliminado');
        return redirect()->to(base_url('/functions'));
    }
}
