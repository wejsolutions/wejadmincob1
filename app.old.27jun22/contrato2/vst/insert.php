<?php require '../../../cfg/base.php'; ?>
<form action="" class="op1 form-horizontal">
	<?php echo $fn->modalHeader('Agregar Contrato......') ?>
	<div class="modal-body">
		<div class="msj"></div>
		<div class="form-group">

			<label for="" class="control-label col-sm-3 bolder">Codigo:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="cod" value="C001">
			</div>

			<label for="" class="control-label col-sm-3 bolder">Fecha :</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="fec" value="2017-06-03">
			</div>

			<label for="" class="control-label col-sm-3 bolder">Monto:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="mto" value="6666">
			</div>

			<label for="" class="control-label col-sm-3 bolder">Cuotas :</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="cuo" value="666">
			</div>

			<label for="" class="control-label col-sm-3 bolder">Saldo:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="sdo" value="6666">
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
				cod: {
					required: true,
				},
				fec: {
					required: true,
				}
			},

			messages: {
				cod: {
					required: 'Obligatorio',
				},
				fec: {
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
				/*$.post('prc-contrato-insert',$(formulario).serialize(),function(data){*/
				$.post('prc-contrato-prueba',$(formulario).serialize(),function(data){	
						alerta('.msj','entro...',data)
					if(!isNaN(data)) {
						load('vst-contrato-lista','','.lista');
						if(confirm('Registro agregado correctamente.\n¿Desea agregar otro registro?')==true) {
							$(formulario).each(function(){ this.reset() })
						} else {
							a('.msj','cierre de modal',data)
/*							cerrarmodal();
*/						}
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