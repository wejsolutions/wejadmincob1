<?php require '../../../cfg/base.php'; 
echo $fn->modalWidth('80%');
$row = $magenda->poride($cita_ide);
?>
<?php echo $fn->modalHeader('Detalles de Cita') ?>

<?php 
switch ($row[0]->cita_etiquet) {
    case 'label-info':
        $tipo_cita= "RESULTADO";
        break;
    case 'label-danger':
        $tipo_cita= "POST-OP";
        break;
    case 'label-success':
        $tipo_cita= "CONSULTA";
        break;           
    case 'label-purple':
        $tipo_cita= "PROCEDIMIENTOS";
        break;           
    case 'label-warning':
        $tipo_cita= "CIRUGIA";
        break;                   
}
?>


<div class="modal-body">
	<div class="msj4"></div>
	<div class="col-sm-2">
		<span class="profile-picture">
			<img id="avatar" class="editable img-responsive editable-click editable-empty" alt="" src="<?php echo $cpaciente->picture($row[0]->paci_ide).'?'.rand(1,1000) ?>">
		</span>
	</div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th class="active text-right" style="width:20%">N° Identificación:</th>
					<td style=""><?php echo $row[0]->naci_descrip.'-'.$row[0]->paci_numiden ?></td>
					<th style="width:20%" class="active text-right">Apellidos y Nombres:</th>
					<td><?php echo $row[0]->paci_apelli1.' '.$row[0]->paci_apelli2.', '.$row[0]->paci_nombre1.' '.$row[0]->paci_nombre2 ?></td>
				</tr>
				<tr>
					<th class="active text-right">Fecha de Nac:</th>
					<td><?php echo date('d-m-Y',strtotime($row[0]->paci_fecnaci)); ?> (<?php echo $cpaciente->edad($row[0]->paci_fecnaci); ?>)</td>
					<th class="active text-right">Correo Electronico:</th>
					<td><?php echo $row[0]->paci_correo ?></td>
				</tr>
				<tr>
					<th class="active text-right">Teléfono Res:</th>
					<td><?php echo $row[0]->zona_codarea.' - '.$row[0]->paci_telcasa ?></td>
					<th class="active text-right">Teléfono Móvil:</th>
					<td><?php echo $row[0]->temo_codigo.' - '.$row[0]->paci_telmovi ?></td>
				</tr>
				<tr>
					<th class="active text-right">Género:</th>
					<td><?php echo $cpaciente->genero($row[0]->paci_genero) ?></td>
					<th class="active text-right">Dirección de Hab:</th>
					<td><?php echo $row[0]->paci_direcci.', '.$row[0]->zonres.' '.$row[0]->estres.' '.$row[0]->paires ?></td>
				</tr>
				<tr class="active success">
					<th class="active text-right">Entrada:</th>
					<td><?php echo date('d-m-Y h:i a',strtotime($row[0]->cita_inicio)) ?></td>
					<th class="active text-right">Salida:</th>
					<td><?php echo date('d-m-Y h:i a',strtotime($row[0]->cita_fin)) ?></td>
				</tr>
				<tr class="active text-right">
					<th class="active text-right">Tipo de Cita:</th>
					<td class="active text-left"><span class='label <?php echo $row[0]->cita_etiquet; ?>'><?php echo $tipo_cita; ?></span> </td>
					<th class="active text-right">Creada el:</th>
					<td class="active text-left"><?php echo date('d-m-Y h:i a',strtotime($row[0]->cita_fecregi)) ?></td>
				</tr>
				<tr class="">
					<th class="active text-right">Procedimiento:</th>
				<?php if($row[0]->cita_trat==0) { ?>	
					    <td class="active text-left"><?php echo "No tiene asignado(a) procedimiento"; ?></td>
				<?php }else{ ?>	
                        <td class="active text-left"><?php echo $row[0]->trat_descrip; ?></td>
				<?php } ?>	
					<th class="active text-right">Observación:</th>
					<td class="active text-left"><?php echo $row[0]->cita_observa ?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<div class="modal-footer">
	<button class="btn btn-default" type="button" data-bb-handler="cancel" data-dismiss="modal">Cerrar</button>
	<button class="btn btn-danger" type="button" onclick="cancelaCita('cita_ide=<?php echo $cita_ide ?>')">Cancelar Cita</button>
</div>

<script>
	function cancelaCita(datos) {
		if(confirm('¿Realmente desea cancela la cita seleccionada?')==true) {
			$.post('prc-magenda-delete',datos,function(data){
				load('vst-agenda-calendario','medico=<?php echo $row[0]->cita_medico ?>&inicio=<?php echo $row[0]->cita_inicio ?>','#calendario');
				cerrarmodal();
			})
		}
	}
</script>