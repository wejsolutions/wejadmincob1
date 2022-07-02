<?php require '../../../cfg/base.php'; ?>
<form action="" class="op1 form-horizontal">
	<?php echo $fn->modalHeader('Agregar Cuenta a la Empresa');
	echo $fn->modalWidth('80%'); ?>
	<div class="modal-body">
		<div class="msj"></div>
		<div class="form-group">
			<label for="" class="control-label col-sm-2 bolder">Empresa:</label>
			<div class="col-sm-10">
				<select class="form-control chosen" name="emp" id="emp">
					<option value=""></option>
					<?php foreach($mtienda->lista() as $t): ?>
						<option value="<?php echo "$t->empresa_ide"; ?>"><?php echo "$t->empresa_rif | $t->empresa_nombre" ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-2 bolder">Banco:</label>
			<div class="col-sm-4">
				<select class="form-control chosen" name="ban" id="ban">
					<option value=""></option>
					<?php foreach($mbanco->lista() as $b): ?>
						<option value="<?php echo "$b->banco_ide"; ?>"><?php echo "$b->banco_descrip" ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<label for="" class="control-label col-sm-2 bolder">Cuenta:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="cue">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-2 bolder">Código:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="cod">
			</div>
			<label for="" class="control-label col-sm-2 bolder">Titular:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="tit">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-2 bolder">Email:</label>
			<div class="col-sm-4">
				<input type="email" class="form-control" name="cor">
			</div>
		</div>
	</div>
	<?php echo $fn->modalFooter(1) ?>
</form>
<script>
	$(function(){
		var formulario = '.op1';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				cue: {
					required: true,
				},
				cod: {
					required: true,
				},
				tit: {
					required: true,
				},
				cor: {
					required: true,
				}
			},

			messages: {
				cue: {
					required: 'Obligatorio',
				},
				cod: {
					required: 'Obligatorio',
				},
				tit: {
					required: 'Obligatorio',
				},
				cor: {
					required: 'Obligatorio',
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
				$.post('prc-mtienda-insertcuenta',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-tienda-listacuentas','','.lista');
						if(confirm('Cuenta agregada correctamente.\n¿Desea agregar otra cuenta?')==true) {
							$(formulario).each(function(){ this.reset() })
						} else {
							cerrarmodal();
						}
					} else {
						alerta('.msj','danger',data)
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>