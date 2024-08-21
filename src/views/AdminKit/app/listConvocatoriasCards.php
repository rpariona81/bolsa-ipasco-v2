<!--https://www.codeply.com/p/t6GGNuV2yb-->
<div class="row mb-5">
    <div class="col-12">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-2">
                <ul class="nav nav-tabs card-header-tabs" data-tabs="tabs" id="convocatorias-list">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" data-toggle="tab" href="#vigentes"><strong>Convocatorias vigentes</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#novigentes"><strong>Convocatorias no vigentes</strong></a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content">
                <div class="tab-pane active" id="vigentes">
                    <div class="row">
                        <?php if ($recuento['contVigentes'] == 0) : ?>
                            <h6 class="ml-5">
                                <font color="red"><em>No hay convocatorias vigentes.</em></font>
                            </h6>
                        <?php endif ?>
                        <?php foreach ($queryVigentes as $item) : ?>
                            <div class="col-md-6 col-lg-6 mb-4">
                                <div class="card border border-1 p-1" style="min-height:340px; max-height:340px;">
                                    <div class="card-header">
                                        <h6><strong><?= $item->title ?></strong></h6>
                                        <h6>
                                            <font color="red"><em><?= $item->employer ?></em></font>
                                        </h6>
                                    </div>
                                    <div class="card-body d-flex flex-column text-sm">
                                        <!--<ul style="list-style: none; padding: 0; margin: 0;">-->
                                        <ul class="list-unstyled mt-0 mb-4">
                                            <li>
                                                <i class="fa fa-calendar" style="height: 20px; width: 20px; text-align: center;"></i>
                                                <span>&nbsp;Finaliza el <?= date("d/m/Y", strtotime($item->date_vigency)); ?></span>&nbsp;
                                                <span class="badge bg-info text-dark px-4"><?= $item->expired ?></span>
                                            </li>
                                            <li>
                                                <i class="fa fa-map-marker" style="height: 20px; width: 20px; text-align: center;"></i>
                                                <span>&nbsp;<?= $item->ubicacion ?></span>
                                            </li>
                                            <li>
                                                <i class="fa fa fa-money" style="height: 20px; width: 20px; text-align: center;"></i>
                                                <span>&nbsp;S/&nbsp;<?= $item->salary ?></span>
                                            </li>
                                            <li>
                                                <i class="fa fa-graduation-cap" style="height: 20px; width: 20px; text-align: center;"></i>
                                                <span>&nbsp;<?= $item->career_title . ' [Cód. ' . str_pad($item->id, 6, '0', STR_PAD_LEFT) . ']'; ?></span>
                                            </li>
                                            <li>
                                                <i class="fa fa-users" style="height: 20px; width: 20px; text-align: center;"></i>
                                                <span>&nbsp;<?= $item->vacancy_numbers ?>&nbsp;vacantes - &nbsp;<?= $item->type_offer ?></span>
                                            </li>
                                        </ul>
                                        <a type="button" class="align-self-end btn btn-lg btn-block btn-primary" style="margin-top: auto;" href="<?=base_url('/users/convocatoria/'.$item->id) ?>"><strong>Ver convocatoria</strong></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tab-pane" id="novigentes">
                    <div class="row">
                        <?php if ($recuento['contNoVigentes'] == 0) : ?>
                            <h6 class="ml-5">
                                <font color="red"><em>No hay convocatorias no vigentes.</em></font>
                            </h6>
                        <?php endif ?>
                        <?php foreach ($queryNoVigentes as $item) : ?>
                            <div class="col-md-6 col-lg-6 mb-4">
                                <div class="card border border-1 p-1" style="min-height:340px; max-height:340px;">
                                    <div class="card-header border-bottom pb-2">
                                        <h6><strong><?= $item->title ?></strong></h6>
                                        <h6>
                                            <font color="red"><em><?= $item->employer ?></em></font>
                                        </h6>
                                    </div>
                                    <div class="card-body d-flex flex-column text-sm">
                                        <!--<ul style="list-style: none; padding: 0; margin: 0;">-->
                                        <ul class="list-unstyled mt-0 mb-4">
                                            <li>
                                                <i class="fa fa-calendar" style="height: 20px; width: 20px; text-align: center;"></i>
                                                <span>&nbsp;Finaliza el <?= date("d/m/Y", strtotime($item->date_vigency)); ?></span>&nbsp;
                                                <span class="badge bg-danger text-white"><?= $item->expired ?></span>
                                            </li>
                                            <li>
                                                <i class="fa fa-map-marker" style="height: 20px; width: 20px; text-align: center;"></i>
                                                <span>&nbsp;<?= $item->ubicacion ?></span>
                                            </li>
                                            <li>
                                                <i class="fa fa fa-money" style="height: 20px; width: 20px; text-align: center;"></i>
                                                <span>&nbsp;S/&nbsp;<?= $item->salary ?></span>
                                            </li>
                                            <li>
                                                <i class="fa fa-graduation-cap" style="height: 20px; width: 20px; text-align: center;"></i>
                                                <span>&nbsp;<?= $item->career_title . ' [Cód. ' . str_pad($item->id, 6, '0', STR_PAD_LEFT) . ']'; ?></span>
                                            </li>
                                            <li>
                                                <i class="fa fa-users" style="height: 20px; width: 20px; text-align: center;"></i>
                                                <span>&nbsp;<?= $item->vacancy_numbers ?>&nbsp;vacantes - &nbsp;<?= $item->type_offer ?></span>
                                            </li>
                                        </ul>
                                        <a type="button" class="align-self-end btn btn-lg btn-block btn-danger" style="margin-top: auto;" href="<?=base_url('/users/convocatoria/'.$item->id); ?>"><strong>Ver convocatoria</strong></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!--<script>
    $(function() {
            $("#convocatorias-list").tabs();
            $("#convocatorias-list").tabs("load", '#vigentes');
        });
    /*$(window).load(function() {
        $('.nav-tabs a[href="#vigentes"]').tab('show');
    });*/
    /*$('#convocatorias-list a').on('click', function(e) {
        e.preventDefault();
        $(this).tab('show');
    });*/
</script>-->