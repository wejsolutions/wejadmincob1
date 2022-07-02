<?php require '../../../cfg/base.php'; ?>
<div class="error-informes"></div>
<form action="" class="exrerein-informes">
	<div class="form-group">
		<label for="" class="control-label col-sm-12 label bolder">Realice una descripción:</label>
		<div class="col-sm-12">
			<div class="wysiwyg-editor" id="editor" style="border:1px solid #ccc"></div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="space-10"></div>
	<button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Guardar Cambios</button>
	<input type="hidden" name="paci" value="<?php echo $paci_ide ?>">
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
				$.post('prc-minformes-insert',$(formulario).serialize()+'&texto='+texto,function(data){
					if(!isNaN(data.trim())) {
						load('vst-informes-insert','fich_ide=<?php echo $fich_ide ?>&paci_ide=<?php echo $paci_ide ?>','.informes-operation');
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