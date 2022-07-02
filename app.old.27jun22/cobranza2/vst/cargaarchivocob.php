<?php require '../../../cfg/base.php'; 

extract($_POST); 
$formacarga='';
?>
<script>
	/*
	Cargar archivo de respuesta del Banco*/
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
		  	url: 'app/cobranza/prc/p.archivo.insert.php',
			addRemoveLinks : true,
			dictResponseError: '¡Error al cargar el archivo!',
			dictDefaultMessage: 'sd',
			dictFallbackMessage: 'sd',
			//change the previewTemplate to use Bootstrap progress bars
			success: function() {
				load('vst-cobranza-archivoslista','','#archivos');
			}
		  });
		} catch(e) {
		  alert(e);
		}			
	});
</script>
<h4 class="lighter" align="center">Carga de Archivo</h4>
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
	<h4>Fecha y hora del último archivo cargado: <?php echo $formacarga; ?></h4>
	<h4 class="orange">No se ha cargado archivo para esta Cobranza.</h4>
	<br>
</div>
<hr />