<?php require '../../../cfg/base.php'; ?>
<div class="msj"></div>
<div class="col-sm-12">
	<?php if (count($mfracciones->listafracciondis(0,0))>0) { ?>
	<form class="parametro">
		<div class="form-group col-sm-6">
			<label for="" class="control-label col-sm-12">
				<small class="bolder">Indique Cuenta Matriz:</small>
			</label>
			<div class="col-sm-12">
				<select class="form-control chosen" name="cuenta" id="cuenta">
					<option value=""></option>
					<?php foreach($mfracciones->listacuenta() as $c): ?>
						<option value="<?php echo "$c->banco_descrip | $c->empcue_codigo | $c->empcue_cuenta | $c->empcue_banco_ide"; ?>"><?php echo "$c->banco_descrip | $c->empcue_codigo | $c->empcue_cuenta | $c->empcue_nombre" ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="form-group col-sm-2">
			<label for="" class="control-label col-sm-12">
				<small class="bolder">Fecha de Proceso:</small>
			</label>
			<div class="col-sm-12">
				<div class="input-group">
					<input type="text" name="f_pro" id="f_pro" class="fecha form-control" data-date-format="yyyy-mm-dd">
					<span class="input-group-addon">
						<i class="icon-calendar bigger-110"></i>
					</span>
				</div>
			</div>
		</div>

		<div class="form-group col-sm-2">
			<label for="" class="control-label col-sm-12">
				<small class="bolder">Moneda:</small>
			</label>
			<div class="col-sm-12">
				<select class="form-control chosen" name="moneda" id="moneda">
					<option value=""></option>
					<?php 
					foreach($mmoneda->lista() as $m): 
						$rowv = $mmoneda->poridemoneda($m->moneda_ide);
						if(count($rowv)>0):
						?>
						<option value="<?php echo $rowv[0]->monval_ide." | ".$rowv[0]->monval_valor." | ".$rowv[0]->moneda_operacion." | ".$rowv[0]->moneda_ide; ?>"><?php echo $rowv[0]->moneda_abreviada." | ".$rowv[0]->monval_valor; ?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

	    <div class="form-group col-sm-2">
	    	<label for="" class="control-label col-sm-12">
				<small>.</small>
			</label>
			<div class="col-sm-12">	
				<button class="btn btn-primary btn-sm">Crear Archivo <i class="fa fa-edit"></i></button>
		    </div>
		</div>
	</form>
	<?php } else { ?>
		<H4 class="bolder orange" align="center">No se encontraron registros de fracciones por procesar</H4>
	<?php } ?>
</div>
<div class="clearfix"></div>
<div class="space-10"></div>
<div class="listaarchivos"></div>

<script>
	load('vst-fracciones-listaarchivofrac','','.listaarchivos');
	$(function(){
		$('.chosen').chosen();
		$( ".fecha" ).datepicker({
			autoclose:true
		     }).next().on(ace.click_event, function(){
			  $(this).prev().focus();
		});
	})
</script>

<script type="text/javascript">
	$(function(){
		var formulario = '.parametro';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				cuenta: {
					required: true,
				}
			},

			messages: {
				cuenta: {
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
				//alert("Epa");
				var vcuenta = $('select[name="cuenta"]').val();
				var vf_pro = $('input[name="f_pro"]').val();
				if (vcuenta=="") {
					alerta('.msj','danger','Seleccione Cuenta Matriz');
				} else { 
					if (vf_pro=="") {
						alerta('.msj','danger','Seleccione Fecha de Proceso');
					} else {
						$.post('prc-mfracciones-creararchivo',$(formulario).serialize(),function(data){
							if(data==1) {
								alerta('.msj','success','Archivo creado satisfactoriamente');
								load('vst-fracciones-listaarchivofrac','','.listaarchivos');
							} else {
								alerta('.msj','danger','No hay registros de Fracciones por Procesar');
							}
						});
					}
				}
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>