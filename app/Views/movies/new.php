<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nueva película
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('movies') ?>" class="btn btn-primary">Regresar a peliculas</a>
        </div>

        <div class="row">
            <div class="col-xl-6 m-auto">
                <form action="<?= base_url('api/web/movies/v1') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Crear película</h5>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Proporcione el nombre ">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Descripción</label>
                                        <input type="text" class="form-control" name="description" placeholder="Proporcione la descripción">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Categoría</label>
                                        <select class="form-control" id="category">
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
                                        <select class="form-control" id="clasification">
                                            <option disabled value="0">- Seleccione -</option>
                                            <?php foreach ($clasifications as $clasification) : ?>
                                                <option value="<?= $clasification['id'] ?>">
                                                    <?= $clasification['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    
                                    <div class="form-group mb-3">
                                        <label clas="form-label">Duración</label>
                                        <input type="number" class="form-control" name="duration" placeholder="Proporcione la duración">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label clas="form-label">URL poster</label>
                                        <input type="url" class="form-control" name="imageUrl" placeholder="Proporcione el url de la imágen">
                                    </div>

                                    <input id="categoryId" hidden name="categoryId">
                                    <input id="clasificationId" hidden name="clasificationId">

                                    <button type="submit" class="btn btn-success">Guardar película</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        let categories = <?= json_encode($categories) ?>;
        let clasifications = <?= json_encode($clasifications) ?>;

        if (clasifications.length !== 0) {
            $('#clasificationId').val(clasifications[0].id);
            $("#clasification option").each((_, option) => {
                option.selected = false;
                if (option.value == clasifications[0].id) {
                    option.selected = true;
                }
            });
        }

        if (categories.length !== 0) {
            $('#categoryId').val(categories[0].id);
            $("#category option").each((_, option) => {
                option.selected = false;
                if (option.value == categories[0].id) {
                    option.selected = true;
                }
            });
        }

        $('#clasification').change(function() {
            $('#categoryId').val($(this).val());
        });

        $('#category').change(function() {
            $('#clasificationId').val($(this).val());
        });
    });
</script>

<?= $this->endSection() ?>