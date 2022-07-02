<?php require '../../../cfg/base.php'; ?>
<?php $row = $minformes->poride($info_ide) ?>
<div class="error-informes"></div>
<form action="" class="exrerein-informes">
	<div class="form-group">
		<label for="" class="control-label col-sm-12 label bolder">Edite la descripción:</label>
		<div class="col-sm-12">
			<div class="wysiwyg-editor" id="editor" style="border:1px solid #ccc"><?php echo $row[0]->info_descrip ?></div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="space-10"></div>
	<div class="col-sm-6"><button class="btn btn-danger btn-block btn-xs" type="button" onclick="load('vst-informes-insert','fich_ide=<?php echo $fich_ide ?>&paci_ide=<?php echo $paci_ide ?>','.informes-operation');"><i class="fa fa-times"></i> Cancelar</button></div>
	<div class="col-sm-6"><button class="btn btn-primary btn-block btn-xs"><i class="fa fa-save"></i> Guardar Cambios</button></div>
	<input type="hidden" name="ide" value="<?php echo $info_ide ?>">
</form>
<div class="clearfix"></div>
<div class="space-10"></div>
<script>
	$(function(){
		$('#editor').ace_wysiwyg().prev().addClass('wysiwyg-style2');
		if ( typeof jQuery.ui !== 'undefined' && /applewebkit/.test(navigator.userAgent.toLowerCase()) ) {
				
			var lastResizableImg = null;
			function destroyResizable() {
				if(lastResizableImg == null) return;
				lastResizableImg.resizable( "destroy" );
				lastResizableImg.removeData('resizable');
				lastResizableImg = null;
			}

			var enableImageResize = function() {
				$('.wysiwyg-editor')
				.on('mousedown', function(e) {
					var target = $(e.target);
					if( e.target instanceof HTMLImageElement ) {
						if( !target.data('resizable') ) {
							target.resizable({
								aspectRatio: e.target.width / e.target.height,
							});
							target.data('resizable', true);
							
							if( lastResizableImg != null ) {//disable previous resizable image
								lastResizableImg.resizable( "destroy" );
								lastResizableImg.removeData('resizable');
							}
							lastResizableImg = target;
						}
					}
				})
				.on('click', function(e) {
					if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
						destroyResizable();
					}
				})
				.on('keydown', function() {
					destroyResizable();
				});
			}
				
			enableImageResize();
		}
		var formulario = '.exrerein-informes';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				
			},

			messages: {
				
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
				var texto = txt2html($('#editor').html());
				$.post('prc-minformes-update',$(formulario).serialize()+'&texto='+texto,function(data){
					if(!isNaN(data.trim())) {
						load('vst-informes-historico','fich_ide=<?php echo $fich_ide ?>&paci_ide=<?php echo $paci_ide ?>','.historico-informes');
					} else {
						alerta('.error-informes','danger',data.trim());
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>