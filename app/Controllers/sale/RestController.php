<?php

namespace App\Controllers\sale;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ConfigModel;
use App\Models\AuthModel;
use App\Models\UserModel;
use App\Models\ClientModel;
use App\Models\SeatOfFunctionModel;
use Exception;

class RestController extends ResourceController
{

    protected $session;
    protected $db;
    protected $configModel;
    protected $authModel;
    protected $userModel;
    protected $clientModel;
    protected $seatOfFunctionModel;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->configModel = new ConfigModel();
        $this->authModel = new AuthModel();
        $this->userModel = new UserModel();
        $this->clientModel = new ClientModel();
        $this->seatOfFunctionModel = new SeatOfFunctionModel();
    }
    

 
    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        // Obtener el contenido de la solicitud como JSON
        $json = $this->request->getJSON();


        $function = $json->functionId;
        $clientId = $json->clientId;
        $sellerId = $json->sellerId;
        $owner = $json->owner;
        $card_number = $json->card_number;
        $cvv = $json->cvv;
        $expiration_date = $json->expiration_date;
        $seatsIds = $json->seatsIds;

        $stringSeatsIds = "";
        foreach ($seatsIds as $seatId) {
            $stringSeatsIds .= $seatId;
        }

        $seats

        $seats = $seatOfFunctionModel
        ->join("seat_of_room", "seat_of_room.id = seat_of_function.seat_of_room_id")
        ->where("seat_of_function.status = 1 AND seat_of_function.seat_of_room_id IN ('$stringSeatsIds')")->findAll();


        if(count($seats) !== count($seatsIds)) {

        }


        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Recurso almacenado satisfactoriamente'],
            'data' => null
        ];

        return $this->respond($respuesta, 201);
    }

}
