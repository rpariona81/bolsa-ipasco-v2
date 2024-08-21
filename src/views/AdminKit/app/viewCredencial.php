<div class="row align-items-center justify-content-center mt-5 mb-3">
    <div class="col-12 col-md-8 col-lg-4">
        <div class="card border shadow-xs mb-4">
        <div class="card-header border-bottom pb-0">
                    <h5> Cambiar clave de usuario</h5>
                    
                </div>
            <div class="card-body">
                
                <?php if ($this->session->flashdata('flashSuccess')) : ?>
                    <p class='alert alert-success'> <?= $this->session->flashdata('flashSuccess') ?> </p>
                <?php endif ?>

                <?php if ($this->session->flashdata('flashError')) : ?>
                    <p class='alert alert-danger'> <?= $this->session->flashdata('flashError') ?> </p>
                <?php endif ?>

                <?= form_open('appcontroller/cambiarclave') ?>
                <div class="mb-3">
                    <label for="clave_act" class="form-label">Clave Actual</label>
                    <input type="password" id="clave_act" class="form-control" name="clave_act" placeholder="Contraseña actual" required>
                </div>
                <div class="mb-3">
                    <label for="clave_new" class="form-label">Clave Nueva</label>
                    <input type="password" id="clave_new" class="form-control" name="clave_new" placeholder="Nueva contraseña" required>
                </div>
                <div class="mb-3">
                    <label for="clave_rep" class="form-label">Repita Nueva</label>
                    <input type="password" id="clave_rep" class="form-control" name="clave_rep" placeholder="Repita nueva contraseña" required>
                </div>
                <div class="mt-4 mb-2 d-grid">
                    <button type="submit" class="btn btn-primary btn-block">
                        Cambiar clave
                    </button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>