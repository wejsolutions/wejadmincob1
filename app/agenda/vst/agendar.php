<?php require '../../../cfg/base.php'; ?>
<?php 
$row_medico = $mpaciente->poride($medico);
$row_paciente = $mpaciente->poride($paci_ide);
?>
<form action="" class="form-horizontal op-agendar">
	<?php echo $fn->modalHeader('Agendar Paciente') ?>
	<div class="modal-body">
		<div class="msj"></div>
		<div class="form-group">
			<label for="" class="control-label bolder col-sm-3">Médico:</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" value="<?php echo $row_medico[0]->paci_nombre1 ?> <?php echo $row_medico[0]->paci_apelli1 ?>" disabled>
				<input type="hidden" name="medico" value="<?php echo $medico ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label bolder col-sm-3">Paciente:</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" value="<?php echo $row_paciente[0]->paci_nombre1.' '.$row_paciente[0]->paci_apelli1; ?>" disabled>
				<input type="hidden" name="paci_ide" value="<?php echo $paci_ide ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label bolder col-sm-3">Hora Cita:</label>
			<div class="col-sm-8">
				<input class="form-control" name="inicio_normal" type="text" value="<?php if(date('h:i a',strtotime($inicio))== date('h:i a',strtotime('11:30 PM'))){ $inicio2=date('d-m-Y',strtotime($inicio)).' 07:00 AM';  }else{ $inicio2= date('d-m-Y h:i a',strtotime($inicio)); } echo $inicio2; ?>" readonly>
				<?php 
				     if(date('h:i a',strtotime($inicio))== date('h:i a',strtotime('11:30 PM'))){ 
					      $inic=explode(" ",$inicio);
					      $inicio=$inic[0].' '.$inic[1].' '.$inic[2].' '.$inic[3].' '.'07:00:00 '.' '.$inic[5].' '.$inic[6]; 

					 	} 
				    ?>

				<input type="hidden" name="inicio" value="<?php echo $inicio; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label bolder col-sm-3">Fin Cita:</label>
			<div class="col-sm-8">
				<input class="form-control" name="fin_normal" type="text" value="<?php if(date('h:i a',strtotime($fin))== date('h:i a',strtotime('11:30 PM'))){ $fin2=date('d-m-Y',strtotime($fin)).' 07:00 PM'; }else{ $fin2= date('d-m-Y h:i a',strtotime($fin)); } echo $fin2; ?>" readonly>
				<?php 
				     if(date('h:i a',strtotime($fin))==date('h:i a',strtotime('11:30 PM'))){ 
					      $finf=explode(" ",$fin);
                          $fin=$finf[0].' '.$finf[1].' '.$finf[2].' '.$finf[3].' '.'20:00:00 '.' '.$finf[5].' '.$finf[6];
					 	} 
				    ?>
				<input type="hidden" name="fin" value="<?php echo $fin ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label bolder col-sm-3">Tipo Cita:</label>
			<div class="col-sm-8">
				<select name="eti" id="" class="form-control">
				<option value="">--</option>
				<option value="label-info">RESULTADOS</option>
				<option value="label-danger">POST-OP</option>
				<option value="label-success">CONSULTAS</option>
				<option value="label-purple">PROCEDIMIENTOS</option>
				<option value="label-warning">CIRUGIA</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label bolder col-sm-3">Observación:</label>
			<div class="col-sm-8">
				<input type="text" name="obs" class="form-control col-sm-12">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label bolder col-sm-3">Procedimientos:</label>
			<div class="col-sm-8">
			      <div class="col-sm-14 select-tratamiento"></div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	

	<?php echo $fn->modalFooter(1) ?>
</form>
<script type="text/javascript">
load('vst-tratamie-select','numuso=1','.select-tratamiento')	
</script>

<script>
	$(function(){
		var formulario = '.op-agendar';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				eti: {
					required: true,
				}
			},

			messages: {
				eti: {
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
				
				$.post('prc-magenda-insert',$(formulario).serialize(),function(data){
					if(data==1) {
						load('vst-agenda-calendario','medico=<?php echo $medico ?>&inicio=<?php echo $inicio ?>','#calendario');
						cerrarmodal();
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
<script>
	$(function(){
		$('.chosen').chosen();
	})
</script>

