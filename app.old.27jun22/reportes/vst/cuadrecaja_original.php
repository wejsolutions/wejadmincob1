<?php require '../../../cfg/base.php'; ?>
<div class="space-20"></div>
<div class="col-xs-3"></div>
<div class="msj"></div>
<div class="col-sm-12">
<form class="cuadrecaja col-sm-8 col-sm-offset-2">
		 <div class="form-group col-sm-4">
							<label for="" class="control-label col-sm-12">
								<small>Fecha de Inicio:</small>
							</label>
							<div class="col-sm-10">
								<div class="input-group">
									<input type="text" name="f_ini" id="f_ini" class="fecha form-control" data-date-format="yyyy-mm-dd">
									<span class="input-group-addon">
										<i class="icon-calendar bigger-110"></i>
									</span>
								</div>
							</div>
		</div>
		    <div class="form-group col-sm-4">
							<label for="" class="control-label col-sm-12">
								<small>Fecha de Fin:</small>
							</label>
							<div class="col-sm-10">
								<div class="input-group">
									<input type="text" name="f_fin" id="f_fin" class="fecha form-control" data-date-format="yyyy-mm-dd">
									<span class="input-group-addon">
							<i class="icon-calendar bigger-110"></i>
									</span>
								</div>
							</div>
			</div>
	    <div class="form-group col-sm-4">
							<label for="" class="control-label col-sm-12">
								<small>Caja:</small>
							</label>
							<div class="col-sm-10">
								<div class="input-group">
								<select name="tipcaja" id="tipcaja" style="width:100%">	
									<option value="0" selected="">Seleccione...</option>
									<option value="Caja1">Caja1</option>
									<option value="Caja2">Caja2</option>
									<option value="T">Todos</option>
                                </select>
								</div>
							</div>
		                      <div class="col-sm-2">	
				                  <button class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
		                      </div>
		</div>
</form>
</div>
<div class="clearfix"></div>
<div class="space-10"></div>

<script type="text/javascript">
	$(function(){

	$( ".fecha" ).datepicker({
		autoclose:true
	     }).next().on(ace.click_event, function(){
		  $(this).prev().focus();
	});

		var formulario = '.cuadrecaja';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				f_ini : {
					required: true,
					date: true
				},
				f_fin : {
					required: true,
					date: true
				},
			},

			messages: {
				f_ini : {
					required: 'Obligatorio',
					date: 'Fecha no válida'
				},
				f_fin : {
					required: 'Obligatorio',
					date: 'Fecha no válida'
				},
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
	          var f_inip= $("#f_ini").val();
			  var f_finp= $("#f_fin").val();
			  var caja=$("#tipcaja").val();
			  if (caja!=0){
			     if(f_inip<=f_finp){
				    $.post('prc-mreportes-cuadrecaja',$(formulario).serialize(),function(data){
		               if(data>0){
						    window.open('cuadrecaja-'+f_inip+'/'+f_finp+'/'+caja);
					    } else {
						    alerta('.msj','danger',data)
						   $('.detalles-factura').fadeOut();
					    }	
				    })
				  }else{
                            alerta('.msj','danger',"La fecha de Fin no puede ser menor a la de Inicio")
						    $('.detalles-factura').fadeOut();  				  
				  }
			    }else{
                  alerta('.msj','danger','Debe Seleccionar una caja');
			    }
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>