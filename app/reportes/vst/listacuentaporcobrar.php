<?php
 $row = $mreportes->listacuentasporcobrar();
?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Factura</th>
					<th>Monto</th>
					<th>Ver detalle</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo $r->fact_fecha ?></td>
						<td><?php echo $r->clien_tipcli.'-'.$r->clien_numiden.' '.$r->clien_nombre1.' '.$r->clien_nombre2.' '.$r->clien_apelli1.' '.$r->clien_apelli2; ?></td>
						<td><?php echo $r->fact_ide_tienda ?></td>
						<td><b><?php echo $r->fact_monto_deuda ?></b></td>
						<td align="center">
							<div class="btn-group">
								<button <?php if ($r->fact_anulada==1) { echo 'disabled'; } ?> class="btn btn-success btn-xs" title="Ver detalle de factura" onclick="window.open('reimprimirfactura-'+<?php echo $r->fact_ide ?>)">
									<i class="fa fa-print"></i>
								</button>
							</div>
						</td>
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