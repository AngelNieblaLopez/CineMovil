<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Editar usuario <?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('users') ?>" class="btn btn-primary">Regresar a usuario</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('users/'.$user["id"]) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Editar datos del usuario</h5>
                                 
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" placeholder="Proporcione el nombre del usuario" value="<?php if ($user['nombre']) : echo $user['nombre'];
                                                                                                                                                        else : set_value('nombre');
                                                                                                                                                        endif ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" name="apellido_paterno" placeholder="Proporcione el apellido paterno del usuario" value="<?php if ($user['apellido_paterno']) : echo $user['apellido_paterno'];
                                                                                                                                                                            else : set_value('apellido_paterno');
                                                                                                                                                                            endif ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Apellido materno</label>
                                        <input type="text" class="form-control" name="apellido_materno" placeholder="Proporcione el apellido materno del usuario" value="<?php if ($user['apellido_materno']) : echo $user['apellido_materno'];
                                                                                                                                                                            else : set_value('apellido_materno');
                                                                                                                                                                            endif ?>">
                                    </div>

                                    <button type="submit" class="btn btn-success">Modificar datos</button>
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