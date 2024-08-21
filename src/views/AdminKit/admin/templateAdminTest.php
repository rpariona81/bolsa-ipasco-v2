<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/assets/images/favicon.png') ?>">
    <!--<title>Material Pro Admin Template - The Most Complete & Trusted Bootstrap 4 Admin Template</title>-->
    <title><?= getenv('APP_NAME') ?></title>
    <link href="<?= base_url('public/assets/font-awesome/4.7.0/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('public/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('public/lite/css/spinners.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/lite/css/style.css') ?>" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?= base_url('public/lite/css/colors/golden.css') ?>" id="theme" rel="stylesheet">

    <link href="<?= base_url('public/assets/plugins/datatable/css/buttons.bootstrap4.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('public/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')?>"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')?>"></script>
    <![endif]-->

    <script src="<?= base_url('public/assets/tinymce/tinymce.min.js') ?>"></script>
    <script>
        /*tinymce.init({
        selector: '#detail'
      });*/
        tinymce
            .init({
                selector: 'textarea#detail',
                plugins: "textcolor, lists code",
                toolbar: " undo redo | bold italic | alignleft aligncenter alignright alignjustify \n\
		              | bullist numlist outdent indent | forecolor backcolor table code"
            });
    </script>

    <style>
        aside {
            display: flex;
            flex-direction: column;
            margin-left: 1px;
        }

        aside[data-visible="false"] {
            display: none !important;
            flex-direction: none;
        }
    </style>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light navbar-expand-md">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->

                            <!-- Light Logo icon -->
                            <img src="<?= base_url('public/assets/images/logo-mini.png') ?>" alt="homepage" class="light-logo" width="60" height="60" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span class="top-header-title">Bolsa laboral
                        </span> </a>
                    </b>
                    <!--End Logo icon -->

                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <!--<li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" id="sidebarToggle" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>-->
                        <li class="nav-item"> <a id="sidebarToggle" class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-item nav-link dropdown-toggle text-muted waves-effect waves-dark" id="navbarDropdownMenuLink" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <strong><?= $this->session->userdata('user_rol_title') . ' ' . $this->session->userdata('user_name') . ' ' . $this->session->userdata('user_paterno') ?>&nbsp;</strong><i class="fa fa-user fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/admin/claves">Cambiar clave</a>


                                <hr class="dropdown-divider" />
                                <!-- Boton salir-->
                                <form class="text-center ml-1" action="/logout">
                                    <input class="btn btn-primary" id="btnLogout" type="submit" value="Cerrar sesión"></input>
                                </form>
                        </li>
                    </ul>

                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-visible="true">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="/admin/" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Inicio</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/admin/estudiantes" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">Estudiantes/Egresados</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/admin/docentes" aria-expanded="false"><i class="mdi mdi-clipboard-account"></i><span class="hide-menu">Docentes</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/admin/convocatorias" aria-expanded="false"><i class="mdi mdi-clipboard-check"></i><span class="hide-menu">Convocatorias</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/admin/postulaciones" aria-expanded="false"><i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Postulaciones</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/admin/perfil" aria-expanded="false"><i class="mdi mdi-account-card-details"></i><span class="hide-menu">Perfil</span></a>
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <div class="col-6 mx-auto">
                    <div class="text-center">
                        <a class="pull-right btn btn-block" data-toggle="tooltip" data-placement="bottom" title="Cerrar sesión" href="/logout">Salir &nbsp;<i class="mdi mdi-power"></i></a>
                    </div>
                </div>
            </div>
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block;">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

                <?php $this->load->view($contenido); ?>

            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2017 Material Pro Admin by wrappixel.com
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->



    <!--<script src="< ?= base_url('public/assets/vendor/js/jquery-slim.min.js') ?>"></script>-->
    <!--<script src="< ?= base_url('public/assets/vendor/js/popper.min.js') ?>"></script>-->
    <!-- Bootstrap tether Core JavaScript -->

    <!--<script src="<?= base_url('public/assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/datatable/js/jquery-3.7.0.js') ?>"></script>-->

    <!--<script src="<?= base_url('public/assets/vendor/js/popper.min.js') ?>"></script>-->
    <script src="<?= base_url('public/assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/bootstrap/js/tether.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>


    <!--<script src="<?= base_url('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>-->

    <script src="<?= base_url('public/assets/plugins/datatable/js/jquery.datatables.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/datatable/js/datatables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/datatable/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/datatable/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/datatable/js/buttons.flash.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/datatable/js/jszip.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/datatable/js/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/datatable/js/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/datatable/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/datatable/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/datatable/js/buttons.colVis.min.js') ?>"></script>



    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url('public/lite/js/jquery.slimscroll.js') ?>"></script>
    <!--Wave Effects -->
    <script src="<?= base_url('public/lite/js/waves.js') ?>"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url('public/lite/js/sidebarmenuPro.js') ?>"></script>
    <!--<script src="<?= base_url('public/lite/js/sidebarmenu.js') ?>"></script>-->
    <!--stickey kit -->
    <script src="<?= base_url('public/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') ?>"></script>

    <!--Custom JavaScript -->
    <script src="<?= base_url('public/lite/js/custom.min.js') ?>"></script>

    <script>
        $(document).ready(function() {
            $("#sidebarToggle").on("click", function() {
                $('aside').toggle("slide", function() {
                    var visibilityStatus = $('aside').attr("data-visible") == true;
                    console.log(visibilityStatus);
                    $('aside').attr('data-visible', !visibilityStatus);
                });
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            //$.noConflict();
            $('#datatablesSimple').DataTable({
                pageLength: 7,
                order: [],
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
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
</body>

</html>