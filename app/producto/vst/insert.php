<?php require '../../../cfg/base.php'; ?>
<div class="alert alert-info">
	<i class="fa fa-exclamation-triangle fa-3x pull-left red"></i> Por favor rellene el siguiente formulario para agregar un producto o servicio.
</div>
<form action="" class="op1-produc">
	<div class="msj-produc" id="errores"></div>
	<!-- Datos del producto ############### -->
	<fieldset><legend>Datos de Producto o Servicio</legend>	
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Código:</label>
			<div class="col-sm-12">
				<input type="text" name="cod" class="form-control">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Descripción del Producto o Servicio:</label>
			<div class="col-sm-12">
				<input type="text" name="des" class="form-control">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Existencia:</label>
			<div class="col-sm-12">
				<input type="number" min=0 name="exi" class="form-control">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Unidad de Medida: </label>
			<div class="col-sm-10" id="unidmed">
				<select class="form-control chosen" title="Unidad de Medida" name="unm" id="unm" onchange="load('vst-unidmed-select','unidmed_ide='+this.value,'#ideunidmed');">
					<option value=""></option>
					<?php foreach($munidmed->lista() as $p): ?>
						<option value="<?php echo $p->unidmed_ide ?>"><?php echo $p->unidmed_descrip ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Marca:</label>
			<div class="col-sm-10" id="marca">
				<select class="form-control chosen" name="mar" id="mar">
					<option value=""></option>
					<?php foreach($mmarca->lista() as $p): ?>
						<option value="<?php echo $p->marca_ide ?>"><?php echo $p->marca_descrip ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Costo:</label>
			<div class="col-sm-12">
				<input type="text" name="cos" class="form-control">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Precio de Venta 1:</label>
			<div class="col-sm-12">
				<input type="text" name="pre1" class="form-control">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Precio de Venta 2:</label>
			<div class="col-sm-12">
				<input type="text" name="pre2" class="form-control">
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Impuesto:</label>
			<div class="col-sm-10" id="impuesto">
				<select class="form-control chosen" name="imp" id="imp">
					<option value=""></option>
					<?php foreach($mimpuesto->lista() as $p): ?>
						<option value="<?php echo $p->impuesto_ide ?>"><?php echo $p->impuesto_porcent ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">¿Es Servicio?:</label>
			<div class="col-sm-10" id="ser">
				<select class="form-control chosen" name="ser" id="ser">
					<option value=""></option>
					<option value="0">No</option>
					<option value="1">Si</option>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Aplica para la tienda:</label>
			<div class="col-sm-10" id="tienda">
				<select class="form-control chosen" title="Tienda" name="tie" id="tie">
					<option value=""></option>
					<?php foreach($mtienda->lista() as $t): ?>
						<option value="<?php echo $t->empresa_ide; ?>"><?php echo $t->empresa_nombre; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Existencia Minima:</label>
			<div class="col-sm-12">
				<input type="number" min=0 name="sto" class="form-control">
			</div>
		</div>
<!-- Botón de acción ###########-->

<div class="clearfix"></div>
<div class="form-actions clearfix">
	<button class="btn btn-primary btn-sm pull-right"><span class="i fa fa-check"></span> Guardar Cambios</button>
</div>
	</fieldset>

</form>


<script>
	$(function(){
		$('.chosen').chosen();
		$('.fecha').datepicker({format:'dd-mm-yyyy',endDate:'-18y'});
	})
</script>

<script>
	$(function(){
		var formulario = '.op1-produc';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				des: {
					required: true,
				},
				exi: {
					required: true,
					number: true,
				},
				cos: {
					required: true,
					number: true,
				},
				pre1: {
					required: true,
					number: true,
				},
				pre2: {
					required: true,
					number: true,
				},
				pre3: {
					required: true,
					number: true,
				},
				pre4: {
					required: true,
				},
				col: {
					required: true,
				},
				tal: {
					required: true,
				},
				med: {
					required: true,
				}
			},

			messages: {
				des: {
					required: 'Obligatorio',
					},
				exi: {
					required: 'Obligatorio',
					},
				cos: {
					required: 'Obligatorio',
					},
				pre1: {
					required: 'Obligatorio',
					},
				pre2: {
					required: 'Obligatorio',
					},
				pre3: {
					required: 'Obligatorio',
					},
				pre4: {
					required: 'Obligatorio',
					},
				col: {
					required: 'Obligatorio',
					},
				tal: {
					required: 'Obligatorio',
					},
				med: {
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
				$.post('prc-cproducto-cinsert',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-producto-datos.producto','produc_ide='+data.trim(),'.perfil');
					} else {
						alerta('.msj-produc','danger',data)
						location.href="#errores"
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>
<script>
	$(function(){
		var tag_input = $('#input_buscarcompania');
		if(! ( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())) ) {
			tag_input.tag(
			  {
				placeholder:tag_input.attr('placeholder'),
				//enable typeahead by specifying the source array
				source: [<?php foreach($mproducto->lista() as $r): ?> "<?php echo $r->produc_ide.' - '.$r->produc_descrip.$r->produc_existe.' - '.$r->produc_costo.' '.$r->produc_precio1.' '.$r->produc_precio2.' '.$r->produc_precio3; ?>", <?php endforeach; ?>]
			  }
			);
		}
		else {
			//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
			tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
			//$('#form-field-tags').autosize({append: "\n"});
		}
	});
</script>