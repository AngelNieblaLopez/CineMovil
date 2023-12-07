<?php

namespace App\Controllers\client;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ConfigModel;
use App\Models\AuthModel;
use App\Models\UserModel;
use App\Models\ClientModel;
use App\Models\MovieModel;
use Exception;

class RestController extends ResourceController
{

    protected $session;
    protected $db;
    protected $configModel;
    protected $movieModel;
    

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->configModel = new ConfigModel();
        $this->movieModel = new MovieModel();
        
    }
    

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function available($id)
    {
        
        $movie = $this->movieModel
        ->join("category", "category.id = movie.category_id")
        ->join("movie_clasification", "movie_classification.id = movie.movie_clasificatioin_id")
        ->where("status = 1")->find($id);

        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Recurso obtenido satisfactoriamente'],
            'data' => $movie
        ];

        return $this->respond($respuesta, 200);
    }




}
