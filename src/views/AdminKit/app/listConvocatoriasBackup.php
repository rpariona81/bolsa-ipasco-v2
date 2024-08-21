
<h1 class="mt-5 mb-5">Convocatorias vigentes</h1>

<div class="row align-items-md-stretch">
    <?php foreach ($query as $item) : ?>
        <div class="col-md-6 mb-4">
            <div class="h-100 bg-light border border-1 border-radius-pill p-4 text-bg-dark rounded-3">
                <h3><?= $item->title ?></h3>
                <h5><font color="red" ><em><?= $item->employer ?></em></font></h5>
                <p><?= substr(html_entity_decode($item->detail), 0, 100) . '...' ?></p>
                <p><small class="text-muted">Fecha de publicación:&nbsp;<?= date("d/m/Y", strtotime($item->date_publish)); ?></small><br>
                <small class="text-muted">Sueldo:&nbsp;S/&nbsp;<?= $item->salary ?></small><br>
                <small><?= $item->career_title ?></small></p>
                <!--<div class="float-end">-->
                <div class="">
                    <a class="btn btn-outline-success" href="/users/convocatoria/<?= $item->id; ?>"><strong>Ver más detalles</strong></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

