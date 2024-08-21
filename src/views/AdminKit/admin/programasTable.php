<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0 bg-light">
                <div class="d-sm-flex align-items-center">
                    <div class="col-md-5 col-8 align-self-center">
                        <div class="mb-3">
                            <h5 class="card-title text-dark">Programas de estudios</h5>
                        </div>
                    </div>

                    <div class="ms-auto d-flex">
                        <div class="mb-1">
                            <a class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down" data-toggle="tooltip" data-placement="bottom" title="Crear nuevo registro" href="<?= base_url('/admin/newprograma') ?>">Nuevo programa&nbsp;&nbsp;<i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?= my_validation_errors(validation_errors()); ?>
            <p class='mt-1 alert' style='color:red'> <?= $this->session->flashdata('flashError') ?> </p>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <!-- <table id="datatablesSimple" name="datatablesSimple" class="table display nowrap table-hover table-bordered mb-0 border-top text-sm" style="width:100%"> -->
                    <table id="datatablesSimple" name="datatablesSimple" class="table table-striped nowrap dataTable no-footer dtr-inline" style="width:100%">
                        <thead>
                            <tr>
                                <th colspan="3" class="heading"></th>
                            </tr>
                            <tr class="table-dark">
                                <th>Cod Programa</th>
                                <th>Programa de estudios</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($query as $item) : ?>
                                <tr class="align-middle">
                                    <td><?= str_pad($item->id, 5, '0', STR_PAD_LEFT); ?></td>
                                    <td><?= $item->career_title ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-outline-warning btn-sm display-inline" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar" href="<?= base_url('/admin/programa/' . $item->id) ?>"><i class="fa fa-edit"></i></a>
                                            &nbsp;&nbsp;<?= form_open('admincontroller/eliminaPrograma', array('class' => 'form-horizontal')); ?>
                                            <input type="hidden" id="id_career" name="id_career" value="<?= $item->id ?>">
                                            <button type="submit" name="submit" class="btn btn-outline-danger btn-sm display-inline" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliminar"><i class="fa fa-trash"></i></button>
                                            <?= form_close(); ?>
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