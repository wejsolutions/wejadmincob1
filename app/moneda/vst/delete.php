<?php require '../../../cfg/base.php'; ?>
<?php foreach($mmoneda->poride($ide) as $r): ?>
	<form action="" class="op2 form-horizontal">
		<?php echo $fn->modalHeader('Eliminar Moneda') ?>
		<div class="modal-body">
			<div class="msj"></div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Descripción Moneda:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" placeholder="Ej.: Dolar Estado Unidense" value="<?php echo $r->moneda_descrip ?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Moneda:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="abr" placeholder="Ej.: USD" value="<?php echo $r->moneda_abreviada ?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Operación:</label>
				<div class="col-sm-9">
					<select class="form-control chosen" name="monope" id="monope" disabled>
						<option value="0" <?php echo $fn->select($r->moneda_operacion,0) ?>>Multiplicación</option>
						<option value="1" <?php echo $fn->select($r->moneda_operacion,1) ?>>División</option>
					</select>
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $r->moneda_ide ?>">
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
				$.post('prc-mmoneda-delete',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-moneda-lista','','.lista');
						alerta('.msj','success','Moneda eliminada correctamente');
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