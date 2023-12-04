
<?= $this->extend('layouts/base_layout');
$this->section('title'); ?> Listado de ventas <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="row py-2">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Ventas</h5>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Total</th>
                            <th>Estatus</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($sales) > 0) :
                            foreach ($sales as $sale) : ?>
                                <tr>
                                    <td> <?= $sale['id'] ?> </td>
                                    <td> <?= $sale['client_name'] ?> </td>
                                    <td> <?= $sale['worker_name'] ?> </td>
                                    <td> <?= $sale['payment_status_name'] ?> </td>
                                    <td class="d-flex">
                                        <a href="<?= base_url("sales/" . $sale["id"]) ?>" class="btn btn-sm btn-info mx-1" title="Mostrar"><i class="bi bi-info-square"></i></a>
                                        <a href="<?= base_url("sales/edit/" . $sale["id"]) ?>" class="btn btn-sm btn-success mx-1" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                        <form class="display-none" method="post" action="<?= base_url("sales/" . $sale["id"]) ?>" id="deleteUser<?= $sale['id'] ?>">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="javascript:void(0)" onclick="deleteUser('deleteUser<?= $sale['id'] ?>')" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="4">
                                    <h6 class="text-danger text-center">No se encontraron ventas</h6>
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteUser(formId) {
        let confirm = window.confirm('¿Está seguro de eliminar esta venta?');
        if (confirm) {
            document.getElementById(formId).submit();
        }
    }
</script>

<?= $this->endSection(); ?>