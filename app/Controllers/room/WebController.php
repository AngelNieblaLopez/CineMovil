<?php

namespace App\Controllers\room;

use App\Controllers\BaseController;
use Exception;

class WebController extends BaseController
{
    protected $session;
    protected $roomModel;
    protected $typeRoomModel;
    protected $cinemaModel;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->roomModel = model('RoomModel');
        $this->typeRoomModel = model('TypeRoomModel');
        $this->cinemaModel = model('CinemaModel');
    }

    public function index()
    {
        $rooms = $this->roomModel
        ->select("room.id, type_room.name AS type_room_name, room.available")
        ->join("type_room", "type_room.id = room.type_room_id")
        ->join("cinema", "cinema.id = room.cinema_id")
        ->where("room.status = 1")
        ->orderBy('id', 'asc')->findAll();
        return view('rooms/index', compact('rooms'));
    }


    public function show($id = null)
    {
        $typeRooms = $this->typeRoomModel->where("status = 1")->findAll();
        $cinemas = $this->cinemaModel->where("status = 1")->findAll();

        $room = $this->roomModel->where("status = 1")->find($id);

        if ($room) {
            return view('rooms/show', compact('room', "typeRooms", "cinemas"));
        } else {
            return redirect()->to(site_url('/rooms'));
        }
    }

    public function new()
    {
        $typeRooms = $this->typeRoomModel->where("status = 1")->findAll();
        $cinemas = $this->cinemaModel->where("status = 1")->findAll();

        return view('rooms/new', compact("typeRooms", "cinemas"));
    }

    public function create()
    {
        $typeRoomId = $this->request->getVar('typeRoomId');
        $cinemaId = $this->request->getVar('cinemaId');

        $typeRoom = $this->typeRoomModel->where("status = 1")->find($typeRoomId);

        if (!$typeRoom) {
            throw new Exception("Tipo de sala no encontrado");
        }

        $cinema = $this->cinemaModel->where("status = 1")->find($cinemaId);

        if (!$cinema) {
            throw new Exception("Cine no encontrado");
        }
        
        $available = $this->request->getVar('available');
        if (!$available) {
            $available = false;
        }

        $this->roomModel->save([
            "name" => $this->request->getVar('name'),
            "available" => $available,
            "type_room_id" => $typeRoomId,
            "cinema_id" => $cinemaId
        ]);


        session()->setFlashdata("success", "Se agregó una nueva sala");
        return redirect()->to(site_url('/rooms'));
    }

    public function edit($id = null)
    {
        $filterFetch = "status = 1";
        $room = $this->roomModel->where($filterFetch)->find($id);
        if ($room) {
            return view('rooms/edit', compact("room"));
        } else {
            session()->setFlashdata('failed', 'Role no encontrado');
            return redirect()->to('/rooms');
        }
    }

    public function update($id = null)
    {
        $isWorker = $this->request->getVar('is_worker');
        if (!$isWorker) {
            $isWorker = false;
        }

        $this->roomModel->save([
            'id' => $id,
            'name' => $this->request->getVar('name'),
            'is_worker' => $isWorker,
        ]);

        session()->setFlashdata('success', "Se modificaron los datos del rol");
        return redirect()->to(base_url('/rooms'));
    }

    public function delete($id = null)
    {
        $this->roomModel->save([
            "id" => $id,
            "status" => 0
        ]);

        session()->setFlashdata('success', 'Rol eliminado');
        return redirect()->to(base_url('/rooms'));
    }
}
