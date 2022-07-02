<?php require '../../../cfg/base.php'; 
extract($_POST); 
?>
<label for="" class="control-label col-sm-4">
	<small>Seleccione Archivo Nomina:</small>
</label>
<div class="col-sm-8">
	<select class="form-control chosen" name="nomina" id="nomina" onclick="load('vst-cobranza-cargaarchivocob','idearc='+this.value,'.cargaarchivo')">
		<option value=""></option>
		<?php foreach($mcobranza->listaarchicarg() as $a): ?>
			<option value="<?php echo "$a->archi_ide"; ?>"><?php echo "$a->archi_peticion_banco | $a->archi_registros_enviados | $a->archi_fecha_nomina" ?></option>
		<?php endforeach; ?>
	</select>
</div>
<script>
	load('vst-cobranza-cargaarchivocob','','.cargaarchivo');
</script>