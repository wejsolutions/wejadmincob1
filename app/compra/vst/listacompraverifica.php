<?php
 $row = $mcompra->listacompraverifica();
?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Compra</th>
					<th>Factura</th>
					<th>Nota E.</th>
					<th>Fecha</th>
					<th>R.I.F.</th>
					<th>Cliente</th>
					<th>Subtotal</th>
					<th>Iva</th>
					<th>Total</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo $r->compra_ide ?></td>
						<td><?php echo $r->compra_ide_tienda ?></td>
						<td><?php echo $r->compra_control_tienda ?></td>
						<td><?php echo $r->compra_fecha ?></td>
						<td><?php echo $r->clien_tipcli.'-'.$r->clien_numiden ?></td>
						<td><?php echo $r->clien_nombre1.' '.$r->clien_nombre2.' '.$r->clien_apelli1.' '.$r->clien_apelli2 ?></td>
						<td><?php echo $r->compra_sub_totalexe ?></td>
						<td><?php echo $r->compra_sub_totaliva ?></td>
						<td><?php echo $r->compra_total_general ?></td>
						<td align="center">
						<?php if ($r->compra_anulada==0){ ?>
							<div class="btn-group">
								<button class="btn btn-warning btn-xs" title="Ver Detalles" onclick="modal('vst-compra-admindetacompra','ide=<?php echo $r->compra_ide ?>')">
									<i class="fa fa-search"></i>
								</button>
							</div>
						<?php } else { echo "<< SI >>"; }?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-info">No hay registro de compra para mostrar.</div>
<?php endif; ?>	
<script>
	$(function(){
		$('.table').dataTable();
	})
</script>