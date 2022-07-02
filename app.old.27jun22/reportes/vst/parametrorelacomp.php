<?php
/* parametrorelacom.php

* Autor: William Velasquez
* Solicita parametros para generar reporte de Relacion de Compras
* Debe llamar a => app/reportes/vst/listarelacomp.php
*
*********************************************************************/
?>
<?php require '../../../cfg/base.php';

$sql = "SELECT * FROM [dbo].[vwProveedor] order by [dbo].[vwProveedor].Nbproveedor "; 

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$row = sqlsrv_query($con,$sql, $params, $options); 
$count_record = sqlsrv_num_rows($row);
?>
<div class="space-20"></div>

<div class="msj"></div>
<div class="col-sm-12">
	<form class="festacompvent">
		<label for="" class="control-label col-sm-12">
			<b>Para generar la Relación de Compras por favor Indique:</b>
		</label>
		<div class="form-group col-sm-2">
			<label for="" class="control-label col-sm-12">
				<small>Seleccione:</small>
			</label>
			<div class="col-sm-12">
				<div class="input-group">
					<select id="tp_fecha">
					  <option value="FecFact">Fecha Factura</option>
					  <option value="FecMov">Fecha Movimiento</option>
					</select>	
				</div>
			</div>
		</div>

		<div class="form-group col-sm-3">
			<label for="" class="control-label col-sm-12">
				<small>Fecha Inicio:</small>
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
				<small>Fecha de fin:</small>
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

		<div class="form-group col-sm-3">
			<label for="" class="control-label col-sm-12">
				<small>Proveedor:</small>
			</label>			
			<div class="col-sm-12">
				<select name="id_prov" id="id_prov" class="form-control chosen">
					<option value='0'>Todos</option>
					<?php while( $i = sqlsrv_fetch_array($row, SQLSRV_FETCH_ASSOC) ) { ?>
						<option value="<?php echo $i["Coproveedor"]; ?>" ><?php echo $i["Nbproveedor"]; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>


	    <div class="form-group col-sm-1">
	    <label for="" class="control-label col-sm-12">
				<small>&nbsp;</small>
			</label>
			<div class="col-sm-4">	
				<button class="btn btn-primary btn-sm"><i class="fa fa-search"> Ver</i></button>
		    </div>
		</div>
	</form>
</div>
<div class="clearfix"></div>
<div class="space-10"></div>

<script>
	$(function(){
		$('.chosen').chosen();
	});
	$( ".fecha" ).datepicker({
		autoclose:true
	     }).next().on(ace.click_event, function(){
		  $(this).prev().focus();
	});
</script>

<script type="text/javascript">
	$(function(){

		var formulario = '.festacompvent';
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
				var f_inip   	= $("#f_ini").val();
				var f_finp      = $("#f_fin").val();
				var f_tp_fecha	= $("#tp_fecha").val();
				var f_id_prov   = $("#id_prov").val();

				if(f_inip<=f_finp){
					modal('vst-varios-modalmensaje','menmod=3');
					load('vst-reportes-listarelacomp',
						'fini='+f_inip+'&ffin='+f_finp
						+'&tp_fecha='+f_tp_fecha
						+'&id_prov='+f_id_prov,
						'.adminrelacomp');
				}else{
					alerta('.msj','danger',"La fecha de Fin no puede ser menor a la de Inicio");
				}
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>