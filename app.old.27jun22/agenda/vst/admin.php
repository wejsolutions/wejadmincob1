<form action="" class="op-select-medico col-sm-6 col-sm-offset-3">
	<div class="form-froup">
		<label for="" class="label control-label bolder col-sm-12">Seleccionar Médico</label>
		<div class="col-sm-10">
			<select name="medico" id="medico" class="form-control" onchange="calendario(this.value)">
				<option value=""></option>
				<?php foreach($cagenda->selectMedicosAgenda($s_tius_ide,$s_clien_ide) as $r): ?>
					<option value="<?php echo $r->paci_ide ?>" <?php echo $fn->select($r->paci_ide,$s_clien_ide) ?>>
						<?php echo $r->paci_apelli1 ?> <?php echo $r->paci_apelli2 ?>, <?php echo $r->paci_nombre1 ?> <?php echo $r->paci_nombre2 ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="col-sm-2">
			<button type="button" class="btn btn-sm btn-primary"  onclick="calendarioBoton()"><i class="fa fa-search"></i></button>
		</div>
	</div>
</form>
<div class="clearfix"></div>
<div class="space-20"></div>
<div id="calendario"></div>
<script>
	function calendarioBoton() {
		medico = $('#medico').val();
		calendario(medico);
	}
	function calendario(medico) {
		if(medico!="") {
			load('vst-agenda-calendario','medico='+medico,'#calendario');
		} else {
			$('#calendario').html('');
		}
	}
	<?php echo $cagenda->cargaAgendaAuto($s_tius_ide,$s_clien_ide) ?>
</script>