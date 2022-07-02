<?php require '../../../cfg/base.php'; 
$row = $mmoneda->lista();
if(count($row)>0): 
	foreach($row as $r):
		$rowv = $mmoneda->listamonedavalor($r->moneda_ide);
		if(count($rowv)>0): ?>
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>Id</th>
							<th>Moneda</th>
							<th>Tasa</th>
							<th>Fecha y Hora</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($rowv as $v): 
							$fechor = explode(" ", $v->monval_fecha_registro);
							$fecnue = explode("-", $fechor[0]);
							$fechornue = $fecnue[2]."-".$fecnue[1]."-".$fecnue[0]." ".$fechor[1];?>
							<tr>
								<td align="center" width="10%"><?php echo $v->monval_ide ?></td>
								<td width="50%"><?php echo $v->moneda_abreviada ." - ". $v->moneda_descrip ?></td>
								<td width="20%"><?php echo $v->monval_valor ?></td>
								<td width="20%"><?php echo $fechornue ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php else: ?>
			<div class="alert alert-info">No hay tasa para mostrar de la moneda <?php echo $r->moneda_abreviada." - ".$r->moneda_descrip; ?></div>
		<?php endif; ?>	
	<?php endforeach; ?>
<?php else: ?>
	<div class="alert alert-info">No hay monedas para mostrar.</div>
<?php endif; ?>	