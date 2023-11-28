<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear clientes
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('customers') ?>" class="btn btn-primary">Regresar a clientes</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('customers/' . $customer["id"]) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Editar datos del cliente</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione el nombre" value="<?php if ($customer['name']) : echo $customer['name'];
                                                                                                                                            else : set_value('name');
                                                                                                                                            endif ?>">
                                    </div>

                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" name="lastName" placeholder="Proporcione el apellido paterno" value="<?php if ($customer['last_name']) : echo $customer['last_name'];
                                                                                                                                                        else : set_value('last_name');
                                                                                                                                                        endif ?>">
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Apellido materno</label>
                                        <input type="text" class="form-control" name="secondLastName" placeholder="Proporcione el apellido materno" value="<?php if ($customer['second_last_name']) : echo $customer['second_last_name'];
                                                                                                                                                            else : set_value('second_last_name');
                                                                                                                                                            endif ?>">
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label clas="form-label">email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Proporcione el email" value="<?php if ($customer['email']) : echo $customer['email'];
                                                                                                                                        else : set_value('email');
                                                                                                                                        endif ?>">
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Contraseña</label>
                                        <input type="password" class="form-control" name="password" placeholder="Proporcione la contraseña" value="<?php if ($customer['password']) : echo $customer['password'];
                                                                                                                                                    else : set_value('password');
                                                                                                                                                    endif ?>">
                                    </div>

                                    <input id="roleId" hidden name="roleId">

                                    <button type="submit" class="btn btn-success">Guardar cliente</button>
                                </div>
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