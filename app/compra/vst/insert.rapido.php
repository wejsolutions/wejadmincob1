<?php require '../../../cfg/base.php'; ?>
<form action="" class="op1-clien well">
	<div class="msj-pac"></div>
	<fieldset><legend>Datos Personales (Registro Rápido de Cliente)</legend>	
		<div class="form-group col-sm-4">
			<label for="" class="label control-label col-sm-12 bolder">Tipo:</label>
			<div class="col-sm-10" id="tipcli">
				<input type="text" name="tipcli" class="form-control">
			</div>
		</div>
		<div class="form-group col-sm-4">
			<label for="" class="label control-label col-sm-12 bolder">N° Identificación:</label>
			<div class="col-sm-12">
				<input type="text" name="ced" class="form-control">
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="form-group col-sm-6">
			<label for="" class="label control-label col-sm-12 bolder">Primer Nombre:</label>
			<div class="col-sm-12">
				<input type="text" name="nom1" class="form-control">
			</div>
		</div>

		<div class="form-group col-sm-6">
			<label for="" class="label control-label col-sm-12 bolder">Primer Apellido:</label>
			<div class="col-sm-12">
				<input type="text" name="ape1" class="form-control">
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="form-group col-sm-4">
			<label for="" class="label control-label col-sm-12 bolder">Teléfono Móvil:</label>
			<div class="col-sm-12">
				<input type="text" name="mov" class="form-control">
			</div>
		</div>
		<div class="clearfix"></div>
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
				$.post('prc-cpaciente-cinsertRapido',$(formulario).serialize(),function(data){
					if(!isNaN(data.trim())) {
						load('vst-agenda-calendario','medico=<?php echo $medico; ?>','#calendario');
						modal('vst-agenda-agendar','medico=<?php echo $medico ?>&inicio=<?php echo $inicio ?>&fin=<?php echo $fin ?>&paci_ide='+data.trim());
					} else {
						alerta('.msj-pac','danger',data.trim())
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>