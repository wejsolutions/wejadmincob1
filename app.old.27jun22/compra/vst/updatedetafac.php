<?php require '../../../cfg/base.php'; ?>
<?php foreach($mcompra->poridedetafac($ide) as $rc): ?>
	<form action="" class="op2 form-horizontal">
		<?php echo $fn->modalHeader('Editar Compra de producto') ?>
		<div class="modal-body">
			<div class="msj"></div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Producto:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo $rc->produc_descrip ?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Cantidad:</label>
				<div class="col-sm-9">
					<input type="number" min="0" class="form-control" name="cant" value="<?php echo $rc->compradeta_cant ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Costo:</label>
				<div class="col-sm-9">
					<input type="number" min="0" class="form-control" name="costo" value="<?php echo $rc->compradeta_costo ?>">
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $ide ?>">
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
				des: {
					required: true,
				}
			},

			messages: {
				des: {
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
				$.post('prc-mcompra-updatetemp',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-compra-detafactu','','.detafactu');
						alerta('.msj','success','Registro modificado correctamente');
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