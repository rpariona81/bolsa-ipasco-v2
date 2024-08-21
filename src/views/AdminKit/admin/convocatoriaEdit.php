
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
        <div class="card-header bg-light">
                <h4 class="card-title text-dark">Editar convocatoria</h4>
            </div>
            <div class="card-body">
                <?= form_open('admincontroller/actualizaConvocatoria', array('class' => 'row g-3 needs-validation')); ?>
                <div class="row pt-3">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <input type="hidden" value="<?= $convocatoria->id ?>" name="id" id="id">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" id="title" name="title" minlength="10" value="<?= $convocatoria->title ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="type_offer">Tipo de convocatoria</label>
                            <select class="form-control" id="type_offer" name="type_offer" aria-label="Default select example">
                                <option value="">Seleccione</option>
                                <option value="Tiempo parcial" <?= $convocatoria->type_offer == 'Tiempo parcial' ? ' selected="selected"' : ''; ?>>Tiempo parcial</option>
                                <option value="Tiempo completo" <?= $convocatoria->type_offer == 'Tiempo completo' ? ' selected="selected"' : ''; ?>>Tiempo completo</option>
                                <option value="Prácticas pre-profesionales" <?= $convocatoria->type_offer == 'Prácticas pre-profesionales' ? ' selected="selected"' : ''; ?>>Prácticas pre-profesionales</option>
                                <option value="Prácticas profesionales" <?= $convocatoria->type_offer == 'Prácticas profesionales' ? ' selected="selected"' : ''; ?>>Prácticas profesionales</option>
                                <option value="Empleo temporal" <?= $convocatoria->type_offer == 'Empleo temporal' ? ' selected="selected"' : ''; ?>>Empleo temporal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="career_id">Programa de estudios</label>
                            <!--<select class="form-control" id="career_id" name="career_id" aria-label="Default select example">
                                <option value="">Seleccione</option>
                                <option value="1" <?= $convocatoria->career_id == 1 ? ' selected="selected"' : ''; ?>>Arquitectura de Plataformas y Servicios de Tecnologías de la Información</option>
                                <option value="2" <?= $convocatoria->career_id == 2 ? ' selected="selected"' : ''; ?>>Enfermería Técnica</option>
                                <option value="3" <?= $convocatoria->career_id == 3 ? ' selected="selected"' : ''; ?>>Diseño de Modas</option>
                                <option value="4" <?= $convocatoria->career_id == 4 ? ' selected="selected"' : ''; ?>>Gastronomía</option>
                                <option value="5" <?= $convocatoria->career_id == 5 ? ' selected="selected"' : ''; ?>>Mecatrónica Automotriz</option>
                                <option value="6" <?= $convocatoria->career_id == 6 ? ' selected="selected"' : ''; ?>>Cosmetología</option>
                            </select>-->
                            <?=form_dropdown('career_id', $career, $convocatoria->career_id, 'class="form-select" id="career_id" required'); ?>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="employer">Empleador/Empresa</label>
                            <input type="text" class="form-control text-center" id="employer" name="employer" value="<?= $convocatoria->employer ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email_employer">Correo de empleador</label>
                            <input type="email" class="form-control text-center" id="email_employer" name="email_employer" value="<?= $convocatoria->email_employer ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="detail">Detalle</label>
                            <textarea id="detail" name="detail" minlength="30"><?= $convocatoria->detail ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="ubicacion">Ciudad/Localidad</label>
                            <input type="text" class="form-control text-center" id="ubicacion" name="ubicacion" value="<?= $convocatoria->ubicacion ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="vacancy_numbers"># Vacantes</label>
                            <input type="number" class="form-control text-center" id="vacancy_numbers" min="1" max="30" data-toggle="tooltip" data-placement="top" title="Mínimo 1, Máximo 30" name="vacancy_numbers" value="<?= $convocatoria->vacancy_numbers ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="salary">Sueldo</label>
                            <input type="number" class="form-control text-center" id="salary" min="100" max="4000" data-toggle="tooltip" data-placement="top" title="Mínimo 100, Máximo 4000" name="salary" value="<?= $convocatoria->salary ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="turn_horary">Horarios</label>
                            <input type="text" class="form-control text-center" id="turn_horary" name="turn_horary" value="<?= $convocatoria->turn_horary ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="date_publish">Fecha publicación</label>
                            <input type="date" class="form-control text-center" id="date_publish" name="date_publish" value="<?= date_format($convocatoria->date_publish, 'Y-m-d') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="date_vigency">Fecha límite</label>
                            <input type="date" class="form-control text-center" id="date_vigency" name="date_vigency" value="<?= date_format($convocatoria->date_vigency, 'Y-m-d') ?>" onchange="validaFechas();" required>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-6 mx-auto">
                        <div class="d-md-flex align-items-center mt-3">
                            <a href="<?=base_url('/admin/convocatorias')?>" class="btn btn-danger rounded-pill px-4" type="button">Cancelar</a>
                            &nbsp;&nbsp;
                            <input class="btn btn-primary pull-right font-weight-medium rounded-pill px-4" type="submit" value="Actualizar convocatoria" onclick="tinyMCE.triggerSave(true,true);"></input>
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