<div class="align-items-md-stretch mt-5">
    <div class="card">
    <div class="card-header bg-light">
            <h4 class="card-title text-dark">Nuevo docente</h4>
        </div>
        <?= my_validation_errors(validation_errors()); ?>
        <div class="card-body">
            <?= form_open('admincontroller/creaDocente', array('class' => 'row g-3 needs-validation')); ?>
            <div class="col-md-4">
                <label for="name" class="form-label">Tipo de Documento de identidad (*)</label>
                <!--<select class="form-select" id="document_type" name="document_type" aria-label="Default select example" required>
                    <option value="">Seleccione</option>
                    <option value="1">D.N.I.</option>
                    <option value="2">CARNET DE EXTRANJERÍA</option>
                    <option value="3">PASAPORTE</option>
                </select>-->
                <?=form_dropdown('document_type', $document_type, set_value('document_type'), 'class="form-select" id="document_type"'); ?>
            </div>
            <div class="col-md-4">
                <label for="name" class="form-label">Número de documento</label>
                <input type="text" class="form-control" id="document_number" name="document_number" minlength="8" maxlength="12" value="<?= set_value('document_number') ?>">
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4">
                <label for="career_id" class="form-label">Programa de estudios (*)</label>
                <!--<select class="form-select" id="career_id" name="career_id" aria-label="Default select example">
                    <option value="">Seleccione</option>
                    <option value="1">Arquitectura de Plataformas y Servicios de Tecnologías de la Información</option>
                    <option value="2">Enfermería Técnica</option>
                    <option value="3">Diseño de Modas</option>
                    <option value="4">Gastronomía</option>
                    <option value="5">Mecatrónica Automotriz</option>
                    <option value="6">Cosmetología</option>
                </select>-->
                <?=form_dropdown('career_id', $career, set_value('career_id'), 'class="form-select" id="career_id" required'); ?>
            </div>
            <div class="col-md-4">
                <label for="name" class="form-label">Nombres (*)</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name') ?>" onkeyup="this.value=this.value.toUpperCase()" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4">
                <label for="paternal_surname" class="form-label">Apellido paterno (*)</label>
                <input type="text" class="form-control" id="paternal_surname" name="paternal_surname" value="<?= set_value('paternal_surname') ?>" onkeyup="this.value=this.value.toUpperCase()" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4">
                <label for="maternal_surname" class="form-label">Apellido materno (*)</label>
                <input type="text" class="form-control" id="maternal_surname" name="maternal_surname" value="<?= set_value('maternal_surname') ?>" onkeyup="this.value=this.value.toUpperCase()" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-2">
                <label for="gender" class="form-label">Sexo (*)</label>
                <!--<select class="form-select" id="gender" name="gender" aria-label="Default select example" required>
                    <option selected>Seleccione</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                </select>-->
                <?=form_dropdown('gender', $gender, set_value('gender'), 'class="form-select" id="gender"'); ?>
            </div>
            <div class="col-md-2">
                <label for="birthdate" class="form-label">Fecha nacimiento (*)</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" min="1945-01-01" max="<?= $fechamax ?>" value="<?= set_value('birthdate') ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-2">
                <label for="username" class="form-label">Usuario (*)</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="inputGroupPrepend" value="<?= set_value('username') ?>" required>
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <label for="username" class="form-label">Contraseña (*)</label>
                <div class="input-group has-validation">
                    <!--<span class="input-group-text" id="inputGroupPrepend">@</span>-->                    
                    <input type="password" class="form-control" id="txtPassword" name="password" aria-describedby="inputGroupPrepend" value="" required>
                    <button id="show_password" class="btn btn-secondary mb-0" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <label for="mobile" class="form-label">Teléfono celular:</label>
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?= set_value('mobile') ?>">
                <div class="invalid-feedback">
                    Please provide a valid city.
                </div>
            </div>
            <div class="col-md-2">
                <label for="graduated" class="form-label">Condición actual (*)</label>
                <!--<select class="form-select" id="graduated" name="graduated" aria-label="Default select example" required>
                    <option value="">Seleccione</option>
                    <option value="Contratado">Contratado</option>
                    <option value="Nombrado">Nombrado</option>
                </select>-->
                <?=form_dropdown('graduated', $condDocente, set_value('graduated'), 'class="form-select" id="graduated"'); ?>
            </div>
            
            <div class="col-md-4">
                <label for="email" class="form-label">Correo electrónico (*)</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>">
                <div class="invalid-feedback">
                    Please provide a valid city.
                </div>
            </div>
            <div class="col-md-6">
                <label for="address" class="form-label">Dirección actual</label>
                <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address') ?>">
                <div class="invalid-feedback">
                    Please provide a valid city.
                </div>
            </div>
            <div class="col-12">
                <div class="float-end">
                    <a href="<?=base_url('/admin/docentes')?>" class="btn btn-danger" type="button">Cancelar</a>
                    <input class="btn btn-primary" type="submit" value="Crear docente"></input>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<!--https://www.baulphp.com/3-formas-para-mostrar-y-ocultar-contrasenas/-->
<script>
    function mostrarPassword(){
		var cambio = document.getElementById("txtPassword");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
</script>

<script>
        $(document).ready(function () {
            $("#document_number").keydown(function (e) {
                if (e.keyCode === 13 || e.keyCode === 193)
                    document.getElementById('document_number').focus();
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
            
            $("#mobile").keydown(function (e) {
                if (e.keyCode === 13 || e.keyCode === 193)
                    document.getElementById('mobile').focus();
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
            
            $("#name").keydown(function (e) {
                if (e.keyCode === 13 || e.keyCode === 193)
                    document.getElementById('name').focus();
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.keyCode >= 48 && e.keyCode <= 57) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
            
            $("#paternal_surname").keydown(function (e) {
                if (e.keyCode === 13 || e.keyCode === 193)
                    document.getElementById('paternal_surname').focus();
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.keyCode >= 48 && e.keyCode <= 57) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            $("#maternal_surname").keydown(function (e) {
                if (e.keyCode === 13 || e.keyCode === 193)
                    document.getElementById('maternal_surname').focus();
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.keyCode >= 48 && e.keyCode <= 57) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

        });
    </script>