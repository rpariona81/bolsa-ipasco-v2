<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!--<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-primary m-b-0 m-t-0">NUEVA CONVOCATORIA</h3>
    </div>
</div>-->
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title text-dark">Registro de convocatoria</h4>
            </div>
            <div class="card-body">
                <?= form_open('admincontroller/creaConvocatoria', array('id' => 'FRM_DATOS', 'class' => 'needs-validation', 'onsubmit' => 'grabar.disabled = true; return true;')); ?>
                <div class="row pt-3">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" id="title" name="title" minlength="10" value="<?php echo set_value('title') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="type_offer">Tipo de convocatoria</label>
                            <select class="form-control" id="type_offer" name="type_offer" aria-label="Default select example" required>
                                <option value="" selected>Seleccione</option>
                                <option value="Tiempo parcial">Tiempo parcial</option>
                                <option value="Tiempo completo">Tiempo completo</option>
                                <option value="Prácticas pre-profesionales">Prácticas pre-profesionales</option>
                                <option value="Prácticas profesionales">Prácticas profesionales</option>
                                <option value="Empleo temporal">Empleo temporal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="career_id">Programa de estudios</label>
                            <!--<select class="form-control" id="career_id" name="career_id" aria-label="Default select example" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Arquitectura de Plataformas y Servicios de Tecnologías de la Información</option>
                                <option value="2">Enfermería Técnica</option>
                                <option value="3">Diseño de Modas</option>
                                <option value="4">Gastronomía</option>
                                <option value="5">Mecatrónica Automotriz</option>
                                <option value="6">Cosmetología</option>
                            </select>-->
                            <?=form_dropdown('career_id', $career, set_value('career_id'), 'class="form-select" id="career_id" required'); ?>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="employer">Empleador/Empresa</label>
                            <input type="text" class="form-control text-center" id="employer" name="employer" value="<?php echo set_value('employer') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email_employer">Correo de empleador</label>
                            <input type="email" class="form-control text-center" id="email_employer" name="email_employer" value="<?php echo set_value('email_employer') ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="detail">Detalle</label>
                            <!--<textarea class="form-control" id="detail" name="detail" minlength="30" required>< ?php echo set_value('detail') ?></textarea>-->
                            <textarea class="form-control" id="detail" name="detail" minlength="30"><?php echo set_value('detail') ?></textarea>
                            <!--<textarea class="form-control" id="detail" name="detail"></textarea>-->
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="ubicacion">Ciudad/Localidad</label>
                            <input type="text" class="form-control text-center" id="ubicacion" name="ubicacion" value="<?php echo set_value('ubicacion') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="vacancy_numbers"># Vacantes</label>
                            <input type="number" class="form-control text-center" min="1" max="30" data-toggle="tooltip" data-placement="top" title="Mínimo 1, Máximo 30" id="vacancy_numbers" name="vacancy_numbers" value="<?php echo set_value('vacancy_numbers') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="salary">Sueldo</label>
                            <input type="number" class="form-control text-center" id="salary" min="100" max="4000" data-toggle="tooltip" data-placement="top" title="Mínimo 100, Máximo 4000" name="salary" value="<?php echo set_value('salary') ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="turn_horary">Horarios</label>
                            <input type="text" class="form-control text-center" id="turn_horary" name="turn_horary" value="<?php echo set_value('turn_horary') ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="date_publish">Fecha publicación</label>
                            <input type="date" class="form-control text-center" id="date_publish" name="date_publish" value="<?php echo set_value('date_publish') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="date_vigency">Fecha límite</label>
                            <input type="date" class="form-control text-center" id="date_vigency" name="date_vigency" value="<?php echo set_value('date_vigency') ?>" onchange="validaFechas();" required>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-6 mx-auto">
                        <div class="d-md-flex align-items-center mt-3">
                            <a href="<?=base_url('/admin/convocatorias')?>" class="btn btn-danger rounded-pill px-4" type="button">Cancelar</a>
                            &nbsp;&nbsp;
                            <input class="btn btn-primary pull-right font-weight-medium rounded-pill px-4" type="submit" value="Crear convocatoria" onclick="tinyMCE.triggerSave(true,true);"></input>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(':input[type="number"]').change(function() {
            var max = parseInt($(this).attr('max'));
            var min = parseInt($(this).attr('min'));
            if ($(this).val() > max) {
                $(this).val(max);
            } else if ($(this).val() < min) {
                $(this).val(min);
            }
        });
    });
</script>

<script>
    function getDateObj(dateString) {
        var parts = dateString.split('-');
        var date = parts[2];
        var month = parts[1];
        var year = parts[0];
        return new Date(year, month, date).getTime();
    }
</script>

<script>
    function validaFechas() {
        var date1 = document.getElementById('date_publish').value;
        var date2 = document.getElementById('date_vigency').value;
        //console.log(date1 + "---" + date2);
        var dateObjFrom = getDateObj(date1);
        var dateObjTo = getDateObj(date2);
        console.log(dateObjFrom + "---" + dateObjTo);
        //alert(dateObjTo);
        if (dateObjFrom > dateObjTo) {
            console.log('La fecha de publicación no puede ser mayor a la fecha límite.');
            alert('La fecha de publicación no puede ser mayor a la fecha límite.');
            $("#date_vigency").val('');
        }
    }
</script>