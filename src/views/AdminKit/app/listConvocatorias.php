<h1 class="mt-5 mb-5">Convocatorias vigentes</h1>

<div class="row align-items-md-stretch">
    <?php foreach ($query as $item) : ?>
        <article class="col-md-6 mb-4">
            <section class="h-100 bg-light border border-1 border-radius-pill p-4 text-bg-dark rounded-3">
                <h3><?= $item->title ?></h3>
                <h5>
                    <font color="red"><em><?= $item->employer ?></em></font>
                </h5>
                <hr>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li>
                        <i class="fa fa-calendar" style="height: 20px; width: 20px; text-align: center;"></i><span>&nbsp;Finaliza el <?= date("d/m/Y", strtotime($item->date_vigency)); ?></span>
                    </li>
                    <li>
                        <i class="fa fa-map-marker" style="height: 20px; width: 20px; text-align: center;"></i><span>&nbsp;<?=$item->ubicacion?></span>
                    </li>
                </ul>
                <br>
                <p><?= substr(html_entity_decode($item->detail), 0, 100) . '...' ?></p>
                <p> <small class="text-muted">Sueldo:&nbsp;S/&nbsp;<?= $item->salary ?></small><br>
                    <small><?= $item->career_title ?></small>
                </p>
                <!--<div class="float-end">-->
                <div class="">
                    <a class="btn btn-outline-success" href="/users/convocatoria/<?= $item->id; ?>"><strong>Ver convocatoria</strong></a>
                </div>
            </section>
        </article>
    <?php endforeach; ?>
</div>