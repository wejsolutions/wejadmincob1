<?php require '../../../cfg/base.php'; ?>
<?php $row = $mpaciente->lista(); ?>
<form action="" class="op-buscar">
	<div class="form-group">
		<label for="" class="label control-label col-sm-12 bolder">Buscar Paciente (Registro Rápido de Paciente):</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" value="<?php echo date('D d-m-Y h:i a') ?>" disabled>
		</div>
		<div class="col-sm-7">
			<input type="text" class="form-control" id="buscarpaciente" name="paci">
		</div>
		<div class="col-sm-3">
			<button class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Buscar / Registrar</button>
			<button type="button" onclick="load('vst-agenda-calendario','medico=<?php echo $medico; ?>','#calendario')" class="btn btn-success btn-sm"><i class="fa fa-arrow-left"></i> </button>
		</div>
	</div>
</form>
<div class="clearfix"></div>
<div class="space-10"></div>
<div class="perfil"></div>

<script>
	$(function(){
		var tag_input = $('#buscarpaciente');
		if(! ( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())) ) {
			tag_input.tag(
			  {
				placeholder:tag_input.attr('placeholder'),
				//enable typeahead by specifying the source array
				source: [<?php foreach($row as $r): ?> "<?php echo $r->paci_ide.' - '.$r->naci_descrip.$r->paci_numiden.' - '.$r->paci_apelli1.' '.$r->paci_apelli2.' '.$r->paci_nombre1.' '.$r->paci_nombre2 .' '.$r->paci_correo;; ?>", <?php endforeach; ?>]
			  }
			);
		}
		else {
			//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
			tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
			//$('#form-field-tags').autosize({append: "\n"});
		}

		var formulario = '.op-buscar';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				paci: {
					required: true,
				}
			},

			messages: {
				paci: {
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
				$.post('prc-cpaciente-buscar',$(formulario).serialize(),function(data){
					if($.trim(data)=='no') {
						//alert("Entro");
						load('vst-paciente-insert.rapido','medico=<?php echo $medico ?>&inicio=<?php echo $inicio ?>&fin=<?php echo $fin ?>','.perfil');
					} else if(data>0){
						load('vst-agenda-calendario','medico=<?php echo $medico; ?>','#calendario');
						 modal('vst-agenda-agendar','medico=<?php echo $medico ?>&inicio=<?php echo $inicio ?>&fin=<?php echo $fin ?>&paci_ide='+data.trim());
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>