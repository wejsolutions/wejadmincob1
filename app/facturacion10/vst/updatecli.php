<?php require '../../../cfg/base.php'; ?>
<?php foreach($mcliente->poride($clien_ide) as $r): ?>
	<form action="" class="op2-pac well">
		<div class="msj-pac"></div>
		<fieldset><legend>Datos Personales del Cliente</legend>	
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Tipo: </label>
				<div class="col-sm-10" id="tipcli">
					<select class="form-control chosen" title="Agregar" name="tipcli" id="tipcli" onchange="load('vst-tipclien-select','tipcli_ide='+this.value,'#tipcli');">
						<option value=""></option>
						<?php foreach($mtipclien->lista() as $p): ?>
							<option value="<?php echo $p->tipcli_ide ?>" <?php echo $fn->select($p->tipcli_ide,$r->clien_tipcli) ?>><?php echo $p->tipcli_descrip ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">N° Identificación:</label>
				<div class="col-sm-12">
					<input type="text" name="ced" class="form-control" value="<?php echo $r->clien_numiden ?>">
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Fecha de Nacimiento:</label>
				<div class="col-sm-12">
					<input type="text" name="fnac" class="form-control fecha" value="<?php echo date('d-m-Y',strtotime($r->clien_fecnaci)); ?>">
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Primer Nombre:</label>
				<div class="col-sm-12">
					<input type="text" name="nom1" class="form-control" value="<?php echo $r->clien_nombre1 ?>">
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Segundo Nombre:</label>
				<div class="col-sm-12">
					<input type="text" name="nom2" class="form-control" value="<?php echo $r->clien_nombre2 ?>">
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Primer Apellido:</label>
				<div class="col-sm-12">
					<input type="text" name="ape1" class="form-control" value="<?php echo $r->clien_apelli1 ?>">
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Segundo Apellido:</label>
				<div class="col-sm-12">
					<input type="text" name="ape2" class="form-control" value="<?php echo $r->clien_apelli2 ?>">
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Dirección:</label>
				<div class="col-sm-12">
					<input type="text" name="dir" class="form-control" value="<?php echo $r->clien_direcci ?>">
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Teléfono Móvil:</label>
				<div class="col-sm-12">
					<input type="text" name="mov" class="form-control" value="<?php echo $r->clien_telmovi ?>">
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Correo Electrónico:</label>
				<div class="col-sm-12">
					<input type="text" name="corre" class="form-control" value="<?php echo $r->clien_correo ?>">
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Contribuyente Especial:</label>
					<select class="form-control chosen" name="coes" id="coes">
						<option <?php if ($r->clien_contriespec==0) echo 'selected="true"'; ?> value="0">No</option>
						<option <?php if ($r->clien_contriespec==1) echo 'selected="true"'; ?> value="1">Si</option>
					</select>
			</div>
			<div class="clearfix"></div>
			<div class="form-actions">
				<div class="btn-group pull-right">
					<button class="btn btn-primary btn-sm"><span class="i fa fa-check"></span> Guardar Cambios</button>
					<button type="button" class="btn btn-danger btn-sm pull-right" onclick="load('vst-facturacion-datos.personales','clien_ide=<?php echo $clien_ide ?>','.perfil')"><span class="i fa fa-times"></span> Cancelar</button>
				</div>
			</div>
		</fieldset>
		<input type="hidden" name="clien_ide" value="<?php echo $r->clien_ide ?>">
	</form>
<?php endforeach; ?>
<script>
	$(function(){
		$('.chosen').chosen();
		$('.fecha').datepicker({format:'dd-mm-yyyy',endDate:'-18y'});
	})
</script>

<script>
	$(function(){
		var formulario = '.op2-pac';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				tipcli: {
					required: true,
				},
				ced: {
					required: true,
				},
				nom1: {
					required: true,
				},
				dir: {
					required: true,
				}
			},

			messages: {
				tipcli: {
					required: 'Obligatorio',
				},
				ced: {
					required: 'Obligatorio',
				},
				nom1: {
					required: 'Obligatorio',
				},
				dir: {
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
				$.post('prc-mfacturacion-updatecli',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						alert('Cambios guardados correctamente');
						load('vst-facturacion10-datos.personales','clien_ide=<?php echo $clien_ide ?>','.perfil');
					} else {
						alerta('.msj-pac','danger',data)
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>