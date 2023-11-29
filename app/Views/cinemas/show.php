<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Editar cine
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('cinemas') ?>" class="btn btn-primary">Regresar a cines</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Detalle cine</h5>
                                <div class="form-group mb-3">
                                    <label clas="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="name" placeholder="Proporcione descripción de nombre" value="<?= trim($cinema["name"])?>">
                                </div>

                                <div class=" form-group mb-3">
                                    <label clas="form-label">Descripción ubicación</label>
                                    <input type="text" class="form-control" name="descriptionLocation" placeholder="Proporcione descripción de locación " value="<?= trim($cinema["description_location"])?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label clas="form-label">Lat</label>
                                    <input type="text" class="form-control" name="latLocation" placeholder="Proporcione la latitud de cine" value="<?= trim($cinema["lat_location"])?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label clas="form-label">long</label>
                                    <input type="text" class="form-control" name="longLocation" placeholder="Proporcione la longitud del cine" value="<?= trim($cinema["long_location"])?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>