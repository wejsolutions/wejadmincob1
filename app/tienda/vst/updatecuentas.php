<?php require '../../../cfg/base.php'; ?>
<?php foreach($mtienda->poridecuenta($ide) as $r): ?>
	<form action="" class="op2 form-horizontal">
		<?php echo $fn->modalHeader('Editar Cuenta de Empresa');
		echo $fn->modalWidth('80%'); ?>
		<div class="modal-body">
			<div class="msj"></div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2 bolder">Empresa:</label>
				<div class="col-sm-10">
					<select class="form-control chosen" name="emp" id="emp" readonly="true">
						<option value=""></option>
						<?php foreach($mtienda->lista() as $t): ?>
							<option value="<?php echo "$t->empresa_ide"; ?>" <?php echo $fn->select($t->empresa_ide,$r->empcue_empresa_ide) ?>><?php echo "$t->empresa_rif | $t->empresa_nombre" ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2 bolder">Banco:</label>
				<div class="col-sm-4">
					<select class="form-control chosen" name="ban" id="ban" readonly="true">
						<option value=""></option>
						<?php foreach($mbanco->lista() as $b): ?>
							<option value="<?php echo "$b->banco_ide"; ?>" <?php echo $fn->select($b->banco_ide,$r->empcue_banco_ide) ?>><?php echo "$b->banco_descrip" ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<label for="" class="control-label col-sm-2 bolder">Cuenta:</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="cue" value="<?php echo $r->empcue_cuenta ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2 bolder">Código:</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="cod" value="<?php echo $r->empcue_codigo ?>">
				</div>
				<label for="" class="control-label col-sm-2 bolder">Titular:</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="tit" value="<?php echo $r->empcue_nombre ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2 bolder">Email:</label>
				<div class="col-sm-4">
					<input type="email" class="form-control" name="cor" value="<?php echo $r->empcue_email ?>">
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $r->empcue_ide ?>">
	</form>
<?php endforeach; ?>
<script>
	$(function(){
		var formulario = '.op2';
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
				$.post('prc-mtienda-updatecuenta',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-tienda-listacuentas','','.lista');
						alerta('.msj','success','Cuenta modificada correctamente');
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