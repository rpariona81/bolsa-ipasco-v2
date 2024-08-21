<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0">
                <div class="d-sm-flex align-items-center">
                    <div class="col-md-5 col-8 align-self-center">
                        <div class="mb-3">
                            <h5 class="text-dark">Convocatorias</h5>
                        </div>
                    </div>
                    <div class="ms-auto d-flex">
                        <div class="mb-1">
                            <a class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down" data-toggle="tooltip" data-placement="bottom" title="Crear nuevo registro" href="<?=base_url('/admin/newconvocatoria')?>">Nueva convocatoria &nbsp;<i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table id="datatablesSimple" name="datatablesSimple" class="table display nowrap table-hover table-bordered mb-0 border-top text-sm" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>Cod Oferta</th>
                                <th>Programa de estudios</th>
                                <th>Empleador/Empresa</th>
                                <th>Convocatoria</th>
                                <th>Tipo</th>
                                <th># vacantes</th>
                                <th>F. publicación</th>
                                <th>F. vigencia</th>
                                <th>Condición</th>
                                <th># postulantes</th>
                                <th>Última actualización</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($query as $item) : ?>
                                <?php
                                if ($item->vigency == 0) {
                                    echo '<tr class="align-middle">';
                                } else {
                                    echo '<tr class="table-success align-middle">';
                                } ?>
                                <td><?= str_pad($item->id, 6, '0', STR_PAD_LEFT); ?></td>
                                <td><?= $item->career_title ?></td>
                                <td><?= $item->employer ?></td>
                                <td><?= $item->title ?></td>
                                <td><?= $item->type_offer ?></td>
                                <td class="text-center"><?= $item->vacancy_numbers ?></td>
                                <td><?= date_format($item->date_publish, 'd/m/Y') ?></td>
                                <td><?= date_format($item->date_vigency, 'd/m/Y') ?></td>
                                <!--<td>< ?= $item->expired ?></td>-->
                                <?php
                                if ($item->vigency == 0) {
                                    echo '<td><span class="badge bg-secondary border text-white">' . $item->expired . '</span></td>';
                                } else {
                                    echo '<td><span class="badge bg-success border text-white">' . $item->expired . '</span></td>';
                                } ?>
                                <td class="text-center">
                                    <?php
                                    if($item->cant_postulantes){
                                        echo '<div><a class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ver postulantes" href="/admin/convocados/'.$item->id.'">'.$item->cant_postulantes.'&nbsp;&nbsp;<i class="fa fa-users"></i></a></div>';
                                    }else{
                                        echo '0';
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
                                        <?php
                                        if ($item->status) {
                                            echo form_open('admincontroller/desactivaConvocatoria');
                                            echo '<input type="hidden" id="id" name="id" value="' . $item->id . '">';
                                            echo '<button type="submit" name="submit" class="btn btn-outline-danger btn-sm display-inline" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Desactivar"><i class="fa fa-eye-slash"></i></button>';
                                            echo form_close();
                                        } else {
                                            echo form_open('admincontroller/activaConvocatoria');
                                            echo '<input type="hidden" id="id" name="id" value="' . $item->id . '">';
                                            echo '<button type="submit" name="submit" class="btn btn-outline-primary btn-sm display-inline" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Activar"><i class="fa fa-eye"></i></button>';
                                            echo form_close();
                                        }
                                        ?>
                                        &nbsp;&nbsp;
                                        <a class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar" href="<?=base_url('/admin/convocatoria/'. $item->id) ?>"><i class="fa fa-edit"></i></a>
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