<?php 
require '../../../cfg/base.php';
echo $fn->modalWidth('705px');
?>
<script src="js/webcam.js"></script>
<?php echo $fn->modalHeader('Fotografía Cliente') ?>
<div class="modal-body">
	<div id="my_camera" style="float:left;"></div>
    <img src="<?php echo $ccliente->picture($clien_ide).'?'.rand(1,1000) ?>" alt="Foto Actual" style="width:320px;height:240px">
</div>
<div class="clearfix"></div>
<div class="modal-footer">
   <button class="btn btn-inverse" type="button" data-bb-handler="cancel" data-dismiss="modal" onclick="load('vst-cliente-datos.personales','clien_ide=<?php echo $clien_ide ?>','.perfil');">Aceptar</button>
   <button class="btn btn-primary" type="button" onclick="take_snapshot()">Capturar</button>
</div>
<script language="JavaScript">
	Webcam.set({
		width: 320,
		height: 240,
		image_format: 'jpeg',
		jpeg_quality: 90
	});
	Webcam.attach( '#my_camera');
</script>
<script language="JavaScript">
	function take_snapshot() {
            Webcam.snap( function(data_uri) {
            Webcam.upload( data_uri, 'app/cliente/prc/foto.guardar.php?clien_ide=<?php echo $clien_ide ?>', function(code, text) {
               if(text==1) {
                  alert('Error, intente nuevamente')
               } else {
                   alert(text);
                   modal('vst-cliente-foto.cargar','clien_ide=<?php echo $clien_ide ?>')
               }
            });
          });
	}
</script>