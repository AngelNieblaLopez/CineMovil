<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Detalle película
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('clients') ?>" class="btn btn-primary">Regresar a clientes</a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Detalle película</h5>
                    <div class="form-group mb-3">
                        <label class="form-label">Nombre</label>
                        <input disabled type="text" class="form-control" name="name" placeholder="Proporcione el nombre " value="<?= trim($movie["name"]) ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Descripción</label>
                        <input disabled type="text" class="form-control" name="description" placeholder="Proporcione la descripción" value="<?= trim($movie["description"]) ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Categoría</label>
                        <select class="form-control" id="category" disabled>
                            <option disabled value="0">- Seleccione -</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id'] ?>">
                                    <?= $category['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Clasificación</label>
                        <select class="form-control" id="clasification" disabled>
                            <option disabled value="0">- Seleccione -</option>
                            <?php foreach ($clasifications as $clasification) : ?>
                                <option value="<?= $clasification['id'] ?>">
                                    <?= $clasification['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label">Duración</label>
                        <input disabled type="number" class="form-control" name="duration" placeholder="Proporcione la duración" value="<?= trim($movie["duration"]) ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">URL poster</label>
                        <input disabled ="url" class="form-control" name="imageUrl" placeholder="Proporcione el url de la imágen" value="<?= trim($movie["image_url"]) ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {

        let categories = <?= json_encode($categories) ?>;
        let clasifications = <?= json_encode($clasifications) ?>;

        if (clasifications.length !== 0) {
            $("#clasification option").each((_, option) => {
                option.selected = false;
                if (option.value == <?= $movie["movie_clasification_id"] ?>) {
                    option.selected = true;
                }
            });
        }

        if (categories.length !== 0) {
            $("#category option").each((_, option) => {
                option.selected = false;
                if (option.value == <?= $movie["category_id"]?>) {
                    option.selected = true;
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>