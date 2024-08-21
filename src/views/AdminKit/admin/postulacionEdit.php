<div class="align-items-md-stretch mt-5">
    <div class="card">
    <div class="card-header bg-light">
            <h4 class="card-title text-dark">Código de postulación: &nbsp;<?= str_pad($postulacion->id, 6, '0', STR_PAD_LEFT) ?></h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <strong class="card-title">Código de oferta: &nbsp;<?= str_pad($postulacion->offer_id, 5, '0', STR_PAD_LEFT) ?></strong><br>
            </div>
            <strong class="card-title"><?= $postulacion->title ?></strong><br>
            <strong class="card-title"><font color="red"><?= $postulacion->employer ?></font></strong><br>
            <strong class="card-title">Tipo de oferta:</strong> <?= $postulacion->type_offer ?><br>
            <strong>Detalle:</strong> <?= html_entity_decode($postulacion->detail) ?><br>
            <strong>Número de vacantes:</strong> <?= $postulacion->vacancy_numbers ?><br>
            <strong>Fecha de publicación:</strong> <?= date_format($postulacion->date_publish, 'd/m/Y') ?><br>
            <strong>Fecha límite de postulación:</strong> <?= date_format($postulacion->date_vigency, 'd/m/Y') ?><br>
            <strong>Sueldo:&nbsp;S/&nbsp;<?= $postulacion->salary ?></strong><br>
            <strong>Horario:&nbsp;<?= $postulacion->turn_horary ?></strong><br>
            <strong>Email de empresa/empleador:&nbsp;<?= $postulacion->email_employer ?></strong><br>
            <hr>
            <div class="alert alert-primary">
                <strong class="card-title">Datos de postulante: &nbsp;<?= $postulacion->name . ' ' . $postulacion->paternal_surname . ' ' . $postulacion->maternal_surname ?></strong><br>
            </div>
            <strong class="card-title">Correo:</strong> <?= $postulacion->email ?><br>
            <strong class="card-title">Celular:</strong> <?= $postulacion->mobile ?><br>
            <strong>Condición:</strong> <?= $postulacion->graduated ?><br>
            <strong>Fecha de postulación:</strong> <?= date_format($postulacion->date_postulation, 'd/m/Y') ?><br>
            <hr>
            <?php if ($this->session->flashdata('flashSuccess')) : ?>
                <p class='alert alert-success'> <?= $this->session->flashdata('flashSuccess') ?> </p>
            <?php endif ?>
            <?= form_open('admincontroller/resultPostulacion', array('class' => 'row g-4')) ?>
            <input type="hidden" value="<?= $postulacion->id ?>" name="id" id="id">
            <div class="col-auto">
                <strong>Descarga CV:</strong> <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Descargar CV" target="_blank" download="<?= $postulacion->filecv; ?>" href="<?= base_url('/uploads/filescv/' . $postulacion->filecv); ?>">
                <i class="fa fa-file-pdf-o" title="<?= $postulacion->filecv ?>"></i></a>
            </div>
            <div class="col-auto">
                <?=form_dropdown('result', $result, $postulacion->result, 'class="form-select" id="result"'); ?>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit"></i>Actualizar estado de postulación</button>
                <a class="btn btn-danger" href="<?=base_url('/admin/postulaciones')?>">Regresar</a>
            </div>

            <?= form_close() ?>
            <hr>
        </div>
    </div>
</div>
<script type="text/javascript">
    function modal_postulante() {
        $('#fileUploadModal').modal('show');
    }
</script>
<!-- Modal -->
<div id="fileUploadModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= form_open('appcontroller/postular', array('enctype' => 'multipart/form-data')) ?>
            <div class="modal-header">
                <h5 class="modal-title">Realizar postulación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Puede agregar un mensaje:</p>
                <input type="hidden" name="offer_id" value="<?= $postulacion->id ?>">
                <textarea class="form-control" id="msg_postulant" name="msg_postulant" value="$this->msg_postulant"></textarea>
                <br>
                <p>Cargue archivo PDF (máx. 4 MB): </p>
                <input type='file' name='filecv' id='filecv' class='form-control'><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <input type='submit' class='btn btn-info' value='Confirmar postulación' id='btn_upload'>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>