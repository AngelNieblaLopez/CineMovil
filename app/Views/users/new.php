<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nuevo usuario <?= $this->endSection() ?>


<?= $this->section('content')?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('users') ?>" class="btn btn-primary">Regresar a usuario</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('users') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Crear usuario</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" placeholder="Proporcione el nombre del usuario">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" name="apellido_paterno" placeholder="Proporcione el apellido paterno del usuario">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Apellido materno</label>
                                        <input type="text" class="form-control" name="apellido_materno" placeholder="Proporcione el apellido materno del usuario">
                                    </div>

                                    <button type="submit" class="btn btn-success">Guardar usuario</button>
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