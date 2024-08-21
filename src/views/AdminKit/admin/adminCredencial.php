<div class="row align-items-center justify-content-center mt-5 mb-5">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="mb-4">
                    <h3> Cambiar clave</h3>
                    <hr>
                </div>
                <?php if ($this->session->flashdata('flashSuccess')) : ?>
                    <p class='alert alert-success'> <?= $this->session->flashdata('flashSuccess') ?> </p>
                <?php endif ?>

                <?php if ($this->session->flashdata('flashError')) : ?>
                    <p class='alert alert-danger'> <?= $this->session->flashdata('flashError') ?> </p>
                <?php endif ?>

                <?= form_open('admincontroller/cambiarClave') ?>
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
                <div class="mb-3 d-grid">
                    <button type="submit" class="btn btn-primary">
                        Cambiar clave
                    </button>
                </div>
                
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>