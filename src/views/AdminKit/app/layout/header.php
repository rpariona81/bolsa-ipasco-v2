<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ricardo Ramos Plata">
    <meta name="generator" content="BolsaLaboral_1.0">
    <title><?= getenv('APP_NAME') ?></title>

    <link rel="icon" href="<?= base_url('assets/img/cropped-ricardo3-1-32x32.png') ?>">
    <link href="<?= base_url('assets/font-awesome/4.7.0/css/font-awesome.min.css') ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?= base_url('assets/css_ex/styles.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css_ex/mystyle.css') ?>">
    <!--<link rel="stylesheet" href="< ?= base_url('assets/css_ex/custom.css') ?>">-->
    <link rel="stylesheet" href="<?= base_url('assets/css_ex/sticky-footer-navbar.css') ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    </link>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    </link>

    <!--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
    <!--<script src="< ?= base_url('assets/js/bootstrap.min.js') ?>"></script>-->
    <script src="<?= base_url('assets/js/jquery-3.5.1.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js_ex/scripts.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>







</head>

<body class="d-flex flex-column h-100">

    <header>

        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-fixed-top bg-kadence" role="navigation">
            <div class="container-fluid">
                <!--<div class="navbar-header">-->
                <a class="navbar-brand" href="/users">
                    <img class="img rounded-circle mb-10" src="<?= base_url('assets/img/logoFondoBlack.png') ?>" height="50" />
                    &nbsp;&nbspBOLSA LABORAL RRP
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--</div>-->
                <div class="navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/users">
                                <i class="fa fa-area-chart"></i>
                                Convocatorias
                            </a>
                        </li>
                        <?php
                        if ($this->session->userdata('user_rol') == 'estudiante') {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" aria-current="page" href="/users/postulaciones">';
                            echo '   <i class="fa fa-id-badge"></i>';
                            echo '    Mis postulaciones';
                            echo '</a>';
                            echo '</li>';

                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="/users/perfil">';
                            echo '    <i class="fa fa-id-card-o"></i>';
                            echo '    Mi perfil</a>';
                            echo '</li>';

                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="/users/descarga_cv">';
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
                                <li><a class="dropdown-item" href="/users/credenciales">
                                        <font color="black">Cambiar clave</font>
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <!--<li><a class="dropdown-item" href="/logout">
                                        <font color="black">Cerrar sesión</font>
                                    </a></li>-->
                                <!-- Boton salir-->
                                <form class="text-center ml-2" action="/logout">
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