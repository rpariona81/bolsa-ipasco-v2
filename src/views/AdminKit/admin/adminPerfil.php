<div class="align-items-md-stretch mt-5 mb-3">
    <div class="card border shadow-xs mb-4">
        <div class="card-header border-bottom pb-0 bgl-light">
            <h4 class="card-title text-dark">Datos del administrador</h4>
        </div>
        <?= my_validation_errors(validation_errors()); ?>
        <div class="card-body">
            <?php if ($this->session->flashdata('flashSuccess')) : ?>
                <p class='alert alert-success'> <?= $this->session->flashdata('flashSuccess') ?> </p>
            <?php endif ?>
            <?php if ($this->session->flashdata('flashError')) : ?>
                <p class='alert alert-danger'> <?= $this->session->flashdata('flashError') ?> </p>
            <?php endif ?>

            <?= form_open('admincontroller/actualizaPerfil', array('class' => 'row g-3 needs-validation')); ?>
            <input type="hidden" id="id" name="id" value="<?= $this->session->userdata('user_id') ?>">
            <div class="col-md-4">
                <label for="name" class="form-label">Nombres (*)</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $perfil->name ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4">
                <label for="paternal_surname" class="form-label">Apellido paterno (*)</label>
                <input type="text" class="form-control" id="paternal_surname" name="paternal_surname" value="<?= $perfil->paternal_surname ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4">
                <label for="maternal_surname" class="form-label">Apellido materno</label>
                <input type="text" class="form-control" id="maternal_surname" name="maternal_surname" value="<?= $perfil->maternal_surname ?>">
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-2">
                <label for="username" class="form-label">Usuario (*)</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="inputGroupPrepend" value="<?= $perfil->username ?>">
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <label for="mobile" class="form-label">Teléfono celular:</label>
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?= $perfil->mobile ?>">
                <div class="invalid-feedback">
                    Please provide a valid city.
                </div>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Correo electrónico (*)</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $perfil->email ?>">
                <div class="invalid-feedback">
                    Please provide a valid city.
                </div>
            </div>
            <div class="col-12">
                <div class="float-end">
                    <input class="btn btn-primary" type="submit" value="Actualizar datos"></input>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>