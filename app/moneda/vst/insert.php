<?php require '../../../cfg/base.php'; ?>
<form action="" class="op1 form-horizontal">
	<?php echo $fn->modalHeader('Agregar Moneda');
	echo $fn->modalWidth('60%'); ?>
	<div class="modal-body">
		<div class="msj"></div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Descripción Moneda:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="des" placeholder="Ej.: Dolar Estado Unidense">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Moneda:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="abr" placeholder="Ej.: USD">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Operación:</label>
			<div class="col-sm-9">
				<select class="form-control chosen" name="monope" id="monope">
					<option value="0" selected>Multiplicación</option>
					<option value="1">División</option>
				</select>
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
				des: {
					required: true,
				},
				abr: {
					required: true,
				}
			},

			messages: {
				des: {
					required: 'Obligatorio',
				},
				abr: {
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
				$.post('prc-mmoneda-insert',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-moneda-lista','','.lista');
						if(confirm('Moneda agregada correctamente.\n¿Desea agregar otra moneda?')==true) {
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