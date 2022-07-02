<?php require '../../../cfg/base.php'; 
extract($_POST); 
$formacarga='';
?>
<script>
	load('vst-cobranza-archivoslista','','#lista');
	jQuery(function($){						
		try {
		  $(".dropzone").dropzone({
		    paramName: "file", // The name that will be used to transfer the file
		    maxFilesize: 2, // MB
		    uploadMultiple: false,
    		parallelUploads: 1,
    		maxFiles: 1,
		  	acceptedFiles: '.txt', 
		  	url: 'app/cobranza/prc/p.archivo.insert.php?idearc=<?php echo $idearc; ?>',
			addRemoveLinks : true,
			dictResponseError: '¡Error al cargar el archivo!',
			dictDefaultMessage: 'sd',
			dictFallbackMessage: 'sd',
			//change the previewTemplate to use Bootstrap progress bars
			success: function() {
				load('vst-cobranza-selecarchienv','','.selecarchivo');
				//load('vst-cobranza-cargaarchivocob','','.cargaarchivo');
			}
		  });
		} catch(e) {
		  alert(e);
		}			
	});
</script>
<div class="center col-xs-4">
	<?php if ($idearc<>"") { ?>
		<form action="" class="clearfix dropzone dz-clickable">
			<div class="dz-default dz-message" style="display:none">
			</div>
			<div class="fallback" >
				<input name="file" type="file" multiple="" />
			</div>
			<div id="lista" style="z-index:100"></div>
		</form>
	<?php } ?>
</div>
<div class="center col-xs-8">
	<?php if ($idearc<>"") { ?>
		<div class="alert alert-info"><====[ Haga click en el recuadro gris para agregar el archivo.</div>
	<?php } ?>
	<h4 class="lighter" align="center">Ultimo Archivo Cargado</h4>
	<?php $row = $mcobranza->ultarchicarg(); 
	if (count($row)) { 
		foreach($row as $r): 
			$totalreg = $r->archi_registros_cobrados + $r->archi_registros_fallidos;
			$nomarc = explode("/", $r->archi_peticion_banco);
			?>
			<div class="center col-xs-6">
				<table>
					<tr>
						<th>Fec. Creación:</th><td align="left"><?php echo $r->archi_fecha_creacion ?></td>
					</tr>
					<tr>
						<th>Nombre:</th><td align="left"><?php echo $nomarc[1] ?></td>
					</tr>
					<tr>
						<th>Fec. Nomina:</th><td align="left"><?php echo $r->archi_fecha_nomina ?></td>
					</tr>
					<tr>
						<th>Total Fracc.:</th><td align="left"><?php echo number_format($r->archi_registros_enviados,0,",",".") ?></td>
					</tr>
				</table>
			</div>
			<div class="center col-xs-6">
				<table>
					<tr>
						<th>Fec. Respuesta:</th><td align="left"><?php echo $r->archi_fecha_respuesta ?></td>
					</tr>
					<tr>
						<th>Nombre:</th><td align="left"><?php echo $r->archi_respuesta_banco ?></td>
					</tr>
					<tr>
						<th>Fec. Nomina:</th><td align="left"><?php echo $r->archi_fecha_nomina_respuesta ?></td>
					</tr>
					<tr>
						<th>Control:</th><td align="left"><?php echo $r->archi_control_respuesta ?></td>
					</tr>
					<tr>
						<th>Fracc. Cob.:</th><td align="left"><?php echo number_format($r->archi_registros_cobrados,0,",",".") ?></td>
					</tr>
					<tr>
						<th>Fracc. Err.:</th><td align="left"><?php echo number_format($r->archi_registros_fallidos,0,",",".") ?></td>
					</tr>
					<tr>
						<th>Total Fracc.:</th><td align="left"><?php echo number_format($totalreg,0,",",".") ?></td>
					</tr>
					<tr>
						<th>Ver Contenido:</th><td align="left" onclick="modal('vst-cobranza-mostrarcontenido','fec=<?php echo $r->archi_fecha_respuesta ?>&con=<?php echo $r->archi_control_respuesta ?>&arc=<?php echo $r->archi_registros_cobrados ?>&arf=<?php echo $r->archi_registros_fallidos ?>&tor=<?php echo $totalreg ?>&fen=<?php echo $r->archi_fecha_nomina_respuesta ?>')"> <font color="orange">Haga Clic aquí</font></td>
					</tr>
				</table>
			</div>
		<?php endforeach; 
	} else { ?>
		<h4 class="red">No se ha cargado archivo de Cobranza.</h4>
	<?php } ?>
</div>
<hr />