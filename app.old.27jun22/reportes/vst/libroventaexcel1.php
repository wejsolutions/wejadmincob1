<?php require '../../../cfg/base.php'; ?>
<?php extract($_POST); ?>
<?php $row = $mreportes->cuadrecaja($f_ini,$f_fin,$dealer) ?>
<?php $rowt = $mtienda->poride($dealer) ?>
<?php header('Content-type: application/vnd.ms-excel');
$nom_tie=str_replace(' ','',$rowt[0]->empresa_nombre);
$nombrearchivo=$nom_tie."_".date('d-m-Y',strtotime($f_ini))."_".date('d-m-Y',strtotime($f_fin));
header("Content-Disposition: attachment; filename=Libro_de_Ventas_".$nombrearchivo.".xls");
header("Pragma: no-cache");
header("Expires: 0");?>
<?php if(count($row)>0): ?>
	<div class="">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th colspan="9"><h1><?php echo "Libro de Ventas ".$rowt[0]->empresa_nombre; ?></h1></th>
				</tr>
				<tr>
					<th colspan="9"><h2><?php echo "Del ".date('d-m-Y',strtotime($f_ini))." al ".date('d-m-Y',strtotime($f_fin)); ?></h2></th>
				</tr>
			</thead>
		</table>
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
					<th>IVA 12% BsF.</th>
					<th>IVA 8% BsF.</th>
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
						$porce12='';
						$porce8='';
						$tope=count($rowdf);
						for ($i = 0; $i < $tope; $i++) {
							if ($rowdf[$i]->PorcenIVA==12) {
								$monto12=$rowdf[$i]->MontoIVA;
								$porce12='12%';
							} elseif ($rowdf[$i]->PorcenIVA==8)  {
								$monto8=$rowdf[$i]->MontoIVA;
								$porce8='8%';
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
						<td align="right"><?php echo number_format($monto12, 2, ',', '.') ?></td>
						<td align="right"><?php echo number_format($monto8, 2, ',', '.') ?></td>
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