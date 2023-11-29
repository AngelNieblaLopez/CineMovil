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
                <form action="<?= base_url('cinemas/' . $cinema["id"]) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Editar datos del cine</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione descripción de nombre" value="<?php if ($cinema['name']) : echo $cinema['name'];
                                                                                                                                                    else : set_value('name');
                                                                                                                                                    endif ?>">
                                    </div>

                                    <div class=" form-group mb-3">
                                        <label clas="form-label">Descripción ubicación</label>
                                        <input type="text" class="form-control" name="descriptionLocation" placeholder="Proporcione descripción de locación " value="<?php if ($cinema['description_location']) : echo $cinema['description_location'];
                                                                                                                                                                        else : set_value('descriptionLocation');
                                                                                                                                                                        endif ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Lat</label>
                                        <input type="text" class="form-control" name="latLocation" placeholder="Proporcione la latitud de cine" value="<?php if ($cinema['lat_location']) : echo $cinema['lat_location'];
                                                                                                                                                        else : set_value('latLocation');
                                                                                                                                                        endif ?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label clas="form-label">long</label>
                                        <input type="text" class="form-control" name="longLocation" placeholder="Proporcione la longitud del cine" value="<?php if ($cinema['lat_location']) : echo $cinema['lat_location'];
                                                                                                                                                            else : set_value('latLocation');
                                                                                                                                                            endif ?>">
                                    </div>

                                <button type="submit" class="btn btn-success">Guardar cine</button>
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