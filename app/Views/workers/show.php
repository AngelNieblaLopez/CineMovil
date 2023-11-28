<?= $this->extend('layouts/base_layout');
$this->section('title') ?> Crear nuevo trabajador
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('workers') ?>" class="btn btn-primary">Regresar a trabajador</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Crear trabajador</h5>
                        <div class="form-group mb-3">
                            <label clas="form-label">Primer nombre</label>
                            <input type="text" class="form-control" disabled name="firstName"
                                placeholder="Proporcione el primer nombre " value="<?= trim($worker["first_name"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Segundo nombre</label>
                            <input type="text" class="form-control" disabled name="secondName"
                                placeholder="Proporcione el segundo nombre " value="<?= trim($worker["second_name"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Apellido paterno</label>
                            <input type="text" class="form-control" disabled name="lastName"
                                placeholder="Proporcione el apellido paterno " value="<?= trim($worker["last_name"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Apellido materno</label>
                            <input type="text" class="form-control" disabled name="secondLastName"
                                placeholder="Proporcione el apellido materno " value="<?= trim($worker["second_last_name"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">email</label>
                            <input type="password" class="form-control" disabled name="email"
                                placeholder="Proporcione el email " value="<?= trim($worker["email"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Contraseña</label>
                            <input type="password" class="form-control" disabled name="password"
                                placeholder="Proporcione la contraseña" value="<?= trim($worker["password"])?>">
                        </div>
                        <div class="form-group mb-3">
                            <label clas="form-label">Role</label>
                            <select class="form-control" id="role" disabled>
                                <option disabled value="0">- Seleccione -</option>
                                <?php foreach ($roles as $rol): ?>
                                    <option value="<?= $rol['id'] ?>">
                                        <?= $rol['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Tipo de trabajador</label>
                            <select class="form-control" id="typeOfWorker" disabled>
                                <option disabled value="0">- Seleccione -</option>
                                <?php foreach ($typeOfWorkers as $typeOfWorker): ?>
                                    <option value="<?= $typeOfWorker['id'] ?>">
                                        <?= $typeOfWorker['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        let roles = <?= json_encode($roles) ?>;
        let typeOfWorkers = <?= json_encode($typeOfWorkers) ?>;
        let worker = <?= json_encode($worker) ?>;

        if (roles.length !== 0) {
            $('#roleId').val(worker.role_id);
            $("#role option").each((idx, option) => {
                option.selected = false;
                if (option.value == worker.role_id) {
                    option.selected = true;
                }
            });
        }

        if (typeOfWorkers.length !== 0) {
            $('#typeOfWorkerId').val(worker.type_of_worker_id);
            $("#typeOfWorker option").each((idx, option) => {
                option.selected = false;
                if (option.value == worker.type_of_worker_id) {
                    option.selected = true;
                }
            })
        }

        $('#role').change(function () {
            $('#roleId').val($(this).val());
        });

        $('#typeOfWorker').change(function () {
            $('#typeOfWorkerId').val($(this).val());
        });
    });
</script>

<?= $this->endSection() ?>