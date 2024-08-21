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
                            <h5 class="text-dark">DOCENTES</h5>
                        </div>
                    </div>
                    <div class="ms-auto d-flex">
                        <div class="mb-1">
                            <a class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down" data-toggle="tooltip" data-placement="bottom" title="Crear nuevo registro" href="<?= base_url('/admin/newdocente') ?>">Nuevo docente&nbsp;&nbsp;<i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table id="datatablesSimple" name="datatablesSimple" class="table display nowrap table-hover table-bordered mb-0 border-top text-sm" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>Cod Usuario</th>
                                <th>Nombres y apellidos</th>
                                <th>Documento identidad</th>
                                <th>Celular</th>
                                <th>Sexo</th>
                                <th>Email</th>
                                <th>Condición</th>
                                <th>Última actualización</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($query as $item) : ?>
                                <tr class="align-middle">
                                    <td><?= str_pad($item->id, 5, '0', STR_PAD_LEFT); ?></td>
                                    <td><?= $item->name . ' ' . $item->paternal_surname . ' ' . $item->maternal_surname ?></td>
                                    <td><?= $item->document_type_label . ' ' . $item->document_number ?></td>
                                    <td class="text-center"><?= $item->mobile ?></td>
                                    <td><?= $item->gender ?></td>
                                    <td class="text-center"><?= $item->email ?></td>
                                    <td class="text-center"><?= $item->graduated ?></td>
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
                                                //echo '<a class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Desactivar" href="<?= $item->id ? >"><i class="fa fa-eye-slash"></i></a>';
                                                echo form_open('admincontroller/desactivaDocente');
                                                echo '<input type="hidden" id="id" name="id" value="' . $item->id . '">';
                                                echo '<button type="submit" name="submit" class="btn btn-outline-danger btn-sm display-inline" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Desactivar"><i class="fa fa-eye-slash"></i></button>';
                                                echo form_close();
                                            } else {
                                                //echo '<a class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Activar" href="<?= $item->id>"><i class="fa fa fa-eye"></i></a>';
                                                echo form_open('admincontroller/activaDocente');
                                                echo '<input type="hidden" id="id" name="id" value="' . $item->id . '">';
                                                echo '<button type="submit" name="submit" class="btn btn-outline-primary btn-sm display-inline" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Activar"><i class="fa fa-eye"></i></button>';
                                                echo form_close();
                                            }
                                            ?>
                                            &nbsp;&nbsp;
                                            <a class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar" href="<?= base_url('/admin/docente/' . $item->id) ?>"><i class="fa fa-edit"></i></a>
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