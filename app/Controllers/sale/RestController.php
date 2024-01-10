<?php

namespace App\Controllers\sale;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ConfigModel;
use App\Models\AuthModel;
use App\Models\UserModel;
use App\Models\ClientModel;
use App\Models\PaymentCardModel;
use App\Models\PaymentInfoModel;
use App\Models\SaleDetailModel;
use App\Models\SaleModel;
use App\Models\SeatOfFunctionModel;
use App\Models\SeatOfRoomModel;
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
    protected $seatOfRoomModel;
    protected $saleDetailModel;
    protected $saleModel;
    protected $paymentInfoModel;
    protected $paymentCardModel;

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
        $this->seatOfRoomModel = new SeatOfRoomModel();
        $this->saleDetailModel = new SaleDetailModel();
        $this->saleModel = new SaleModel();
        $this->paymentInfoModel = new PaymentInfoModel();
        $this->paymentCardModel = new PaymentCardModel();
    }


    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $envv = ENVIRONMENT;
        $config = $this->configModel
            ->join('enviroment_server', "enviroment_server.id = config.enviroment_server_id")
            ->where("config.status = 1 AND enviroment_server.name = '$envv'")->orderBy('config.id', 'asc')->findAll();

        if (count($config) == 0) {
            throw new Exception("Enviroment no establecido");
        }

        // Obtener el contenido de la solicitud como JSON
        $json = $this->request->getJSON();


        $functionId = $json->functionId;
        $clientId = $json->clientId;
        $workerId = $config[0]["app_worker_id"];

        $owner = $json->owner;
        $cardNumber = $json->cardNumber;
        $cvv = $json->cvv;
        $expirationDate = $json->expirationDate;
        $seatsIds = $json->seatsIds;

        $subtotal = 0;
        $taxes = 0;
        $total = 0;

        if (count($seatsIds) == 0) {
            throw new Exception("No se enviaron asientos");
        }


        // Verificar que los asientos no hayan sido comprados
        $seatsBuyed = $this->seatOfFunctionModel
            ->select("seat_of_function.id")
            ->join('seat_of_room', 'seat_of_room.id = seat_of_function.seat_of_room_id')
            ->join('position_of_seat', 'position_of_seat.id = seat_of_room.position_of_seat_id')
            ->join('sale_detail', 'sale_detail.seat_of_function_id = seat_of_function.id')
            ->where("sale_detail.status = 1 AND seat_of_function.function_id = '$functionId'")
            ->whereIn("position_of_seat.id", $seatsIds)
            ->findAll();

        if (count($seatsBuyed) !== 0) {
            throw new Exception("Hay asientos ya comprados");
        }

        // Encontrar asientos de función
        $seats = $this->seatOfFunctionModel
            ->select("seat_of_function.price AS priceSeat, seat_of_function.id AS seat_of_function_id")
            ->join('seat_of_room', 'seat_of_room.id = seat_of_function.seat_of_room_id')
            ->join('position_of_seat', 'position_of_seat.id = seat_of_room.position_of_seat_id')
            ->where("seat_of_function.status = 1 AND seat_of_function.function_id = '$functionId'")
            ->whereIn("position_of_seat.id", $seatsIds)
            ->findAll();


        if (count($seats) !== count($seatsIds)) {
            throw new Exception("Los asientos no fueron encontrados");
        }


        foreach ($seats as $seat) {
            $subtotal += $seat["priceSeat"];
        }

        $taxes = $subtotal * 0.16;
        $total = $subtotal + $taxes;

        $this->paymentCardModel->save([
            "owner" => $owner,
            "card_number" => $cardNumber,
            "cvv" => $cvv,
            "expiration_date" => $expirationDate
        ]);

        $paymentCardId = $this->db->insertID();

        $this->paymentInfoModel->save([
            "total" => $total,
            "taxes" => $taxes,
            "subtotal" => $subtotal,
            "payment_card_id" => $paymentCardId,
            "payment_status_id" => 3
        ]);

        $paymentInfoId = $this->db->insertID();
        $this->saleModel->save([
            "client_id" => intval($clientId),
            "worker_id" => intval($workerId),
            "payment_info_id" => intval($paymentInfoId),
        ]);

        $saleId = $this->db->insertID();
        foreach ($seats as $seat) {
            $this->saleDetailModel->save([
                "sale_id" => $saleId,
                "seat_of_function_id" => $seat["seat_of_function_id"]
            ]);
        }

        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Recurso almacenado satisfactoriamente'],
            'data' => null
        ];

        return $this->respond($respuesta, 201);
    }

    public function detail($clientId)
    {

        $sales = array();

        $salesOfClient = $this->saleModel
            ->select("sale.id AS sale_id")
            ->join("client", "client.id = '$clientId'")
            ->where("sale.status = 1 AND client.status = 1")
            ->findAll();


        foreach ($salesOfClient as $saleOfClient) {
            $saleId = $saleOfClient["sale_id"];
            
            $sale = $this->saleModel            
                ->select("sale.id ,client_user.name AS client_user_name, worker_user.name AS worker_user_name, 
            payment_info.total AS payment_info_total, payment_info.subtotal AS payment_info_subtotal, payment_info.taxes AS payment_info_taxes, 
            payment_status.name AS payment_info_status_name, movie.name AS movie_name, cinema.name AS cinema_name, room.name AS room_name, function.start_date AS function_start_date")
                ->join("client", "client.id = sale.client_id")
                ->join("user AS client_user", "client_user.id = client.user_id")
                ->join("worker", "worker.id = sale.worker_id")
                ->join("user as worker_user", "worker_user.id = worker.user_id")
                ->join("payment_info", "payment_info.id = sale.payment_info_id")
                ->join("payment_status", "payment_status.id = payment_info.payment_status_id")
                ->join("sale_detail", "sale_detail.sale_id = sale.id")
                ->join("seat_of_function", "seat_of_function.id = sale_detail.seat_of_function_id")
                ->join("seat_of_room", "seat_of_room.id = seat_of_function.seat_of_room_id")
                ->join("room", "room.id = seat_of_room.room_id")
                ->join("cinema", "cinema.id = room.cinema_id")
                ->join("function", "function.id = seat_of_function.function_id")
                ->join("movie", "movie.id = function.movie_id")
                ->find($saleId);

            $seats = $this->seatOfRoomModel
                ->select("seat_of_room.name AS seat_of_room_name")
                ->join("seat_of_function", "seat_of_function.seat_of_room_id = seat_of_room.id")
                ->join("sale_detail", "sale_detail.seat_of_function_id = seat_of_function.id")
                ->join("sale", "sale.id = sale_detail.sale_id")
                ->where(" sale.status = 1 AND sale.id = '$saleId'")
                ->findAll();

            $list_seats_names = "";

            $seats_names = array();
            foreach ($seats as $seat) {
                array_push($seats_names, $seat["seat_of_room_name"]);
            };

            if (count($seats_names) === 1) {
                $list_seats_names = $seats[0]["seat_of_room_name"];
            } else {
                $list_seats_names = implode(', ', $seats_names);
            };


            $sale = ["sale" => $sale,"list_seats_names" => $list_seats_names];

            array_push($sales, $sale);
        }



        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Recurso obtenido satisfactoriamente'],
            'data' => $sales
        ];

        return $this->respond($respuesta, 200);
    }
}
