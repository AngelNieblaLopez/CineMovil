<?php

namespace App\Controllers\movie;
use App\Controllers\BaseController;
use Exception;

class WebController extends BaseController
{
    protected $movieModel;
    protected $clasificationModel;
    protected $categoryModel;

    protected $locationModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->movieModel = model('MovieModel');
        $this->clasificationModel = model('ClasificationModel');
        $this->categoryModel = model('CategoryModel');
    }

    public function index()
    {
        $whereFetch = "movie.status = 1";
        $movies = $this->movieModel
        ->select("movie.id, movie.name") 
        ->where($whereFetch)->orderBy('movie.id', 'asc')->findAll();
        return view('movies/index', compact('movies'));
    }


    public function show($id = null) {
        $whereFetch = "status = 1";
        $movie = $this->movieModel
        ->select("movie.id, name, description, category_id, movie_clasification_id, duration, image_url")
        ->where($whereFetch)->find((int)$id);

        $clasifications = $this->clasificationModel->where($whereFetch)->findAll();
        $categories = $this->categoryModel->where($whereFetch)->findAll();

        if($movie) {
            return view('movies/show', compact('movie', "clasifications", "categories"));
        } else {
            return redirect()->to(site_url('/movies'));
        }
    }

    public function new() {
        $whereFetch = "status = 1";
        $clasifications = $this->clasificationModel->where($whereFetch)->findAll();
        $categories = $this->categoryModel->where($whereFetch)->findAll();


        return view('movies/new', compact("clasifications", "categories"));
    }

    public function create() {
        
        $this->movieModel->save([
            "name" => $this->request->getVar('name'),
            "description" => $this->request->getVar('description'),
            "category_id" => $this->request->getVar('categoryId'),
            "movie_clasification_id" => $this->request->getVar('clasificationId'),
            "duration" => $this->request->getVar('duration'),
            "image_url" => $this->request->getVar('imageUrl'),
        ]);



        session()->setFlashdata("success", "Se agregó una nueva película");
        return redirect()->to(site_url('/movies'));
    }

    public function edit($id = null) {
        $whereFetch = "status = 1";
        $movie = $this->movieModel
        ->select("movie.id, name, description, category_id, movie_clasification_id, duration, image_url")
        ->where($whereFetch)->find((int)$id);

        $clasifications = $this->clasificationModel->where($whereFetch)->findAll();
        $categories = $this->categoryModel->where($whereFetch)->findAll();

        if($movie) {
            return view('movies/edit', compact('movie', "clasifications", "categories"));
        } else {
            session()->setFlashdata('failed', 'Pelicula no encontrada');
            return redirect()->to('/movies');
        }
    }


    public function update($id) {
        
        $movie = $this->movieModel->where("status = 1")->find($id);

        if(!$movie) {
            throw new Exception("Pelicula no encontrada");
        }

        $this->movieModel->save([
            "id" => $id,
            "name" => $this->request->getVar('name'),
            "description" => $this->request->getVar('description'),
            "category_id" => $this->request->getVar('categoryId'),
            "movie_clasification_id" => $this->request->getVar('clasificationId'),
            "duration" => $this->request->getVar('duration'),
            "image_url" => $this->request->getVar('imageUrl'),
        ]);


        session()->setFlashdata("success", "Modificación existosa");
        return redirect()->to(site_url('/movies'));
    }

    public function delete($id = null) {

        $where = "status = 1";
        $movie = $this->movieModel
        ->where($where)
        ->find($id);

        if(!$movie) {
            throw new Exception("Pelicula no encontrada");
        }

        $this->movieModel->save([
            "id" => $id,
            "status" => 0
        ]);



        session()->setFlashdata('success', 'Pelicula eliminada');
        return redirect()->to(base_url('/movies'));
    }
    
}
