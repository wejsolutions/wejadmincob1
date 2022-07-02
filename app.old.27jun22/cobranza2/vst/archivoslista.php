<?php require '../../../cfg/base.php'; 
extract($_POST); 
?>
<script type="text/javascript">
	jQuery(function($) {
		var colorbox_params = {
			reposition:true,
			scalePhotos:true,
			scrolling:true,
			previous:'<i class="icon-arrow-left"></i>',
			next:'<i class="icon-arrow-right"></i>',
			close:'&times;',
			current:'{current} of {total}',
			maxWidth:'95%',
			maxHeight:'100%',
			onOpen:function(){
				document.body.style.overflow = 'hidden';
			},
			onClosed:function(){
				document.body.style.overflow = 'auto';
			},
			onComplete:function(){
				$.colorbox.resize();
			}
		};

		$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
		$("#cboxLoadingGraphic").append("<i class='icon-spinner orange'></i>");//let's add a custom loading icon
	})
	function borrarArchivo(ide,archivo) {
		//alert(ide+'  '+archivo);
		if(confirm('¿Realmente desea borrar el archivo seleccionado?')==true) {
			$.post('app/cobranza/prc/p.archivo.delete.php',ide+'&'+archivo,function(data){
				load('app/cobranza/vst/archivoslista.php','','#lista');
			})
		}
	}
</script>
<?php 
$row = $mcobranza->listaarchivos(); 
if(count($row)>0) { ?>
	<?php foreach($row as $r): 
		if (substr($r->archi_ruta,-3)=="txt") {
			$tipo=substr($r->archi_ruta,-3);
		} else {
			$tipo="otro";
		} ?>
		<div class="row-fluid">
			<ul class="ace-thumbnails">
				<li>
					<a href="app/cobranza/vst/ArchivosDeRespuesta/<?php echo $r->archi_ruta ?>" data-rel="colorbox"  title="<?php echo $r->archi_ruta." - ".$r->archi_descripcion." " ?> ">
						<img alt="app/cobranza/vst/ArchivosDeRespuesta/<?php echo $r->archi_ruta ?>" style="width:90px;height:90px" src="img/formato<?php echo $tipo ?>.png" />
						<div class="text">
							<div class="inner"></div>
						</div>
					</a>

					<div class="tools tools-bottom">
						<a href="#" onclick="borrarArchivo('archi_ide=<?php echo $r->archi_ide ?>','archivo=<?php echo $r->archi_ruta ?>'); return false">
							<i class="icon-remove red"></i>
						</a>
					</div>
				</li>
			</ul>
		</div>
	<?php endforeach; ?>
<?php } else { ?>
	<div class="dz-default dz-message"><span><span class="bigger-100 bolder"><i class="icon-caret-right red"></i> Click para Subir Archivo .txt</span><br><span class="smaller-60 grey"> Si tiene dudas consulte a un representante de WejSolutions</span> <br> <i class="upload-icon icon-cloud-upload blue icon-2x"></i></span></div>
<?php }  ?>