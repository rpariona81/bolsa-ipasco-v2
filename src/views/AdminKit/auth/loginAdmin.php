<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= getenv('APP_NAME') ?></title>

    <link rel="stylesheet" href="<?= base_url('public/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('dist/font-awesome/4.7.0/css/font-awesome.min.css') ?>">

    <script src="<?= base_url('public/js/jquery-3.7.0.min.js') ?>"></script>
    <script src="<?= base_url('public/js/bootstrap.bundle.min.js') ?>"></script>

</head>

<body class="bg-info">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="container">
            <div class="login-logo text-center mt-5">
                <img class="img login-logo" src="<?= base_url('dist/img/avatars/10logo-oficial.png') ?>" height="250" width="220" />
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 col-xl-5 mb-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-4">
                        <!--<div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>-->
                        <div class="card-header text-center">
                            <h3>Bienvenido(a)</h3>
                            <p class="font-weight-light my-4 mt-0 mb-0">Ingresa tu usuario y contraseña para iniciar sesión</p>
                        </div>

                        <div class="card-body pt-3 pb-3">
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

                            <?php if ($this->session->flashdata('flashInfo')) : ?>
                                <div class="d-grid gap-2 px-3">
                                    <p class='mt-1 alert alert-info'> <?= $this->session->flashdata('flashInfo') ?> </p>
                                </div>
                            <?php endif ?>

                            <?php if ($this->session->flashdata('flashWarning')) : ?>
                                <div class="d-grid gap-2 px-3">
                                    <p class='mt-1 alert alert-warning'> <?= $this->session->flashdata('flashWarning') ?> </p>

                                <?php endif ?>

                                <?= form_open('authcontroller/loginAdmin') ?>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="username" name="username" type="text" placeholder="Usuario" value="<?= set_value('username') ?>" size="50" required />
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Contraseña" value="<?= set_value('password') ?>" size="50" required />
                                </div>
                                <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                    <a class="btn btn-warning" href="<?= base_url() ?>">Regresar</a>&nbsp;&nbsp;
                                    <input class="btn btn-primary" id="btnLogin" type="submit" value="Ingresar"></input>
                                </div>
                                <?= form_close() ?>
                                </div>
                                <!-- -------------------------------------------------------------- -->
                                <!-- Login box.scss -->
                                <!-- -------------------------------------------------------------- -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>