<!--https://www.codeply.com/p/t6GGNuV2yb-->
<div class="container-fluid network_wrapper col-sm p-0 ">
    <div class="card border-secondary">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" data-tabs="tabs" id="convocatorias-list">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" data-toggle="tab" href="#vigentes">Convocatorias vigentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#novigentes">Convocatorias no vigentes</a>
                </li>
            </ul>
        </div>
        <div class="card-body tab-content">
            <div class="tab-pane active" id="vigentes">
                <?php //print_r($recuento);
                ?>
                <?php print_r($queryVigentes) ?>
                <?php if ($recuento['contVigentes'] == 0) {
                    echo "<h5 class='card-title text-center'>No hay convocatorias vigentes.</h5>";
                } else {
                    if ($recuento['contVigentes'] > 0) {
                        foreach ($queryVigentes as $vigente) :
                            if ($vigente->vigency == 1) {
                ?>
                                <div class="col-md-6 col-lg-6">
                                    <article class="mb-4" style="text-align: left; width: calc(100% / 2 - 12px); display: inline-block; margin-right: 4px;margin-left: 4px;">
                                        <section class="h-100 border border-1 border-info border-radius-pill text-bg-dark rounded-3">
                                            <div class="bg-light p-3">
                                                <h4><?= substr(html_entity_decode($vigente->title), 0, 33) . '...' ?></h4>
                                                <h5>
                                                    <font color="red"><em><?= substr(html_entity_decode($vigente->employer), 0, 33) . '...'  ?></em></font>
                                                </h5>
                                            </div>
                                            <div class="p-3">
                                                <ul style="list-style: none; padding: 0; margin: 0;">
                                                    <li>
                                                        <i class="fa fa-calendar" style="height: 20px; width: 20px; text-align: center;"></i><span>&nbsp;Finaliza el <?= date("d/m/Y", strtotime($vigente->date_vigency)); ?></span>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-map-marker" style="height: 20px; width: 20px; text-align: center;"></i><span>&nbsp;<?= $vigente->ubicacion ?></span>
                                                    </li>
                                                </ul>
                                                <!--<br>-->
                                                <p class="card-text"><?= substr(html_entity_decode($vigente->detail), 0, 100) . '...' ?></p>
                                                <p> <small class="text-muted">Sueldo:&nbsp;S/&nbsp;<?= $vigente->salary ?></small><br>
                                                    <small><?= $vigente->career_title ?></small>
                                                </p>
                                                <!--<div class="float-end">-->
                                                <!--<div class="">-->
                                                <a class="bg-success btn input-block-level form-control btn-outline-success" href="/users/convocatoria/<?= $vigente->id; ?>"><strong>Ver convocatoria</strong></a>
                                                <!--</div>-->
                                        </section>
                                    </article>
                                </div>
                <?php }
                        endforeach;
                    }
                } ?>
            </div>
            <div class="tab-pane" id="novigentes">
                <?php print_r($queryNoVigentes) ?>
                <?php foreach ($queryNoVigentes as $novigente) :
                    if ($novigente->vigency == 0) {
                ?>
                        <article class="mb-4" style="text-align: left; width: calc(100% / 2 - 12px); display: inline-block; margin-right: 4px;margin-left: 4px;">
                            <section class="h-100 border border-danger border-1 border-radius-pill text-bg-dark rounded-3">
                                <div class="bg-light p-3">
                                    <h5><?= substr(html_entity_decode($novigente->title), 0, 33) . '...' ?></h5>
                                    <h6>
                                        <font color="black"><em><?= substr(html_entity_decode($novigente->employer), 0, 33) . '...'  ?></em></font>
                                    </h6>
                                </div>
                                <div class="p-3">
                                    <ul style="list-style: none; padding: 0; margin: 0;">
                                        <li>
                                            <i class="fa fa-calendar" style="height: 20px; width: 20px; text-align: center;"></i><span>&nbsp;Finaliza el <?= date("d/m/Y", strtotime($novigente->date_vigency)); ?></span>
                                        </li>
                                        <li>
                                            <i class="fa fa-map-marker" style="height: 20px; width: 20px; text-align: center;"></i><span>&nbsp;<?= $novigente->ubicacion ?></span>
                                        </li>
                                    </ul>
                                    <!--<br>-->
                                    <p class="card-text"><?= substr(html_entity_decode($novigente->detail), 0, 100) . '...' ?></p>
                                    <p> <small class="text-muted">Sueldo:&nbsp;S/&nbsp;<?= $novigente->salary ?></small><br>
                                        <small><?= $novigente->career_title ?></small>
                                    </p>
                                    <!--<div class="float-end">-->
                                    <div class="text-center">
                                        <a class="bg-danger btn input-block-level form-control btn-outline-danger" href="/users/convocatoria/<?= $novigente->id; ?>"><strong>Ver convocatoria</strong></a>
                                    </div>
                            </section>
                        </article>
                <?php }
                endforeach; ?>
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