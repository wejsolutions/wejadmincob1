function alerta(capa,tipo,msj) {
	$(capa).fadeIn().html('<div class="alert alert-'+tipo+'"><button class="close" data-dismiss="alert" type="button"><i class="icon-remove"></i></button>'+msj+'</div>')
}
function cerraralerta(capa) {
	$(capa).fadeOut().html('');
}

function load(url,datos,capa) {
	$.post(url,datos,function(data){
		$(capa).fadeIn().html(data);
	})
}

function modal(url,datos) {
	$.post(url, datos, function(data){
		$('#modal').modal({backdrop:'static', keyboard:true }, 'show');
		$('#modal .modal-dialog .modal-content').html(data);
	})
}

function cerrarmodal() {
	$('#modal').modal('hide');
}

function txt2html(texto){     
	return String(texto).replace(/&amp;/g, "aspersonsignalascii").replace(/&nbsp;/g, " ").replace(/&gt;/g, ">").replace(/&lt;/g, "<").replace(/&#039;/g, "'").replace(/&quot;/g, '"');
}