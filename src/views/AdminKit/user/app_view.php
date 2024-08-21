<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= getenv('APP_NAME') ?></title>

	<link rel="stylesheet" href="<?= base_url(getenv('PUBLIC_THEME') . '/public/css/bootstrap.min.css') ?>" />
	<link rel="stylesheet" href="<?= base_url(getenv('PUBLIC_THEME') . '/dist/font-awesome/4.7.0/css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url(getenv('PUBLIC_THEME') . '/dist/datatables/datatables.min.css') ?>" />

	<link href="<?= base_url(getenv('PUBLIC_THEME') . '/dist/css/app.css') ?>" rel="stylesheet">
	<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->

	<script src="<?= base_url(getenv('PUBLIC_THEME') . '/public/js/jquery-3.7.0.min.js') ?>"></script>
	<script src="<?= base_url(getenv('PUBLIC_THEME') . '/public/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url(getenv('PUBLIC_THEME') . '/public/js/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?= base_url(getenv('PUBLIC_THEME') . '/public/js/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?= base_url(getenv('PUBLIC_THEME') . '/dist/datatables/datatables.min.js') ?>"></script>

	<script src="<?= base_url(getenv('PUBLIC_THEME') . '/dist/datatables/pdfmake-0.2.7/pdfmake.min.js') ?>"></script>
	<script src="<?= base_url(getenv('PUBLIC_THEME') . '/dist/datatables/pdfmake-0.2.7/vfs_fonts.js') ?>"></script>
	<script src="<?= base_url(getenv('PUBLIC_THEME') . '/dist/datatables/JSZip-3.10.1/jszip.min.js') ?>"></script>
	<script src="<?= base_url(getenv('PUBLIC_THEME') . '/dist/datatables/Buttons-2.4.1/js/buttons.bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url(getenv('PUBLIC_THEME') . '/dist/datatables/Buttons-2.4.1/js/dataTables.buttons.min.js') ?>"></script>
	<script src="<?= base_url(getenv('PUBLIC_THEME') . '/dist/datatables/ColReorder-1.7.0/js/colReorder.bootstrap4.min.js') ?>"></script>
	<style>
		body {
			background: #eeeeee;
			font-family: 'Varela Round', sans-serif;
		}

		.navbar {
			color: #fff;
			/*background: #36385a !important;*/
			padding: 5px 16px;
			border-radius: 0;
			border: none;
			box-shadow: 0 0 4px rgba(0, 0, 0, .1);
		}

		/*.navbar img {
            border-radius: 50%;
            width: 36px;
            height: 36px;
            margin-right: 10px;
        }*/

		/*.navbar .navbar-brand {
            color: #efe5ff;
            padding-left: 0;
            padding-right: 50px;
            font-size: 24px;
        }

        .navbar .navbar-brand:hover,
        .navbar .navbar-brand:focus {
            color: #fff;
        }

        .navbar .navbar-brand i {
            font-size: 25px;
            margin-right: 5px;
        }*/

		.search-box {
			position: relative;
		}

		.search-box input {
			padding-right: 35px;
			min-height: 38px;
			border: none;
			background: #faf7fd;
			border-radius: 3px !important;
		}

		.search-box input:focus {
			background: #fff;
			box-shadow: none;
		}

		.search-box .input-group-addon {
			min-width: 35px;
			border: none;
			background: transparent;
			position: absolute;
			right: 0;
			z-index: 9;
			padding: 10px 7px;
			height: 100%;
		}

		.search-box i {
			color: #a0a5b1;
			font-size: 19px;
		}

		.navbar .nav-item i {
			font-size: 18px;
		}

		.navbar .nav-item span {
			position: relative;
			top: 3px;
		}

		.navbar .navbar-nav>a {
			color: #efe5ff;
			padding: 8px 15px;
			font-size: 14px;
		}

		.navbar .navbar-nav>a:hover,
		.navbar .navbar-nav>a:focus {
			color: #fff;
			text-shadow: 0 0 4px rgba(255, 255, 255, 0.3);
		}

		.navbar .navbar-nav>a>i {
			display: block;
			text-align: center;
		}

		.navbar .dropdown-item i {
			font-size: 16px;
			min-width: 22px;
		}

		.navbar .dropdown-item .material-icons {
			font-size: 21px;
			line-height: 16px;
			vertical-align: middle;
			margin-top: -2px;
		}

		.navbar .nav-item.open>a,
		.navbar .nav-item.open>a:hover,
		.navbar .nav-item.open>a:focus {
			color: #fff;
			background: none !important;
		}

		.navbar .dropdown-menu {
			border-radius: 1px;
			border-color: #e5e5e5;
			box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
		}

		.navbar .dropdown-menu a {
			color: #777 !important;
			padding: 8px 20px;
			line-height: normal;
			font-size: 15px;
		}

		.navbar .dropdown-menu a:hover,
		.navbar .dropdown-menu a:focus {
			color: #333 !important;
			background: transparent !important;
		}

		.navbar .navbar-nav .active a,
		.navbar .navbar-nav .active a:hover,
		.navbar .navbar-nav .active a:focus {
			color: #fff;
			text-shadow: 0 0 4px rgba(255, 255, 255, 0.2);
			background: transparent !important;
		}

		.navbar .navbar-nav .user-action {
			padding: 9px 15px;
			font-size: 15px;
		}

		.navbar .navbar-toggle {
			border-color: #fff;
		}

		.navbar .navbar-toggle .icon-bar {
			background: #fff;
		}

		.navbar .navbar-toggle:focus,
		.navbar .navbar-toggle:hover {
			background: transparent;
		}

		.navbar .navbar-nav .open .dropdown-menu {
			background: #faf7fd;
			border-radius: 1px;
			border-color: #faf7fd;
			box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
		}

		.navbar .divider {
			background-color: #e9ecef !important;
		}

		@media (min-width: 1200px) {
			.form-inline .input-group {
				width: 350px;
				margin-left: 30px;
			}
		}

		@media (max-width: 1199px) {
			.navbar .navbar-nav>a>i {
				display: inline-block;
				text-align: left;
				min-width: 30px;
				position: relative;
				top: 4px;
			}

			.navbar .navbar-collapse {
				border: none;
				box-shadow: none;
				padding: 0;
			}

			.navbar .navbar-form {
				border: none;
				display: block;
				margin: 10px 0;
				padding: 0;
			}

			.navbar .navbar-nav {
				margin: 8px 0;
			}

			.navbar .navbar-toggle {
				margin-right: 0;
			}

			.input-group {
				width: 100%;
			}
		}

		.footer {
			position: fixed;
			left: 0;
			bottom: 0;
			width: 100%;
			color: white;
			text-align: center;
		}
	</style>
</head>

<body class="d-flex flex-column min-vh-100">
	<!--    <nav class="navbar navbar-expand-xl navbar-dark bg-primary">-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top shadow-5-strong">

		<div class="container d-flex">
			<a href="<?= base_url('/users/') ?>" class="navbar-brand">
				<img class="img" src="<?= base_url(getenv('PUBLIC_THEME') . '/dist/img/avatars/IESTPPasco.png') ?>" height="40" />
				<!--< ?= getenv('APP_NAME') ? getenv('APP_NAME') : 'Bolsa Laboral' ?>-->
			</a>
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>-->

			<!-- Collection of nav links, forms, and other content for toggling -->
			<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
				<div class="navbar-nav ml-auto mx-auto">
					<a href="<?= base_url('/users/convocatorias') ?>" class="nav-item nav-link active"><i class="fa fa-home"></i><strong>Convocatorias</strong></a>
					<?php
					if ($this->session->userdata('user_rol') == 'estudiante') {
						echo '<a class="nav-item nav-link active" href="' . base_url('/users/postulaciones') . '">';
						echo '   <i class="fa fa-check-square"></i>';
						echo '    <strong>Mis postulaciones</strong>';
						echo '</a>';

						echo '<a class="nav-item nav-link active" href="' . base_url('/users/perfil') . '">';
						echo '    <i class="fa fa-id-badge"></i>';
						echo '    <strong>Mi perfil</strong></a>';

						echo '<a class="nav-item nav-link active" href="' . base_url('/users/descarga_cv') . '">';
						echo '    <i class="fa fa-file"></i>';
						echo '    <strong>Modelo CV</strong></a>';
					} else {
					}
					?>
				</div>

				<div class="nav-item dropdown">
					<a href="#" data-toggle="dropdown" id="navbarDropdown" role="button" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action text-white">
						<i class="fa fa-user fa-fw align-top"></i>
						<?= $this->session->userdata('user_rol_title') . ' ' . $this->session->userdata('user_name') . ' ' . $this->session->userdata('user_paterno') ?>
					</a>
					<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
						<a href="<?= base_url('/users/credenciales') ?>" class="dropdown-item"><i class="fa fa-key"></i> Cambiar clave</a>
						<div class="divider dropdown-divider"></div>
						<a href="<?= base_url('/logout') ?>" class="dropdown-item"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
					</div>
				</div>
				<!--<ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>-->
			</div>
		</div>
		</div>
	</nav>
	<!--==========================
    Datatables Section
  ============================-->
	<br />
	<main id="content_app">
		<div class="container" style="margin-bottom: 100px;">
			<?php $this->load->view($pagina); ?>
		</div>
	</main>


	<!--==========================
    Footer
  ============================-->

	<footer class="footer">
		<div class="container">
			<div class="row text-muted">
				<div class="col-6 text-start">
					<p class="mb-0">
						<a class="text-muted" href="https://www.idexpasco.edu.pe/" target="_blank"><strong>IDEX PASCO</strong></a> - <strong>Empleabilidad</strong> &copy <?= date('Y') ?>
					</p>
				</div>

			</div>
		</div>
	</footer>

	<script>
		$(document).ready(function() {
			$.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-md btn-danger border-0';
			$('#datatablesSimple').DataTable({
				pageLength: 7,
				order: [],
				responsive: true,
				scrollX: true,
				language: {
					url: '<?= base_url(getenv('PUBLIC_THEME') . '/dist/datatables/i18n/es-ES.json') ?>',
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

</body>

</html>
