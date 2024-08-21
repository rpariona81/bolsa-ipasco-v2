<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, material pro admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, material design, material dashboard bootstrap 5 dashboard template" />
    <meta name="description" content="Material Pro is powerful and clean admin dashboard template" />
    <meta name="robots" content="noindex,nofollow" />
    <title><?= getenv('APP_NAME') ?></title>
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

    <script src="<?= base_url('public/tinymce/tinymce.min.js') ?>"></script>
    <script>
        tinymce
            .init({
                selector: 'textarea#detail',
                plugins: "textcolor, lists code",
                toolbar: " undo redo | bold italic | alignleft aligncenter alignright alignjustify \n\
		              | bullist numlist outdent indent | forecolor backcolor table code"
            });
    </script>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-warning">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 text-dark" href="<?=base_url('/admin')?>"><strong><?= getenv('APP_NAME') ?></strong></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-dark" id="sidebarToggle" href="#!"><i class="fa fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <!--<div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fa fa-search"></i></button>
            </div>-->
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong><?= $this->session->userdata('user_rol_title') ?></strong>&nbsp;<i class="fa fa-user fa-fw"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?=base_url('/admin/perfil')?>"><i class="fa fa-user-secret"></i>
                            Mi perfil</a></li>
                    <li><a class="dropdown-item" href="<?=base_url('/admin/claves')?>"><i class="fa fa-key" aria-hidden="true"></i>
                            Cambio de clave</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?=base_url('/logout')?>"><i class="fa fa-sign-out" aria-hidden="true"></i>
                            Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light bg-kadence" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!--<div class="sb-sidenav-menu-heading mx-3"><strong>Bolsa laboral</strong></div>-->
                        <!--<a class="nav-link" href="/admin">
                            <div class="sb-nav-link-icon"><i class="fa fa-tachometer"></i></div>
                            Panel de control
                        </a>-->
                        <a class="nav-link" href="<?=base_url('/admin')?>">
                            <img class="img login-logo rounded-circle" src="<?= base_url('public/img/app/logo_2023.png') ?>" height="150" width="150"/>
                        </a>
                        <a class="nav-link" href="<?=base_url('/admin/estudiantes')?>" aria-expanded="false">
                            <div class="sb-nav-link-icon"><i class="fa fa-address-book"></i></div>Estudiantes
                        </a>
                        <a class="nav-link" href="<?=base_url('/admin/docentes')?>" aria-expanded="false">
                            <div class="sb-nav-link-icon"><i class="fa fa-book"></i></div>Docentes
                        </a>
                        <a class="nav-link" href="<?=base_url('/admin/convocatorias')?>" aria-expanded="false">
                            <div class="sb-nav-link-icon"><i class="fa fa-area-chart"></i></div>Convocatorias
                        </a>
                        <a class="nav-link" href="<?=base_url('/admin/postulaciones')?>" aria-expanded="false">
                            <div class="sb-nav-link-icon"><i class="fa fa-list-ul"></i></div>Postulaciones
                        </a>
                        <hr>
                        <a class="nav-link" href="<?=base_url('/admin/perfil')?>" aria-expanded="false">
                            <div class="sb-nav-link-icon"><i class="fa fa-user-secret"></i></div>Mi perfil
                        </a>
                        <a class="nav-link" href="<?=base_url('/admin/programas')?>" aria-expanded="false">
                            <div class="sb-nav-link-icon"><i class="fa fa-gear"></i></div>Programas
                        </a>
                        <a class="nav-link" href="<?=base_url('/admin/vermodelocv')?>" aria-expanded="false">
                            <div class="sb-nav-link-icon"><i class="fa fa-file-word-o"></i></div>Modelo CV
                        </a>
                        <a class="nav-link" href="<?=base_url('/logout')?>" aria-expanded="false">
                            <div class="sb-nav-link-icon"><i class="fa fa-sign-out" aria-hidden="true"></i></div>Cerrar sesión
                        </a>

                    </div>
                </div>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->


        <!-- -------------------------------------------------------------- -->
        <!-- End Topbar header -->
        <!-- -------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------- -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- -------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------- -->
        <!-- Page wrapper  -->
        <!-- -------------------------------------------------------------- -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">
                    <?php $this->load->view($contenido); ?>
                </div>
            </main>
            <!-- -------------------------------------------------------------- -->
            <!-- End PAge Content -->
            <!-- -------------------------------------------------------------- -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        Copyright
                        © <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <?= getenv('APP_NAME') ?>
                    </div>
                </div>
            </footer>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End Page wrapper  -->
        <!-- -------------------------------------------------------------- -->
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- End Wrapper -->
    <!-- -------------------------------------------------------------- -->
    <!-- -------------------------------------------------------------- -->

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
            $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-outline-primary';
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
    <!--<script src="<?= base_url('public/assets/js/corporate-ui-dashboard.min.js?v=1.0.0') ?>"></script>-->
</body>

</html>