<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0 bg-light">
                <div class="row pt-3">
                    <div class="col-md-6 col-lg-12 align-self-center">
                        <div class="mb-3">
                            <h5 class="card-title text-dark"><u>Postulaciones a la convocatoria Cód.&nbsp;<?= str_pad($query['convocatoria']->id, 5, '0', STR_PAD_LEFT) ?></u></h5>
                            <strong class="card-title"><?= $query['convocatoria']->title ?></strong><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-bottom border-1">
                <strong class="card-title">
                    <font color="red"><?= $query['convocatoria']->employer ?></font>
                </strong><br>
                <strong class="card-title">Tipo de oferta:</strong> <?= $query['convocatoria']->type_offer ?><br>
                <strong>Número de vacantes:</strong> <?= $query['convocatoria']->vacancy_numbers ?><br>
                <strong>Fecha de publicación:</strong> <?= date_format($query['convocatoria']->date_publish, 'd/m/Y') ?><br>
                <strong>Fecha límite de postulación:</strong> <?= date_format($query['convocatoria']->date_vigency, 'd/m/Y') ?><br>
                <strong>Sueldo:&nbsp;S/&nbsp;<?= $query['convocatoria']->salary ?></strong><br>
                <strong>Horario:&nbsp;<?= $query['convocatoria']->turn_horary ?></strong><br>
                <strong>Email de empresa/empleador:&nbsp;<?= $query['convocatoria']->email_employer ?></strong>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <!--<table id="datatablesSimple" name="datatablesSimple" class="table display nowrap table-hover table-bordered mb-0 border-top text-sm" style="width:100%">-->
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
                            <?php foreach ($query['convocados'] as $item) : ?>
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
                                    <td class="text-center">
                                        <?php
                                        if ($item->date_postulation) {
                                            echo date_format($item->date_postulation, 'd/m/Y');
                                        } else {
                                        }
                                        ?>
                                    </td>
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
                    <div class="col-auto">
                        <a class="btn btn-primary" href="<?= base_url('/admin/convocatorias') ?>">Regresar</a>
                    </div>
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