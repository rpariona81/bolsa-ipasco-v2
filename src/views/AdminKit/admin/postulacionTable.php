<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0 bg-light">
                <!--https://stackoverflow.com/questions/18842946/refresh-form-page-after-submitting-the-form-->
                <?= form_open('', array('id' => 'FRM_DATOS', 'class' => 'needs-validation', 'onsubmit' => 'window.location.reload()')); ?>
                <!--< ?= form_open('', array('id' => 'FRM_DATOS', 'class' => 'needs-validation')); ?>-->
                <div class="row pt-3">
                    <div class="col-md-4 col-lg-4 align-self-center">
                        <div class="mb-3">
                            <h5 class="card-title text-dark">Postulaciones</h5>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8 mx-auto">
                        <div class="mb-3">
                            <div class="input-group mb-3">
                                <!--<select class="form-control" id="career_id" name="career_id" va aria-label="Default select example">
                                    <option value="">Todos los programas</option>
                                    < !--<option value="1">Arquitectura de Plataformas y Servicios de Tecnologías de la Información</option>
                                    <option value="2">Enfermería Técnica</option>
                                    <option value="3">Diseño de Modas</option>
                                    <option value="4">Gastronomía</option>
                                    <option value="5">Mecatrónica Automotriz</option>-->
                                <!--<option value="1" <?= $selectValue == 1 ? ' selected="selected"' : ''; ?>>Arquitectura de Plataformas y Servicios de Tecnologías de la Información</option>
                                    <option value="2" <?= $selectValue == 2 ? ' selected="selected"' : ''; ?>>Enfermería Técnica</option>
                                    <option value="3" <?= $selectValue == 3 ? ' selected="selected"' : ''; ?>>Diseño de Modas</option>
                                    <option value="4" <?= $selectValue == 4 ? ' selected="selected"' : ''; ?>>Gastronomía</option>
                                    <option value="5" <?= $selectValue == 5 ? ' selected="selected"' : ''; ?>>Mecatrónica Automotriz</option>
                                    <option value="6" <?= $selectValue == 6 ? ' selected="selected"' : ''; ?>>Cosmetología</option>
                                </select>-->
                                <?= form_dropdown('career_id', $career, $selectValue, 'class="form-select" id="career_id" required'); ?>
                                <button class="btn btn-primary pull-right font-weight-medium px-4 mb-0" type="submit">
                                    <!--<i class="ti-search"></i>-->
                                    <i class="fa fa-search"></i>&nbsp;Filtrar por programa
                                    <!--<i class="fa fa-filter"></i>-->
                                </button>
                                <a class="btn btn-danger" href="<?= base_url('/admin/postulaciones') ?>">Limpiar filtro</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <!-- <table id="datatablesSimple" name="datatablesSimple" class="table display nowrap table-hover table-bordered mb-0 border-top text-sm" style="width:100%"> -->
                    <table id="datatablesSimple" name="datatablesSimple" class="table table-striped nowrap dataTable no-footer dtr-inline" style="width:100%">
                        <thead>
                            <tr>
                                <th colspan="12" class="heading"></th>
                            </tr>
                            <tr class="table-dark">
                                <th>Cod Postulación</th>
                                <th>Cod Oferta</th>
                                <th>Programa de estudios</th>
                                <th>Convocatoria</th>
                                <th>Tipo</th>
                                <th>F. publicación</th>
                                <th>F. vigencia</th>
                                <th>Postulante</th>
                                <th>Condición</th>
                                <th>F. Postulación</th>
                                <th>Última actualización</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($query as $item) : ?>
                                <tr class="align-middle">
                                    <td><?= str_pad($item->id, 7, '0', STR_PAD_LEFT); ?></td>
                                    <td><?= str_pad($item->offer_id, 6, '0', STR_PAD_LEFT); ?></td>
                                    <td><?= $item->career_title ?></td>
                                    <td><?= $item->title ?></td>
                                    <td><?= $item->type_offer ?></td>
                                    <td><?= date_format($item->date_publish, 'd/m/Y') ?></td>
                                    <td><?= date_format($item->date_vigency, 'd/m/Y') ?></td>
                                    <td><?= $item->name . ' ' . $item->paternal_surname . ' ' . $item->maternal_surname ?></td>
                                    <td><?= $item->graduated ?></td>
                                    <td class="text-center"><?= date_format($item->date_postulation, 'd/m/Y') ?></td>
                                    <td><?= $item->updated_at ?></td>
                                    <td>
                                        <?php
                                        if ($item->status) {
                                            echo '<span class="badge bg-info border text-dark">' . $item->flag . '</span>';
                                        } else {
                                            echo '<span class="badge bg-danger border text-dark">' . $item->flag . '</span>';
                                        }
                                        ?>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Descargar CV" target="_blank" download="<?= $item->filecv; ?>" href="<?= base_url('/uploads/filescv/' . $item->filecv); ?>">
                                                <i class="fa fa-file-pdf-o" title="<?= $item->filecv ?>"></i>
                                            </a>
                                            &nbsp;&nbsp;
                                            <?php
                                            if ($item->status) {
                                                //echo 'funciona';
                                                //$attributes = array('name' => 'admincontroller/desactivaPostulacion','id' => 'desactivaPostulacion', 'method' =>'POST');
                                                echo form_open("admincontroller/desactivaPostulacion"); //form open
                                                //echo '<form action="'.$action_form.'" method="POST">';
                                                echo '<input type="hidden" id="id" name="id" value="' . $item->id . '">';
                                                echo '<input type="hidden" id="career_id" name="career_id" value="' . $item->career_id . '">';
                                                //echo '<button type="submit" name="submit" class="btn '.$icon_form.' btn-sm display-inline" data-toggle="tooltip" value="' . $item->status . '" data-placement="bottom" title="Desactivar"><i class="fa fa-eye-slash"></i></button>';
                                                echo '<button type="submit" name="submit" class="btn btn-outline-danger btn-sm display-inline" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Desactivar"><i class="fa fa-eye-slash"></i></button>';
                                                echo form_close();
                                            } else {
                                                //echo 'no funciona';
                                                //$attributes = array('name' => 'admincontroller/activaPostulacion','id' => 'activaPostulacion', 'method' =>'POST');
                                                echo form_open("admincontroller/activaPostulacion"); //form open
                                                //echo '<form action="admincontroller/activaPostulacion" method="POST">';
                                                echo '<input type="hidden" id="id" name="id" value="' . $item->id . '">';
                                                echo '<input type="hidden" id="career_id" name="career_id" value="' . $item->career_id . '">';
                                                echo '<button type="submit" name="submit" class="btn btn-outline-primary btn-sm display-inline" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Activar"><i class="fa fa-eye"></i></button>';
                                                //echo '</form>';
                                                echo form_close();
                                            }
                                            ?>
                                            &nbsp;&nbsp;
                                            <a class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar" href="<?= base_url('/admin/postulacion/' . $item->id) ?>"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<script>
    /*$(function() {
        $('#FRM_DATOS').on('submit', function(e) {
            e.preventDefault();
            setTimeout(function() {
                window.location.reload();
            }, 0);
            $()
            this.submit();
        });
    });*/
</script>-->