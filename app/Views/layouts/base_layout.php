<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('bootstrap-5.0.2/css/bootstrap.css') ?>">
    
    <script src="<?=base_url("js/jquery.min.js")?>"></script>
     
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-2 px-sm-2 px-0 bg-secondary bg-gradient bg-opacity-10">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-gray min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-gray text-decoration-none" style="font-weight:bold; color: white !important;">
                        <span class="fs-5 d-none d-sm-inline" style="font-size:xx-large !important;" >Menu</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100" id="menu">
                        <li class="nav-item">
                            <a href="<?= base_url('') ?>" class="nav-link align-middle px-0" style="color: white !important;">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('movies') ?>" class="nav-link px-0 align-middle" style="color: white !important;" >
                                <i class="fs-4 bi-images"></i> <span class="ms-1 d-none d-sm-inline">Peliculas</span></a>
                        </li>
                        <li>
                            <a href="<?= base_url('roles') ?>" class="nav-link px-0 align-middle" style="color: white !important;" >
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Roles</span></a>
                        </li>
                        <li>
                            <a href="<?= base_url('workers') ?>" class="nav-link px-0 align-middle" style="color: white !important;">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Trabajadores</span> </a>
                        </li>
                        <li>
                            <a href="<?= base_url('clients') ?>" class="nav-link px-0 align-middle" style="color: white !important;">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Clientes</span> </a>
                        </li>
                        <li>
                            <a href="<?= base_url('cinemas') ?>" class="nav-link px-0 align-middle" style="color: white !important;">
                                <i class="fs-4 bi-box"></i> <span class="ms-1 d-none d-sm-inline">Cines</span> </a>
                        </li>
                        <li>
                            <a href="<?= base_url('configs') ?>" class="nav-link px-0 align-middle" style="color: white !important;">
                                <i class="fs-4 bi-gear"></i> <span class="ms-1 d-none d-sm-inline">Configuración</span> </a>
                        </li>
                        <li>
                            <a href="<?= base_url('typesRoom') ?>" class="nav-link px-0 align-middle" style="color: white !important;">
                                <i class="fs-4 bi-command"></i> <span class="ms-1 d-none d-sm-inline">Tipos de habitación</span> </a>
                        </li>
                        <li>
                            <a href=" <?= base_url('rooms') ?>" class="nav-link px-0 align-middle" style="color: white !important;">
                                <i class="fs-4 bi-command"></i> <span class="ms-1 d-none d-sm-inline">Sala</span> </a>
                        </li>
                        <li>
                            <a href="<?= base_url('functions') ?>" class="nav-link px-0 align-middle" style="color: white !important;">
                                <i class="fs-4 bi bi-table"></i> <span class="ms-1 d-none d-sm-inline">Funciones</span> </a>
                        </li>
                        <li>
                            <a href="<?= base_url('sales') ?>" class="nav-link px-0 align-middle" style="color: white !important;">
                                <i class="fs-4 bi bi-table"></i> <span class="ms-1 d-none d-sm-inline">Ventas</span> </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col py-3 container-fluid py-4">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    <script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('bootstrap-5.0.2/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>