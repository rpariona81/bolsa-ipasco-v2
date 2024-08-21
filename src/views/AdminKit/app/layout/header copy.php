<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ricardo Ramos Plata">
    <meta name="generator" content="BolsaLaboral_1.0">
    <title>BolsaLaboral RRP</title>

    
    <link href="<?= base_url('assets/font-awesome/4.7.0/css/font-awesome.min.css') ?>" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?= base_url('assets/css_ex/styles.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css_ex/mystyle.css') ?>">
    <!--<link rel="stylesheet" href="<?= base_url('assets/css_ex/custom.css') ?>">-->
    <link rel="stylesheet" href="<?= base_url('assets/css_ex/sticky-footer-navbar.css') ?>">
    
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
    <script src="<?= base_url('assets/js/jquery-3.5.1.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>

</head>

<body class="d-flex flex-column h-100">

    <header>

        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-kadence">
            <div class="container-fluid">
                <a class="navbar-brand" href="/users">
                    <img class="img rounded-circle mb-10" src="<?= base_url('assets/img/logoFondoBlack.png') ?>" height="80" />
                    &nbsp;&nbspBOLSA LABORAL RRP
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse align-items-center" id="navbarCollapse">
                    
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
                        } else {
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/users/credenciales">
                                <i class="fa fa-key"></i>
                                Cambiar clave
                            </a>
                        </li>
                    </ul>
                    <form class="d-flex" action="/logout">
                        <input class="btn btn-small btn-warning" type="submit" value="Cerrar sesión de&nbsp;<?= strtoupper($this->session->userdata('user_rol')); ?>&nbsp;<?= strtoupper($this->session->userdata('user_login')); ?>">
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <br>