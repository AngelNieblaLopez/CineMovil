<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nuevo trabajador <?= $this->endSection() ?>


<?= $this->section('content')?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('users') ?>" class="btn btn-primary">Regresar a trabajadores</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('users') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Crear trabajador</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Primer nombre</label>
                                        <input type="text" class="form-control" name="firstName" placeholder="Proporcione el primer nombre del trabajador">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Segundo nombre</label>
                                        <input type="text" class="form-control" name="firstName" placeholder="Proporcione el segundo nombre del trabajador">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" name="lastName" placeholder="Proporcione el apellido paterno del trabajador">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Apellido materno</label>
                                        <input type="text" class="form-control" name="secondLastName" placeholder="Proporcione el apellido materno del trabajador">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Role</label>
                                        <input type="text" class="form-control" name="secondLastName" placeholder="Proporcione el apellido materno del trabajador">
                                    </div>

                                    <button type="submit" class="btn btn-success">Guardar trabajador</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>