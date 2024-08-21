<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <title><?= getenv('APP_NAME') ?></title>
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/img/favicon.png') ?>">
    <link href="<?=base_url('public/img/apple-touch-icon.png')?>" rel="apple-touch-icon">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/img/app/logo_2023.png') ?>">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="<?= base_url('public/datatable/css/bootstrap.min.css') ?>" />

    <link rel="stylesheet" href="<?= base_url('public/datatable/css/dataTables.bootstrap5.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/datatable/css/buttons.bootstrap5.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/datatable/css/responsive.bootstrap5.min.css') ?>" />

    <link href="<?= base_url('public/css/styles.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('public/css/mystyle.css') ?>" rel="stylesheet" />
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>-->
    <link href="<?= base_url('public/font-awesome/4.7.0/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- -------------------------------------------------------------- -->
    <!-- All Required js -->
    <!-- -------------------------------------------------------------- -->
    <!-- JavaScript Libraries -->
    <script src="<?= base_url('public/datatable/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?= base_url('public/js/scripts.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/jquery-3.7.0.js') ?>"></script>
    
</head>

<body class="d-flex flex-column h-100">

    <header>

        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-fixed-top bg-kadence" role="navigation">
            <div class="container-fluid">
                <!--<div class="navbar-header">-->
                <a class="navbar-brand" href="<?=base_url('/users')?>">
                    <img class="img rounded-circle mb-10" src="<?= base_url('public/img/app/logo_2023.png') ?>" height="50" />
                    <!--<img src="<?= base_url('public/img/app/logo_2023.png') ?>" width="250" height="250" id="logo">-->
                    &nbsp;&nbsp<?= getenv('APP_NAME') ? getenv('APP_NAME') : 'Bolsa Laboral' ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--</div>-->
                <div class="navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?=base_url('/users')?>">
                                <i class="fa fa-area-chart"></i>
                                Convocatorias
                            </a>
                        </li>
                        <?php
                        if ($this->session->userdata('user_rol') == 'estudiante') {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" aria-current="page" href="'.base_url('/users/postulaciones').'">';
                            echo '   <i class="fa fa-id-badge"></i>';
                            echo '    Mis postulaciones';
                            echo '</a>';
                            echo '</li>';

                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="'.base_url('/users/perfil').'">';
                            echo '    <i class="fa fa-id-card-o"></i>';
                            echo '    Mi perfil</a>';
                            echo '</li>';

                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="'.base_url('/users/descarga_cv').'">';
                            echo '    <i class="fa fa-file-word-o"></i>';
                            echo '    Modelo CV</a>';
                            echo '</li>';
                        } else {
                        }
                        ?>

                    </ul>
                    <ul class="d-flex navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" id="navbarDropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <strong><?= $this->session->userdata('user_rol_title').' '.$this->session->userdata('user_name').' '.$this->session->userdata('user_paterno') ?></strong><i class="fa fa-user fa-fw"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="<?=base_url('/users/credenciales')?>">
                                        <font color="black">Cambiar clave</font>
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <!--<li><a class="dropdown-item" href="/logout">
                                        <font color="black">Cerrar sesión</font>
                                    </a></li>-->
                                <!-- Boton salir-->
                                <form class="text-center ml-2" action="<?=base_url('/logout')?>">
                                    <input class="btn btn-primary" id="btnLogout" type="submit" value="Cerrar sesión"></input>
                                </form>

                            </ul>
                        </li>
                    </ul>
                    <!--<form class="d-flex" action="/logout">
                        <input class="btn btn-small btn-warning" type="submit" value="Cerrar sesión de&nbsp;<?= strtoupper($this->session->userdata('user_rol_title')); ?>&nbsp;<?= strtoupper($this->session->userdata('user_login')); ?>">
                    </form>-->
                </div>
                <!--/.navbar-collapse -->
            </div>
        </nav>
    </header>
    </div>



    <!--==========================
    Datatables Section
  ============================-->
    <main id="content_app">
        <div class="container mb-5">
            <?php $this->load->view($pagina); ?>
        </div>



        <!--==========================
    Footer
  ============================-->

        <footer class="footer pt-3 mt-2 my-0">
            <div class="container px-4">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-2">
                        <div class="copyright text-center text-xs text-muted text-lg-start">
                            Copyright
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <?= getenv('APP_NAME') ?>
                        </div>
                    </div>
        </footer>
    </main>

    <!-- -------------------------------------------------------------- -->
    <!-- All Required js -->
    <!-- -------------------------------------------------------------- -->
    <!-- JavaScript Libraries -->
    <!--<script src="<?= base_url('public/datatable/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?= base_url('public/js/scripts.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/jquery-3.7.0.js') ?>"></script>-->
    <script src="<?= base_url('public/datatable/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/dataTables.bootstrap5.min.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/buttons.bootstrap5.min.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/responsive.bootstrap5.min.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/jszip.min.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('public/datatable/js/buttons.colVis.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            //$.noConflict();
            $('#datatablesSimple').DataTable({
                pageLength: 7,
                order: [],
                //responsive: true,
                scrollX: true,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
                    "paginate": {
                        "previous": "<<",
                        "next": ">>",
                        "first": "<",
                        "last": ">"
                    },
                },
                dom: 'Bfrtip',
                buttons: ['copy', 'pdf',
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            //Para ver los estilos de formato https://datatables.net/reference/button/excelHtml5
                            $('row c[r^="B"]', sheet).attr('s', '57');
                            //Para que la columna se muestre como texto https://datatables.net/forums/discussion/73814/export-to-excel-with-format-text-for-column-b-c-and-d
                            $('row c[r^="C"]', sheet).attr('s', '50');
                        }
                    }
                ]
            });
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url('public/assets/js/corporate-ui-dashboard.min.js?v=1.0.0') ?>"></script>

</body>

</html>