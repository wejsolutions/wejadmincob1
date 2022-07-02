<?php require '../../../cfg/base.php'; ?>
<div class="space-20"></div>

<div class="msj"></div>
<div class="col-sm-12">
	<form class="flibroinventariomensual">
		 <div class="form-group col-sm-3">
			<label for="" class="control-label col-sm-12">
				<small>Mes:</small>
			</label>
			<div class="col-sm-12">
				<div class="input-group">
					<select class="form-control chosen" name="mes" id="mes">	
						<option value="00" selected="">SELECCIONE MES</option>
						<option value="01">ENERO</option>
						<option value="02">FEBRERO</option>
						<option value="03">MARZO</option>
						<option value="04">ABRIL</option>
						<option value="05">MAYO</option>
						<option value="06">JUNIO</option>
						<option value="07">JULIO</option>
						<option value="08">AGOSTO</option>
						<option value="09">SEPTIEMBRE</option>
						<option value="10">OCTUBRE</option>
						<option value="11">NOVIEMBRE</option>
						<option value="12">DICIEMBRE</option>
	            	</select>
				</div>
			</div>
		</div>
		 <div class="form-group col-sm-3">
			<label for="" class="control-label col-sm-12">
				<small>Año:</small>
			</label>
			<div class="col-sm-12">
				<div class="input-group">
					<select class="form-control chosen" name="ano" id="ano">	
						<option value="0000" selected="">SELECCIONE AÑO</option>
						<option value="2016">2016</option>
						<option value="2017">2017</option>
						<option value="2018">2018</option>
						<option value="2019">2019</option>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
	            	</select>
				</div>
			</div>
		</div>
		<?php $dealer=$_SESSION['s_usua_tienda'];
		if ($dealer==4) {
		echo '
		<div class="form-group col-sm-3">
			<label for="" class="control-label col-sm-12">
				<small>Tienda:</small>
			</label>
			<div class="col-sm-12">
				<div class="input-group">
					<select name="dealer" id="dealer" style="width:100%">	
						<option value="0" selected="">SELECCIONE TIENDA</option>
						<option value="1">Empresa 1</option>
						<option value="2">Empresa 2</option>
						<option value="3">Empresa 3</option>
						<option value="4">Todas</option>
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
				<small>.</small>
			</label>
			<div class="col-sm-4">	
				<button class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
		    </div>
		</div>
	</form>
</div>
<div class="clearfix"></div>
<div class="space-10"></div>

<script>
	$(function(){
		$('.chosen').chosen();
	})
</script>

<script type="text/javascript">
	$(function(){

		var formulario = '.flibroinventariomensual';
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
	        	var mes= $("#mes").val();
				var ano= $("#ano").val();
				var dealer=$("#dealer").val();
				if (mes!="00") {
					if (ano!="0000") {
						if (dealer!=0){
							if("0"<="1"){
								load('vst-reportes-librodeinventariomensual','mes='+mes+'&ano='+ano+'&dealer='+dealer,'.libroinventariomensual');
							}else{
								alerta('.msj','danger',"El Mes y Año no puede estar en Futuro")
								$('.detalles-factura').fadeOut();  				  
							}
						}else{
							alerta('.msj','danger','Debe Seleccionar un dealer');
						}
					} else {
						alerta('.msj','danger','Debe Seleccionar Año');
					}
				} else {
					alerta('.msj','danger','Debe Seleccionar Mes');
				}

			},
			invalidHandler: function (form) {
			}
		});
	})
</script>