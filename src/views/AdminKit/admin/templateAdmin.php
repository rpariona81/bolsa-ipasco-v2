<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="<?= base_url('dist/img/icons/icon-48x48.png') ?>" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title><?= getenv('APP_NAME') ?></title>

    <link rel="stylesheet" href="<?= base_url('dist/datatables/datatables.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('dist/datatables/Buttons-2.4.1/css/buttons.bootstrap4.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('dist/datatables/ColReorder-1.7.0/css/colReorder.bootstrap4.min.css') ?>" />
    <!--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css" />-->

    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />-->

    <link href="<?= base_url('dist/css/app.css') ?>" rel="stylesheet">
    <link href="<?= base_url('dist/css/light.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="<?= base_url('dist/font-awesome/4.7.0/css/font-awesome.min.css') ?>" rel="stylesheet">

    <!-- <script src="<?= base_url('dist/js/settings.js') ?>"></script> -->
    <!--<script src="<?= base_url('dist/js/jquery-3.7.0.min.js') ?>"></script>-->



    <script src="<?= base_url('dist/tinymce/tinymce.min.js') ?>"></script>
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

<!--<body>-->

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">

    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="align-middle">Bolsa Laboral</span>
                </a>

                <ul class="sidebar-nav">
                    <div class="sidebar-user">
                        <div class="d-flex justify-content-right">
                            <div class="flex-shrink-0">
                                <!--<a class="nav-link" href="< ?= base_url('/admin') ?>">-->
                                <img class="img login-logo" src="<?= base_url('dist/img/avatars/10logo-oficial.png') ?>" height="150" width="150" />
                                <!--</a>-->
                            </div>

                            </li>
                        </div>
                    </div>
                    <li class="sidebar-header">
                        Menú principal
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url('/admin') ?>">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Tablero principal</span>
                        </a>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url('/admin/estudiantes') ?>">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Estudiantes</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url('/admin/docentes') ?>">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Docentes</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url('/admin/convocatorias') ?>">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Convocatorias</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url('/admin/postulaciones') ?>">
                            <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Postulaciones</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Ajustes
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url('/admin/perfil') ?>">
                            <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Mi perfil</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url('/admin/programas') ?>">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Programas</span>
                        </a>
                    </li>

                    <!--<li class="sidebar-item">
                        <a class="sidebar-link" href=" < ?= base_url('/admin/vermodelocv') ?>">
                            <i class="align-middle" data-feather="file"></i> <span class="align-middle">Modelo CV</span>
                        </a>
                    </li>-->

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url('/logout') ?>">
                            <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Cerrar sesión</span>
                        </a>
                    </li>
                </ul>

            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">

                        <li class="nav-item dropdown">
                            <!--<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                            <a class="nav-icon pe-md-0 dropdown-toggle show" href="#" data-bs-toggle="dropdown" aria-expanded="true">-->
                            <!--<i class="align-middle" data-feather="user"></i>-->
                            <!--</a>-->
                            <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="align-top" data-feather="user"></i>
                                <span class="text-dark"><?= $this->session->userdata('user_rol_title') ?></span>
                            </a>

                            <!--<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">-->
                            <!--<a class="nav-icon pe-md-0 dropdown-toggle show" href="#" data-bs-toggle="dropdown">-->
                            <!--<i class="align-top" data-feather="user"></i>-->
                            <!-- ?= $this->session->userdata('user_rol_title') ?-->

                            <!--</a>-->
                            <!--<div class="dropdown-menu dropdown-menu-end">-->
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="loginDropdown">
                                <a class="dropdown-item" href="<?= base_url('/admin/perfil') ?>"><i class="align-middle me-1" data-feather="settings"></i>&nbsp;Mi Perfil</a>
                                <a class="dropdown-item" href="<?= base_url('/admin/claves') ?>"><i class="align-middle me-1" data-feather="link"></i>&nbsp;Cambiar contraseña</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('/logout') ?>"><i class="align-middle me-1" data-feather="log-out"></i>&nbsp;Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <?php $this->load->view($contenido); ?>

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://www.idexpasco.edu.pe/" target="_blank"><strong>IDEX PASCO</strong></a> - <strong>Empleabilidad</strong> &copy <?= date('Y') ?>
                            </p>
                        </div>

                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
    <!--<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        -->
    <!-- <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script> -->
    <!--<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>-->

    <script src="<?= base_url('dist/js/app.js') ?>"></script>
    <!--<script src="< ?= base_url('dist/datatables/datatables.min.js') ?>"></script>-->
    <script src="<?= base_url('dist/js/datatables.js') ?>"></script>

    <script src="<?= base_url('dist/datatables/pdfmake-0.2.7/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('dist/datatables/pdfmake-0.2.7/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('dist/datatables/JSZip-3.10.1/jszip.min.js') ?>"></script>
    <script src="<?= base_url('dist/datatables/Buttons-2.4.1/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('dist/datatables/Buttons-2.4.1/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('dist/datatables/ColReorder-1.7.0/js/colReorder.bootstrap4.min.js') ?>"></script>

    <script>
        //document.addEventListener("DOMContentLoaded", function() {
        // Datatables Responsive
        // https://datatables.net/reference/button/excelHtml5

        //https://www.youtube.com/watch?v=j59H9xnyCBs
        $(document).ready(function() {
            $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-md btn-primary border-0';
            var mytable = $("#datatablesSimple").DataTable({
                responsive: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                order: [],
                stateSave: true,
                language: {
                    url: '<?= base_url('dist/datatables/i18n/es-ES.json') ?>',
                }
            });

            new $.fn.dataTable.Buttons(mytable, {
                buttons: [
                    'copy',
                    {
                        extend: 'print',
                        exportOptions: {
                            orientation: 'landscape'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape'
                    },
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

            mytable.buttons().container().appendTo($('tr th.heading', mytable.table().container()));
            /*document.addEventListener("DOMContentLoaded", function() {

                var datatablesButtons = $("#datatablesSimple").DataTable({
                    responsive: true,
                    lengthChange: !1,
                    buttons: ["copy", "print"]
                });
                datatablesButtons.buttons().container().appendTo("#datatablesSimple-buttons_wrapper .col-md-6:eq(0)");
                */
        });
    </script>

</body>

</html>