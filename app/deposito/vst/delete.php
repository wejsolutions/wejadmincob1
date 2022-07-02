<?php require '../../../cfg/base.php'; ?>
<?php foreach($mdeposito->poride($ide) as $r): ?>
	<form action="" class="op2 form-horizontal">
		<?php echo $fn->modalHeader('Borrar Deposito') ?>
		<div class="modal-body">
			<div class="alert alert-danger">¿Realmente desea borrar el registro seleccionado?</div>
			<div class="msj"></div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Banco:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo $r->banco_descrip ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Num. Cuenta:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo $r->deposito_numerocuenta ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Num. Deposito:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo $r->deposito_numero ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Monto:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo number_format($r->deposito_monto, 2, ',', '.') ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Fecha Dep.:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo date('d-m-Y',strtotime($r->deposito_fechadeposito)) ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Fecha Venta:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo date('d-m-Y',strtotime($r->deposito_fechadiaventa)) ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Fecha Reg.:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo date('d-m-Y',strtotime($r->deposito_fecharegistro)) ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Dealer:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo $r->empresa_nombre ?>" disabled>
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $r->deposito_ide ?>">
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
				
			},

			messages: {
				
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
				$.post('prc-mdeposito-delete',$(formulario).serialize(),function(data){
					if(data==1) {
						load('vst-deposito-lista','','.lista');
						alert('Registro eliminado correctamente');
						cerrarmodal();
					} else {
						alerta('.msj','danger','Imposible eliminar. Existe una restricción de clave foránea')
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>