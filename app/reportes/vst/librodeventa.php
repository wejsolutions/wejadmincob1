<?php require '../../../cfg/base.php'; ?>
<?php extract($_POST); ?>
<?php $row = $mreportes->cuadrecaja($f_ini,$f_fin,$dealer) ?>
<?php if(count($row)>0): ?>
	<div class="btn-group">
		<button class="btn btn-success btn-xs" title="Generar EXCEL" onclick="window.open('app/reportes/vst/libroventaexcel1.php?f_ini=<?php echo $f_ini ?>&f_fin=<?php echo $f_fin ?>&dealer=<?php echo $dealer ?>')">
			<i class="fa fa-file-excel-o"></i> Generar EXCEL
		</button>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Fact. o Nota Ent.</th>
					<th>Cliente</th>
					<th>RIF</th>
					<th>Base Imponible</th>
					<th>Alicuota 12%</th>
					<th>Alicuota 8%</th>
					<th>Alicuota 9%</th>
					<th>Alicuota 7%</th>
					<th>IVA 12% BsF.</th>
					<th>IVA 8% BsF.</th>
					<th>IVA 9% BsF.</th>
					<th>IVA 7% BsF.</th>
					<th>Total</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): 
						$rowdf = $mreportes->detalibroventa($r->fact_nota);
						$baseimp=0;
						$monto12=0;
						$monto8=0;
						$monto9=0;
						$monto7=0;
						$porce12='';
						$porce8='';
						$porce9='';
						$porce7='';
						$tope=count($rowdf);
						for ($i = 0; $i < $tope; $i++) {
							if ($rowdf[$i]->PorcenIVA==12) {
								$monto12=$rowdf[$i]->MontoIVA;
								$porce12='12%';
							} elseif ($rowdf[$i]->PorcenIVA==8)  {
								$monto8=$rowdf[$i]->MontoIVA;
								$porce8='8%';
							} elseif ($rowdf[$i]->PorcenIVA==9)  {
								$monto9=$rowdf[$i]->MontoIVA;
								$porce9='9%';
							} elseif ($rowdf[$i]->PorcenIVA==7)  {
								$monto7=$rowdf[$i]->MontoIVA;
								$porce7='7%';
							}
							$baseimp=$baseimp+$rowdf[$i]->BaseImp;
						}
				?>
					<tr>
						<td align="center"><?php echo date('d-m-Y',strtotime($r->fecha)) ?></td>
						<td><?php echo $r->fact_nota ?></td>
						<td><?php echo $r->clien_nombre1." ".$r->clien_nombre2." ".$r->clien_apelli1." ".$r->clien_apelli2 ?></td>
						<td align="center"><?php echo $r->clien_tipcli."-".$r->clien_numiden ?></td>
						<td align="right"><?php echo number_format(($baseimp), 2, ',', '.') ?></td>
						<td align="center"><?php echo $porce12;?></td>
						<td align="center"><?php echo $porce8;?></td>
						<td align="center"><?php echo $porce9;?></td>
						<td align="center"><?php echo $porce7;?></td>
						<td align="right"><?php echo number_format($monto12, 2, ',', '.') ?></td>
						<td align="right"><?php echo number_format($monto8, 2, ',', '.') ?></td>
						<td align="right"><?php echo number_format($monto9, 2, ',', '.') ?></td>
						<td align="right"><?php echo number_format($monto7, 2, ',', '.') ?></td>
						<td align="right"><?php echo number_format($r->total, 2, ',', '.') ?></td>
						<td align="center"><?php if ($r->anulada==0) { echo '<font color="#008000"> Activa </font>'; } else { echo '<font color="#FF00FF"> Anulada </font>'; } ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-info">No hay registros para mostrar.</div>
<?php endif; ?>	
<script>
	$(function(){
		$('.table').dataTable();
	})
</script>