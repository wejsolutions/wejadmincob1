<?php require '../../../cfg/base.php'; ?>
<?php //$row = $mreportes->cuadrecaja("2016-06-01","2016-11-21") ?>
<?php extract($_POST); ?>
<?php $row = $mreportes->cuadrecaja($f_ini,$f_fin,$dealer) ?>
<?php $rowtcc = $mreportes->totalcuadrecaja($f_ini,$f_fin,$dealer) ?>
<?php $rowtcca = $mreportes->totalcuadrecajaanulada($f_ini,$f_fin,$dealer); ?>
<?php $rowtccr = $mreportes->totalcuadrecajareal($f_ini,$f_fin,$dealer); ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Id</th>
					<th>Cliente</th>
					<th>Fact. o Nota Ent.</th>
					<th>Fecha</th>
					<th>Forma Pago</th>
					<th>Efectivo</th>
					<th>T. D.</th>
					<th>T. C.</th>
					<th>T. A.</th>
					<th>Cheque</th>
					<th>Transf.</th>
					<th>Total</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo $r->ide ?></td>
						<td><?php echo $r->clien_tipcli."-".$r->clien_numiden." ".$r->clien_nombre1." ".$r->clien_nombre2." ".$r->clien_apelli1." ".$r->clien_apelli2 ?></td>
						<td><?php echo $r->fact_nota ?></td>
						<td align="center"><?php echo date('d-m-Y',strtotime($r->fecha)) ?></td>
						<td align="center"><?php if ($r->formapago==0) { echo "Contado"; } else { echo "Credito"; } ?></td>
						<td align="right"><?php echo number_format($r->efectivo, 2, ',', '.') ?></td>
						<td align="right"><?php echo number_format($r->debito, 2, ',', '.') ?></td>
						<td align="right"><?php echo number_format($r->credito, 2, ',', '.') ?></td>
						<td align="right"><?php echo number_format($r->alimentacion, 2, ',', '.') ?></td>
						<td align="right"><?php echo number_format($r->cheque, 2, ',', '.') ?></td>
						<td align="right"><?php echo number_format($r->transferencia, 2, ',', '.') ?></td>
						<td align="right"><b><?php echo number_format($r->total, 2, ',', '.') ?></b></td>
						<td align="center"><?php if ($r->anulada==0) { echo '<font color="#008000"> Activa </font>'; } else { echo '<font color="#FF00FF"> Anulada </font>'; } ?></td>
					</tr>
				<?php endforeach; ?>
				<tr bgcolor="#80FFC0">
					<td align="center">T1.</td>
					<td></td>
					<td></td>
					<td></td>
					<td align="center"><b>TOTAL:</b></td>
					<td align="right"><b><?php echo number_format($rowtcc[0]->Tefectivo, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtcc[0]->Tdebito, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtcc[0]->Tcredito, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtcc[0]->Talimentacion, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtcc[0]->Tcheque, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtcc[0]->Ttransferencia, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtcc[0]->Ttotal, 2, ',', '.') ?></b></td>
					<td align="center"></td>
				</tr>
				<tr bgcolor="#FF8080">
					<td align="center">T2.</td>
					<td></td>
					<td></td>
					<td></td>
					<td align="center"><b>TOTAL ANU.:</b></td>
					<td align="right"><b><?php echo number_format($rowtcca[0]->Tefectivo, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtcca[0]->Tdebito, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtcca[0]->Tcredito, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtcca[0]->Talimentacion, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtcca[0]->Tcheque, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtcca[0]->Ttransferencia, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtcca[0]->Ttotal, 2, ',', '.') ?></b></td>
					<td align="center"></td>
				</tr>
				<tr bgcolor="#80FFFF">
					<td align="center">T3.</td>
					<td></td>
					<td></td>
					<td></td>
					<td align="center"><b>TOTAL REAL:</b></td>
					<td align="right"><b><?php echo number_format($rowtccr[0]->Tefectivo, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtccr[0]->Tdebito, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtccr[0]->Tcredito, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtccr[0]->Talimentacion, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtccr[0]->Tcheque, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtccr[0]->Ttransferencia, 2, ',', '.') ?></b></td>
					<td align="right"><b><?php echo number_format($rowtccr[0]->Ttotal, 2, ',', '.') ?></b></td>
					<td align="center"></td>
				</tr>
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