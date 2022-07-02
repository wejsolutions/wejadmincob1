<?php require '../../../cfg/base.php'; ?>
<div id="princi">
<form action="" class="op1 form-horizontal">
	<?php echo $fn->modalHeader('Agregar Deposito') ?>
	<div class="modal-body">
		<div class="msj"></div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Banco:</label>
			<div class="col-sm-9">
				<select class="form-control chosen" title="Banco" name="ban" id="ban" onchange="load('vst-deposito-insert','banco_ide='+this.value,'#princi');">
					<option value=""></option>
					<?php foreach($mbanco->lista() as $p): ?>
						<option value="<?php echo $p->banco_ide ?>" <?php echo $fn->select($p->banco_ide,$_POST["banco_ide"]) ?>><?php echo $p->banco_descrip ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<?php if ($_POST["banco_ide"]!="11") { ?>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Num. Cuenta:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="ncu">
			</div>
		</div>
		<?php }else{ echo '<input type="hidden" class="form-control" name="ncu" value="0">'; } ?>

		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Num. Deposito:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="num">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Monto:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="mon">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Fecha Dep.:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control fecha" name="fde">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Fecha Venta:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control fecha" name="fdv">
			</div>
		</div>
	</div>
	<?php echo $fn->modalFooter(1) ?>
</form>
</div>
<script>
	$(function(){
		$('.chosen').chosen();
		$('.fecha').datepicker({format:'dd-mm-yyyy',endDate:'+0d'});
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
				mon: {
					required: true,
				}
			},

			messages: {
				mon: {
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
				$.post('prc-mdeposito-insert',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-deposito-lista','','.lista');
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