
<script src="<?= base_url('assets/js_ex/jquery.twbsPagination.min.js') ?>"></script>
<style>
    /*css for pagination*/
.page {
  display: none;
}
.page-active {
  display: block;
}
/*end css for pagination*/


</style>
<h1 class="mt-5 mb-5">Convocatorias vigentes</h1>
<div class="row align-items-md-stretch">
    <?php foreach ($query as $item) : ?>
        <div class="page col-md-6 mb-4" id="page<?=$item->id?>">
            <div class="h-100 bg-light border border-1 border-radius-pill p-4 text-bg-dark rounded-3">
                <h3><?= $item->title ?></h3>
                <p><?= substr(html_entity_decode($item->detail), 0, 100) . '...' ?></p>
                <p><small class="text-muted">Fecha de publicación:&nbsp;<?= date("d/m/Y", strtotime($item->date_publish)); ?></small><br>
                    <small class="text-muted">Sueldo:&nbsp;S/&nbsp;<?= $item->salary ?></small><br>
                    <small><?= $item->career_title ?></small>
                </p>
                <div class="float-end">
                    <a class="btn btn-outline-success" href="<?=base_url('/users/convocatoria/'. $item->id); ?>"><strong>Ver más detalles</strong></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <nav aria-label="Page navigation example">
        <ul id="pagination-demo" class="pagination justify-content-center">
        </ul>
    </nav>

</div>


<script>
$('#pagination-demo').twbsPagination({
   totalPages: 5,
   startPage: 1,
   visiblePages: 5,
   initiateStartPageClick: true,
    hideOnlyOnePage: false,
    href: false,
    pageVariable: '{{page}}',
    totalPagesVariable: '{{total_pages}}',
    page: null,
    first: 'First',
    prev: 'Previous',
    next: 'Next',
    last: 'Last',
    loop: false,
    beforePageClick: null,
    onPageClick: function (event, page) {
    $('.page-active').removeClass('page-active');
    $('#page'+page).addClass('page-active');
  },
});
var $pagination = $('page');
    var defaultOpts = {
        totalPages:5
    };
    $pagination.twbsPagination(defaultOpts);
$.ajax({
        success: function (data) {
            var totalPages = data.newTotalPages;
            var currentPage = $pagination.twbsPagination('getCurrentPage');
            $pagination.twbsPagination('destroy');
            $pagination.twbsPagination($.extend({}, defaultOpts, {
                startPage: currentPage,
                totalPages: totalPages
            }));
        }
    });
</script>





 


