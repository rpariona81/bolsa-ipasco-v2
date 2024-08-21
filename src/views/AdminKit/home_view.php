<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title><?= getenv('APP_NAME') ?></title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, material pro admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, material design, material dashboard bootstrap 5 dashboard template">
	<meta name="description" content="Material Pro is powerful and clean admin dashboard template">
	<meta name="robots" content="noindex,nofollow">
	<title><?= getenv('APP_NAME') ?></title>

	<link rel="stylesheet" href="<?= base_url(getenv('PUBLIC_THEME') . '/public/css/bootstrap.min.css') ?>" />
	<link rel="stylesheet" href="<?= base_url(getenv('PUBLIC_THEME') . '/dist/font-awesome/4.7.0/css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url(getenv('PUBLIC_THEME') . '/dist/datatables/datatables.min.css') ?>" />

	<link href="<?= base_url(getenv('PUBLIC_THEME') . '/dist/css/app.css') ?>" rel="stylesheet">
	<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->

	<script src="<?= base_url(getenv('PUBLIC_THEME') .'/public/js/jquery-3.7.0.min.js') ?>"></script>
	<script src="<?= base_url(getenv('PUBLIC_THEME') .'/public/js/bootstrap.bundle.min.js') ?>"></script>

</head>

<body>
	<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary text-white">
		<div class="container d-flex">
			<a class="navbar-brand" href="<?= base_url() ?>">
				<img class="img login-logo" src="<?= base_url(getenv('PUBLIC_THEME') .'/dist/img/avatars/10logo-oficial.png') ?>" height="130" />
				&nbsp;&nbsp;&nbsp;BOLSA LABORAL
			</a>
		</div>
	</nav>
	<div class="jumbotron text-center mb-5 pb-3">
		<div class="container">
			<h1 class="jumbotron-heading">Conoce nuestra Bolsa Laboral</h1>
			<p class="lead text-muted">Los estudiantes y egresados podrán acceder a las oportunidades de trabajo que presentan las empresas a nivel nacional y así lograr ubicarse en un puesto de acuerdo a su profesión.</p>
		</div>
	</div>

	<div class="container">
		<div class="row">

			<div class="col-xs-12 col-md-6 col-xl-4 mb-4 d-flex">
				<!--<div class="card card-background border-radius-xl card-background-after-none align-items-start mb-4">-->
				<div class="card flex-fill w-100 mb-4">
					<img class="card-img-top" src="<?= base_url(getenv('PUBLIC_THEME') .'/public/img/app/Especializacion_laboral.jpg') ?>" alt="Estudiantes/Egresados" width="200" height="260">
					<div class="card-body text-start p-3 w-100">
						<div class="row">
							<div class="col-12 text-center">
								<a class="btn btn-large btn-primary px-5 mx-auto" href="<?= base_url('/wp-login') ?>"><strong>Estudiantes y egresados</strong></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xs-12 col-md-6 col-xl-4 mb-4 d-flex">
				<!--<div class="card card-background border-radius-xl card-background-after-none align-items-start mb-4">-->
				<div class="card flex-fill w-100 mb-4">
					<img class="card-img-top" src="<?= base_url(getenv('PUBLIC_THEME') .'/public/img/app/estudiar-ingenieria-comercial.jpg') ?>" alt="Docentes" width="200" height="260">
					<div class="card-body text-start p-3 w-100">
						<div class="row">
							<div class="col-12 text-center">
								<a class="btn btn-large btn-info px-5 mx-auto" href="<?= base_url('/wp-login') ?>"><strong>Docentes</strong></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xs-12 col-md-6 col-xl-4 mb-4 d-flex">
				<!--<div class="card card-background border-radius-xl card-background-after-none align-items-start mb-4">-->
				<div class="card flex-fill w-100 mb-4">
					<img class="card-img-top" src="<?= base_url(getenv('PUBLIC_THEME') .'/public/img/app/systemadmin_2.jpg') ?>" alt="Administrador" width="200" height="260">
					<div class="card-body text-start p-3 w-100">
						<div class="row">
							<div class="col-12 text-center">
								<a class="btn btn-large btn-warning px-5 mx-auto" href="<?= base_url('/wp-admin') ?>"><strong>Administrador</strong></a>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>


	</div>

</body>

</html>
