<?php require '../../../cfg/base.php'; ?>
<div class="space-20"></div>

<div class="msj"></div>
<div class="col-sm-12">
	<form class="parametro">
		 <div class="form-group col-sm-6">
			<label for="" class="control-label col-sm-12">
				<small>Indique Cuenta Matriz:</small>
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

		<div class="form-group col-sm-3">
			<label for="" class="control-label col-sm-12">
				<small>Fecha de Proceso:</small>
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

	    <div class="form-group col-sm-3">
	    	<label for="" class="control-label col-sm-12">
				<small>.</small>
			</label>
			<div class="col-sm-4">	
				<button class="btn btn-primary btn-sm">Crear Archivo <i class="fa fa-edit"></i></button>
		    </div>
		</div>
	</form>
</div>
<div class="clearfix"></div>
<div class="space-10"></div>

<script>
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
				$.post('prc-mfracciones-creararchivo',$(formulario).serialize(),function(data){
					if(data==1) {
						alerta('.msj','success','Archivo creado satisfactoriamente');
					} else {
						alerta('.msj','danger',data);
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>