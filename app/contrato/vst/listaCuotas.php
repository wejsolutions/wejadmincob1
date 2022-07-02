<?php require '../../../cfg/base.php'; 
extract($_POST);
$row = $mcontrato->listaCuotas($contrato_ide); ?>

<div>
<label for="" class="label control-label col-sm-12 bolder">Cuotas del Contrato</label>	
</div>
<?php if(count($row)>0): ?>
<div>
	<div class="table-responsive">
		<table class="tablecuota table-hover table-bordered" width="100%">
			<thead>
				<tr>
					<th align="center" width="10%">Cuota</th>
					<th align="center" width="20%">Monto</th>
					<th align="center" width="20%">Fecha</th>
					<th align="center" width="20%">Fracc</th>
					<th align="center" width="10%">Status</th>
					<th align="center" width="10%">Opción</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>

						<?php
						$status=0;
						switch ($r->cuota_status) {
						  case 0:
						    $status="Pendiente";
						    break;
						  case 1:
						    $status="Pagada por completo";
						    break;
						  case 2:
						    $status="Parcialmente pagada";
						    break;
						  default:
						  	$status="No definido: ".$r->cuota_status;
						}
						?>
						<td align="center" ><?php echo $r->cuota_consecutivo ?></td>
						<td align="right"  ><?php echo $r->cuota_monto ?></td>
						<td align="right"  ><?php echo $r->cuota_fecha ?></td>
						<td align="right"  ><?php echo $r->cuota_cant_fracc ?></td>
						<td align="center" ><?php echo $status ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-contrato-update_cuota',
								'ide=<?php echo $r->cuota_ide ?>&contrato_ide=<?php echo $r->cuota_cnt_ide ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Cuotas" onclick="modal('vst-contrato-listaCuotas','contrato_ide=<?php echo $r->contrato_ide ?>')">
									<i class="fa fa-trash"></i>
								</button>																
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<script>
	$(function(){
		$('.tablecuota').dataTable();
	})
</script>
<?php else: ?>
	<div class="alert alert-info">No hay registros para mostrar.</div>
<?php endif; ?>	
</div>
