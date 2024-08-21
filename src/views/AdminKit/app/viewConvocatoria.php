<div class="card border shadow-xs">
    <div class="card-header border-bottom">
        <h5 class="card-title">
            <strong class="text-dark"><?= $convocatoria->title ?></strong>
        </h5>
        <h5>
            <font color="red"><em>
                    <?= $convocatoria->employer ?></em></font>
        </h5>
    </div>
    <div class="card-body">
        <strong class="card-title">Tipo de oferta:
            <?= $convocatoria->type_offer ?>
        </strong>
        <br>
        <p><strong>Detalle:</strong>
            <?= html_entity_decode($convocatoria->detail) ?>
        </p>
        <p>Número de vacantes:
            <?= $convocatoria->vacancy_numbers ?>
        </p>
        <p>Fecha de publicación:
            <?= date_format($convocatoria->date_publish, 'd/m/Y') ?>
        </p>
        <p>Fecha límite de postulación:
            <?= date_format($convocatoria->date_vigency, 'd/m/Y') ?>
        </p>
        <p>Horario:
            <?= $convocatoria->turn_horary ?>
        </p>
        <p>Sueldo:&nbsp;S/.&nbsp;
            <?= $convocatoria->salary ?>
        </p>
        <p>Condición:
            <?= $convocatoria->expired ?>
        </p>
        <div class="alert alert-secondary">
            <strong>Programa de estudios:
                <?= $convocatoria->career_title ?>
            </strong>
        </div>
        <div class="col-12">
            <div class="float-end">
                <a class="btn btn-warning btn-lg" href="<?= base_url('/users') ?>">Regresar</a>
                <?php
                if ($this->session->userdata('user_rol') == 'estudiante') {
                    if ($checkPostulation) {
                        echo '<button class="btn btn-outline-success btn-lg" disabled></i>Ya postulaste</button>';
                    } else {
                        echo '<button class="btn btn-success btn-lg" onclick="modal_postulante()"></i>Postular >>></button>';
                    }
                } else {
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function modal_postulante() {
        $('#fileUploadModal').modal('show');
        $("#btn_upload").prop('disabled', true);
        $("#msg_postulant").val('');
        $("#filecv").val('');
    }
</script>
<!-- Modal -->
<div id="fileUploadModal" class="modal text-sm" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= form_open('appcontroller/postular', array('enctype' => 'multipart/form-data')) ?>
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">Realizar postulación</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <!--<span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="offer_id" value="<?= $convocatoria->id ?>">
                <input type="hidden" name="offer_title" value="<?= $convocatoria->title ?>">
                <input type="hidden" name="offer_email" value="<?= $convocatoria->email_employer ?>">
                <strong>Datos de Postulante:</strong><br>
                <p>Nombres&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?= $this->session->userdata('user_name') . " " . $this->session->userdata('user_paterno') ?><br>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?= $this->session->userdata('user_email') ?></br>P. Estudios&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?= $this->session->userdata('user_carrera') ?></p>
                <p>Mensaje (*):
                    <textarea class="form-control" id="msg_postulant" name="msg_postulant" placeholder="Redacte un mensaje..." value="<?= set_value('msg_postulant') ?>"></textarea>
                </p>
                <p>Cargue archivo PDF (máx. 4 MB) (*):
                    <input type='file' name='filecv' id='filecv' class='file form-control' data-browse-on-zone-click='true' required>
                </p>
                <div id="modal-gral">
                    <!--<div class="alert">-->
                    <div id="modal-msg">
                        <div id="modal-title">
                        </div>
                    </div>
                    <!--</div>-->
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <input type='submit' class='btn btn-success' value='Confirmar postulación' id='btn_upload' disabled>
            </div>
            <?= form_close() ?>

        </div>
        <script type="text/javascript">
            $('input[type="file"]').on('change', function() {
                var ext = $(this).val().split('.').pop();
                if ($(this).val() != '') {
                    if (ext == "pdf") {
                        //alert("La extensión es: " + ext);
                        if ($(this)[0].files[0].size > 4194304) {
                            console.log("El documento excede el tamaño máximo");
                            $('#modal-title').text('¡Precaución!');
                            $('#modal-msg').html("Se solicita un archivo no mayor a 4MB. Por favor verifica.");
                            $("#modal-gral").modal();
                            $("#btn_upload").prop('disabled', true);
                            $(this).val('');
                        } else {
                            $("#modal-gral").hide();
                            $("#btn_upload").prop('disabled', false);
                        }
                    } else {
                        $(this).val('');
                        //alert("Extensión no permitida: " + ext);
                        $('#modal-title').text("Extensión no permitida: " + ext);
                        $("#btn_upload").prop('disabled', true);
                    }
                }
            });
        </script>
    </div>
</div>