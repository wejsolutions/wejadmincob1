<?php require '../../../cfg/base.php'; ?>
<div id="princi">
<form action="" class="op1 form-horizontal">
	<?php echo $fn->modalHeader('Agregar Retiro o Auto-Consumo') ?>
	<div class="modal-body">
		<div class="msj"></div>
				<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Tipo:</label>
			<div class="col-sm-9">
				<select class="form-control chosen" title="Tipo" name="tip" id="tip">
					<option value="0"></option>
					<option value="5">Retiro de Mercancia</option>
					<option value="6">Auto-Consumo</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Producto:</label>
			<div class="col-sm-9">
				<select class="form-control chosen" title="Producto" name="pro" id="pro">
					<option value="0"></option>
					<?php foreach($mproducto->listapro() as $p): ?>
						<option value="<?php echo $p->produc_ide ?>"><?php echo $p->produc_descrip ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Cantidad:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="can">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Observación:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="obs">
			</div>
		</div>
	</div>
	<?php echo $fn->modalFooter(1) ?>
</form>
</div>
<script>
	$(function(){
		$('.chosen').chosen();
	})
</script>
<script>
	$(function(){
		var formulario = '.op1';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				can: {
					required: true,
				}
			},

			messages: {
				can: {
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
				$.post('prc-mproducto-kardexinsertretiro',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-producto-listaretiro','','.lista');
						if(confirm('Registro agregado correctamente.\n¿Desea agregar otro registro?')==true) {
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