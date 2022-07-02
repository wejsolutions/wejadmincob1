<?php require '../../../cfg/base.php'; ?>
<?php require_once("../../../lib/dompdf/dompdf_config.inc.php"); ?>
<div class="space-20"></div>

<div class="msj"></div>
<div class="col-sm-12">
	<form class="cuadrecaja">
		 <div class="form-group col-sm-3">
			<label for="" class="control-label col-sm-12">
				<small>Fecha de Inicio:</small>
			</label>
			<div class="col-sm-12">
				<div class="input-group">
					<input type="text" name="f_ini" id="f_ini" class="fecha form-control" data-date-format="yyyy-mm-dd">
					<span class="input-group-addon">
						<i class="icon-calendar bigger-110"></i>
					</span>
				</div>
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="control-label col-sm-12">
				<small>Fecha de Fin:</small>
			</label>
			<div class="col-sm-12">
				<div class="input-group">
					<input type="text" name="f_fin" id="f_fin" class="fecha form-control" data-date-format="yyyy-mm-dd">
					<span class="input-group-addon">
						<i class="icon-calendar bigger-110"></i>
					</span>
				</div>
			</div>
		</div>
		<?php $dealer=$_SESSION['s_usua_tienda'];
		if ($dealer==4) {
		echo '
		<div class="form-group col-sm-3">
			<label for="" class="control-label col-sm-12">
				<small>Dealer:</small>
			</label>
			<div class="col-sm-12">
				<div class="input-group">
					<select name="dealer" id="dealer" style="width:100%">	
						<option value="0" selected="">SELECCIONE DEALER</option>
						<option value="1">VACWK-SatelImagen Comunicaciones C.A.</option>
						<option value="3">004L4-SatelImagen Comunicaciones C.A.</option>
						<option value="2">002MP-SupeRed 416 C.A.</option>
						<option value="4">Todos</option>
	            	</select>
				</div>
			</div>
		</div>';
		}else {
			echo '<input type="hidden" class="form-control" name="dealer" id="dealer" value="'.$dealer.'">';
		}
		?>
	    <div class="form-group col-sm-3">
			<label for="" class="control-label col-sm-12">
				<small>Caja:</small>
			</label>
			<div class="col-sm-8">
				<div class="input-group">
					<select name="tipcaja" id="tipcaja" style="width:100%">	
						<option value="0" selected="">SELECCIONE CAJA</option>
						<option value="Caja1">CAJA 1</option>
                	</select>
				</div>
			</div>
			<div class="col-sm-4">	
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
				var dealer=$("#dealer").val();
				if (caja!=0){
					if (dealer!=0){
						if(f_inip<=f_finp){
							load('vst-reportes-lista','f_ini='+f_inip+'&f_fin='+f_finp+'&dealer='+dealer,'.cuadre');
							window.open('cuadrecajareport-'+f_inip+'_'+f_finp+'_'+dealer+'_'+caja);
						}else{
							alerta('.msj','danger',"La fecha de Fin no puede ser menor a la de Inicio")
							$('.detalles-factura').fadeOut();  				  
						}
					}else{
						alerta('.msj','danger','Debe Seleccionar un dealer');
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