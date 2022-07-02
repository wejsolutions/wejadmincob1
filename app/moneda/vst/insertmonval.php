<?php require '../../../cfg/base.php'; ?>
<form action="" class="op1 form-horizontal">
	<?php echo $fn->modalHeader('Agregar Referencia de Moneda');
	echo $fn->modalWidth('60%'); ?>
	<div class="modal-body">
		<div class="msj"></div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Operación:</label>
			<div class="col-sm-9">
				<select class="form-control chosen" name="mon" id="mon" >
					<option value="0">Seleccione una moneda</option>
					<?php foreach($mmoneda->lista() as $a): ?>
						<option value="<?php echo "$a->moneda_ide"; ?>"><?php echo "$a->moneda_abreviada - $a->moneda_descrip" ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Tasa:</label>
			<div class="col-sm-9">
				<input type="number" min = "0.01" step="0.01" class="form-control" name="tas">
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
				tas: {
					required: true,
				}
			},

			messages: {
				tas: {
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
				var vmone = $('select[name="mon"]').val();
				if (vmone>0) {
					$.post('prc-mmoneda-insertmonedavalor',$(formulario).serialize(),function(data){
						if(!isNaN(data)) {
							load('vst-moneda-listamonval','','.lista');
							if(confirm('Referencia de Moneda agregada correctamente.\n¿Desea agregar otra referencia?')==true) {
								$(formulario).each(function(){ this.reset() });
							} else {
								cerrarmodal();
							}
						} else {
							alerta('.msj','danger',data);
						}
					});
				} else {
					alerta('.msj','danger','Seleccione Moneda a Registrar Referencia');
				}
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>