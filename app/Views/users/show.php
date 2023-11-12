<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nuevo usuario <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('users') ?>" class="btn btn-primary">Regresar a usuarios</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Crear usuario</h5>
                        <div class="form-group mb-3">
                            <label clas="form-label">Nombre</label>
                            <input type="text" class="form-control" disabled placeholder="Nombre de usaurio" value="<?= trim($user["nombre"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Apellido paterno</label>
                            <input type="text" class="form-control" disabled placeholder="Apellido paterno del usuario" value="<?= trim($user['apellido_paterno'])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Apellido materno</label>
                            <input type="text" class="form-control" disabled placeholder="Apellido materno del usuario" value="<?= trim($user['apellido_materno'])?>">
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>