<?php require '../../../cfg/base.php';
$row_banco=$mbanco->listapororden();

/*$sql = "SELECT * FROM [tbl_banco]  order by [tbl_banco].banco_descrip "; 
*/
/*$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$row = sqlsrv_query($con,$sql, $params, $options); 
$count_record = sqlsrv_num_rows($row);*/
?>

<div class="space-20"></div>

<div class="msj"></div>
<div class="col-sm-12">
	<form class="parametros_fracc">
		 <div class="form-group col-sm-3">
			<label for="" class="control-label col-sm-12">
				<small>Fecha de Inicio:</small>
			</label>
			<div class="col-sm-12">
				<div class="input-group">
					<input type="text" name="f_ini" id="f_ini" class="fecha form-control" data-date-format="yyyy-mm-dd" value='2022-06-30'>
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
					<input type="text" name="f_fin" id="f_fin" class="fecha form-control" data-date-format="yyyy-mm-dd" value='2022-06-30'>
					<span class="input-group-addon">
						<i class="icon-calendar bigger-110"></i>
					</span>
				</div>
			</div>
		</div>

		<div class="form-group col-sm-3">
			<label for="" class="control-label col-sm-12">
				<small>Banco:</small>
			</label>			
			<div class="col-sm-12">
				<select name="banco_ide" id="banco_ide" class="form-control chosen">
				<?php foreach($row_banco as $p): ?>
						<option value="<?php echo $p->banco_ide; ?>" ><?php echo $p->banco_descrip; ?></option>
				<?php endforeach; ?>	
				</select>
			</div>
		</div>

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

<script type="text/javascript">
	$(function(){

	$( ".fecha" ).datepicker({
		autoclose:true
	     }).next().on(ace.click_event, function(){
		  $(this).prev().focus();
	});

		var formulario = '.parametros_fracc';
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
				var dealer=$("#dealer").val();

					if (dealer!=0){
						if(f_inip<=f_finp){
							load('vst-fracciones-cuotasporcobrar','f_ini='+f_inip+'&f_fin='+f_finp,'.datoscuotas');
						}else{
							alerta('.msj','danger',"La fecha de Fin no puede ser menor a la de Inicio")
							$('.detalles-factura').fadeOut();  				  
						}
					}else{
						alerta('.msj','danger','Debe Seleccionar un dealer');
					}
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>