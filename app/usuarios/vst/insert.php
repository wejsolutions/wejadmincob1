<?php require '../../../cfg/base.php'; ?>
<form action="" class="op1-clien well">
	<div class="msj-clien"></div>
	<fieldset><legend>Datos Personales (Registro de Usuario)</legend>	
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Tipo:</label>
			<div class="col-sm-10" id="tipcli">
				<select class="form-control chosen" name="tipcli" id="tipcli">
					<option value=""></option>
					<?php foreach($mtipclien->lista() as $p): ?>
						<option value="<?php echo $p->tipcli_ide ?>"><?php echo $p->tipcli_descrip ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">N° Identificación:</label>
			<div class="col-sm-12">
				<input type="text" name="ced" class="form-control">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Fecha de Nacimiento:</label>
			<div class="col-sm-12">
				<input type="text" name="fnac" class="form-control fecha">
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Primer Nombre:</label>
			<div class="col-sm-12">
				<input type="text" name="nom1" class="form-control">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Segundo Nombre:</label>
			<div class="col-sm-12">
				<input type="text" name="nom2" class="form-control">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Primer Apellido:</label>
			<div class="col-sm-12">
				<input type="text" name="ape1" class="form-control">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Segundo Apellido:</label>
			<div class="col-sm-12">
				<input type="text" name="ape2" class="form-control">
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Dirección:</label>
			<div class="col-sm-12">
				<input type="text" name="dir" class="form-control">
			</div>
		</div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Teléfono Móvil:</label>
			<div class="col-sm-12">
				<input type="text" name="mov" class="form-control">
			</div>
		</div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Tipo:</label>
			<div class="col-sm-12">
				<select name="tipo" id="tipo" class="form-control chosen" title="Nivel">
					<?php foreach($mtipousua->lista() as $r): ?>
						<option value="<?php echo $r->tius_ide ?>"><?php echo $r->tius_descrip ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Aplica para la tienda:</label>
			<div class="col-sm-12" id="tienda">
				<select class="form-control chosen" title="Tienda" name="tie" id="tie">
					<?php foreach($mtienda->lista() as $t): ?>
						<option value="<?php echo $t->empresa_ide; ?>"><?php echo $t->empresa_nombre; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Correo Electrónico:</label>
			<div class="col-sm-12">
				<input type="text" name="corre" class="form-control">
			</div>
		</div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Login:</label>
			<div class="col-sm-12">
				<input type="text" name="login" class="form-control">
			</div>
		</div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Clave:</label>
			<div class="col-sm-12">
				<input type="password" name="clave" id="clave" class="form-control">
			</div>
		</div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Confirme Clave:</label>
			<div class="col-sm-12">
				<input type="password" name="clave2" class="form-control">
			</div>
		</div>

		<div class="clearfix"></div>
		<div class="form-actions">
			<button class="btn btn-primary btn-sm pull-right"><span class="i fa fa-check"></span> Guardar Cambios</button>
		</div>
	</fieldset>
</form>

<script>
	$(function(){
		$('.chosen').chosen();
		$('.fecha').datepicker({format:'dd-mm-yyyy',endDate:'-18y'});
	})
</script>

<script>
	$(function(){
		var formulario = '.op1-clien';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				tipcli: {
					required: true,
				},
				nom1: {
					required: true,
				},
				ape1: {
					required: true,
				},
				dir: {
					required: true,
				},
				mov: {
					required: true,
					number: true,
				},
				fnac: {
					required: true,
				},
				corre: {
					email: true,
				},
				login: {
					required: true,
				},
				clave: {
					required: true,
				},
				clave2: {
					required: true,
					equalTo: '#clave',
				}
			},

			messages: {
				tipcli: {
					required: 'Obligatorio',
				},
				nom1: {
					required: 'Obligatorio',
				},
				ape1: {
					required: 'Obligatorio',
				},
				dir: {
					required: 'Obligatorio',
				},
				mov: {
					required: 'Obligatorio',
					number: 'Numérico',
				},
				fnac: {
					required: 'Obligatorio',
				},
				corre: {
					email: 'Correo no válido',
				},
				login: {
					required: 'Obligatorio',
				},
				clave: {
					required: 'Obligatorio',
				},
				clave2: {
					required: 'Obligatorio',
					equalTo: 'Las claves no coinciden',
				}
			},

			invalidHandler: function (event, validator) { //display error alert on form submit   
				$('.alert-danger', $(formulario)).show();
			},

			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},

			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},

			submitHandler: function (form) {
				$.post('prc-musuarios-insert',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						alert('Cambios guardados correctamente');
						load('vst-usuarios-admin','clien_ide='+data,'.lista');
					} else {
						alerta('.msj-pac','danger',data)
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>