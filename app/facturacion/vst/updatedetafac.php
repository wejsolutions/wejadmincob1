<?php require '../../../cfg/base.php'; ?>
<?php foreach($mfacturacion->poridedetafac($ide) as $r): ?>
	<form action="" class="op2 form-horizontal">
		<?php echo $fn->modalHeader('Editar venta de producto') ?>
		<div class="modal-body">
			<div class="msj"></div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Producto:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo $r->produc_descrip ?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Cantidad:</label>
				<div class="col-sm-9">
					<input type="number" min="0" max="<?php echo $r->produc_existen; ?>"class="form-control" name="cant" value="<?php echo $r->factdetatemp_cant ?>">
					<input type="hidden" class="form-control" name="piva" value="<?php echo $r->produc_impuesto; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Precio:</label>
				<div class="col-sm-9">
					<select class="form-control chosen" name="precio" id="precio">
						<option value="<?php echo $r->produc_precio1; ?>" <?php if ($r->produc_precio1==$r->factdetatemp_precio) echo "selected"?>><?php echo $r->produc_precio1; ?></option>
						<option value="<?php echo $r->produc_precio2; ?>" <?php if ($r->produc_precio2==$r->factdetatemp_precio) echo "selected"?>><?php echo $r->produc_precio2; ?></option>
						<option value="<?php echo $r->produc_precio3; ?>" <?php if ($r->produc_precio3==$r->factdetatemp_precio) echo "selected"?>><?php echo $r->produc_precio3; ?></option>
						<option value="<?php echo $r->produc_precio4; ?>" <?php if ($r->produc_precio4==$r->factdetatemp_precio) echo "selected"?>><?php echo $r->produc_precio4; ?></option>
					</select>
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $r->factdetatemp_ide ?>">
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
				$.post('prc-mfacturacion-updatetemp',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-facturacion-detafactu','','.detafactu');
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