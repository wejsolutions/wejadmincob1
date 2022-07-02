<?php require '../../../cfg/base.php'; ?>
<?php foreach($mproducto->kardexporide($ide) as $r): ?>
	<form action="" class="op2 form-horizontal">
		<?php echo $fn->modalHeader('Borrar Retiro o Auto-Consumo') ?>
		<div class="modal-body">
			<div class="alert alert-danger">¿Realmente desea borrar el registro seleccionado?</div>
			<div class="msj"></div>
			<div class="form-group">
				<?php 
					if ($r->kardex_tipo==5) { $tipo="Retiro de Mercancia"; }
					else { $tipo="Auto-Consumo de Mercancia"; }
				?>
				<label for="" class="control-label col-sm-3 bolder">Tipo:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo $tipo ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Producto:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo $r->produc_descrip ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Cantidad:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo $r->kardex_cantidad ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">De Fecha:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo date('d-m-Y',strtotime($r->kardex_fecha)) ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Observación:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo $r->kardex_observacion; ?>" disabled>
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $r->kardex_ide; ?>">
		<input type="hidden" class="form-control" name="tip" value="<?php echo "1".$r->kardex_tipo; ?>">
		<input type="hidden" class="form-control" name="pro" value="<?php echo $r->produc_ide; ?>">
		<input type="hidden" class="form-control" name="can" value="<?php echo $r->kardex_cantidad; ?>">
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
				$.post('prc-mproducto-kardexdeleteretiro',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-producto-listaretiro','','.lista');
						alert('Registro eliminado correctamente');
						cerrarmodal();
					} else {
						alerta('.msj','danger','Imposible eliminar. Existe una restricción de clave foránea')
						alert(data);
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>