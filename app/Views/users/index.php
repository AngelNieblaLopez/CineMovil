<?= $this->extend('layouts/base_layout');
$this->section('title'); ?> Listado de usuarios <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('users/new') ?>" class="btn btn-primary">Nuevo usuario</a>
        </div>
    </div>
</div>


<div class="row py-2">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Usuarios</h5>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellido paterno</th>
                            <th>Apellido materno</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(count($users) > 0):
                            foreach($users as $user): ?>
                            <tr>
                                <td> <?= $user['id']?> </td>
                                <td> <?= $user['nombre']?> </td>
                                <td> <?= $user['apellido_paterno']?> </td>
                                <td> <?= $user['apellido_materno']?> </td>
                                <td class="d-flex"> 
                                    <a href="<?= base_url("users/".$user["id"])?>" class="btn btn-sm btn-info mx-1" title="Mostrar"><i class="bi bi-info-square"></i></a> 
                                    <a href="<?= base_url("users/edit/".$user["id"])?>" class="btn btn-sm btn-success mx-1" title="Editar"><i class="bi bi-pencil-square"></i></a> 
                                </td>
                            </tr>
                        <?php endforeach;
                            else: ?>
                        <tr>
                            <td colspan="4">
                                <h6 class="text-danger text-center">No se encontraron usuarios</h6>
                            </td>
                        </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>