<div class="card border shadow-xs mb-4">
    <div class="card-header border-bottom pb-0">
    <h4 class="card-title text-dark"><i class="fa fa-table"></i> Postulaciones realizadas</h4>
        
    </div>
    <?php if ($this->session->flashdata('flashSuccess')) : ?>
        <p class='alert alert-success'> <?= $this->session->flashdata('flashSuccess') ?> </p>
    <?php endif ?>
    <?php if ($this->session->flashdata('flashError')) : ?>
        <div class="">
            <p class='alert alert-danger'>
                <?= $this->session->flashdata('flashError') ?>
            </p>
        </div>
    <?php endif ?>
    <div class="card-body">
        <div class="table-responsive">
            <!--<table id="expendable-data-table" class="table display nowrap table-bordered table-hover" style="width:100%">-->
            <table id="datatablesSimple" name="datatablesSimple" class="table display nowrap table-hover table-bordered mb-0 border-top text-sm" style="width:100%">
                <thead>
                    <tr class="table-info">
                        <th>Convocatoria</th>
                        <th>Tipo</th>
                        <th>F. publicación</th>
                        <th>F. vigencia</th>
                        <th>F. postulación</th>
                        <th>Archivo CV</th>
                        <th>Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($query as $item) : ?>
                        <tr class="align-middle">
                            <td><?= $item->title ?></td>
                            <td><?= $item->type_offer ?></td>
                            <td><?= date_format($item->date_publish, 'd/m/Y') ?></td>
                            <td><?= date_format($item->date_vigency, 'd/m/Y') ?></td>
                            <td><?= $item->date_postulation ?></td>
                            <td class="text-center">
                                <?php
                                if ($item->filecv == NULL) {
                                } else {
                                    //echo '<a class="btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Descargar CV" target="_blank" download="' . $item->filecv . '" href="' . base_url('/uploads/filescv/' . $item->filecv) . '"><i class="fa fa-file-pdf-o" title="' . $item->filecv . '"></i></a>';
                                    echo '<a class="btn-outline-danger btn-get-started scrollto"  data-toggle="tooltip" data-placement="bottom" title="Descargar CV" target="_blank" download="' . $item->filecv . '" href="' . base_url('/uploads/filescv/' . $item->filecv) . '">
                                                <i class="fa fa-file-pdf-o" aria-hidden="true" title="' . $item->filecv . '"></i>' . $item->filecv;
                                }
                                ?>
                            </td>
                            <td><?= $item->detail_label ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>