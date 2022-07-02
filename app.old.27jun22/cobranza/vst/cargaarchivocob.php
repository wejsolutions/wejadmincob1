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
<h4 class="lighter" align="center">Ultimo Archivo Cargado</h4>
<div class="center col-xs-6">
	<form action="" class="clearfix dropzone dz-clickable">
		<div class="dz-default dz-message" style="display:none">
		</div>
		<div class="fallback" >
			<input name="file" type="file" multiple="" />
		</div>
		<div id="lista" style="z-index:100"></div>
	</form>
</div>
<div class="center col-xs-6">
	<div class="alert alert-info"><====[ Haga click en el recuadro gris para agregar el archivo.</div>
	<?php $row = $mcobranza->ultarchicarg(); 
	if (count($row)) { 
		foreach($row as $r): 
			$totalreg = $r->archi_registros_cobrados + $r->archi_registros_fallidos;?>
			<h4>Fecha y hora del último archivo cargado: <?php echo $r->archi_fecha_respuesta ?></h4>
			<h4>Número de Control: <?php echo $r->archi_control_respuesta ?></h4>
			<h4>Fracciones Cobradas: <?php echo number_format($r->archi_registros_cobrados,0,",",".") ?></h4>
			<h4>Fracciones Fallidas: <?php echo number_format($r->archi_registros_fallidos,0,",",".") ?></h4>
			<h4>Total de Fracciones: <?php echo number_format($totalreg,0,",",".") ?></h4>
			<h4 class="orange" onclick="modal('vst-cobranza-mostrarcontenido','fec=<?php echo $r->archi_fecha_respuesta ?>&con=<?php echo $r->archi_control_respuesta ?>&arc=<?php echo $r->archi_registros_cobrados ?>&arf=<?php echo $r->archi_registros_fallidos ?>&tor=<?php echo $totalreg ?>&fen=<?php echo $r->archi_fecha_nomina_respuesta ?>')">Haga Clic aquí para ver el contenido del archivo.</h4>
			<br>
		<?php endforeach; 
	} else { ?>
		<h4 class="red">No se ha cargado archivo de Cobranza.</h4>
	<?php } ?>
</div>
<hr />