<div class="align-items-md-stretch mt-5">
    <div class="card">
        <div class="card-header bg-light">
            <h4 class="card-title text-dark">Plantilla de CV</h4>
        </div>
        <?= my_validation_errors(validation_errors()); ?>
        <div class="card-body">
            <div class="col-12">
                <h5>Descarga Modelo de CV: &nbsp;<a class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Descargar CV" target="_blank" download="<?=getenv('CV_NAME')?>" href="<?= base_url('/uploads/document/'. getenv('CV_NAME')); ?>">
                        <i class="fa fa-file-word-o" title="ModeloCV.docx"></i></a></h5>
            </div>
            <hr>
            
            <div class="col-xs-12 col-md-12 col-lg-6">
            <?= form_open('admincontroller/uploadModeloCV', array('name' => 'upload_form', 'class' => 'row g-3 needs-validation', 'enctype' => 'multipart/form-data')); ?>
                <h5>Reemplazar Modelo de CV:</h5>
                <p>Cargue archivo WORD (máx. 4 MB) (*):</p>
                <input type="file" name="modelocv" id="modelocv" class='file form-control' data-browse-on-zone-click='true' required />
                <br />
                <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info" />
                <?= form_close() ?>
                <?php if ($this->session->flashdata('flashSuccess')) : ?>
                    <div class="d-grid gap-2 px-3">
                        <p class='mt-1 alert alert-success'> <?= $this->session->flashdata('flashSuccess') ?> </p>
                    </div>
                <?php endif ?>

                <?php if ($this->session->flashdata('flashError')) : ?>
                    <div class="d-grid gap-2 px-3">
                        <p class='mt-1 alert alert-danger'> <?= $this->session->flashdata('flashError') ?> </p>
                    </div>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>

<!--<script>
    $(document).ready(function() {
        $('#upload_form').on('submit', function(e) {
            e.preventDefault();
            if ($('#modelocv').val() == '') {
                console.log('test');
                alert("Please Select the File");
            } else {
                alert("Prueba hecha.");
                /*$.ajax({
                    
                    /*url: "< ?php echo base_url(); ?>admincontroller/uploadModeloCV",
                    //base_url() = http://localhost/tutorial/codeigniter  
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('#uploaded_cv').html(data);
                    }
                });*/
            }
        });
    });
</script>