<?php 
require '../../../cfg/base.php';
$row = $mcompra->poridecompra($ide);
?>
		<div class="col-sm-12">
				<table class="table-bordered">
					<tr>
						<th class="active text-right">Factura:</th>
						<td><?php echo $row[0]->compra_ide_tienda ?></td>
						<th class="active text-right">Nota Entrega:</th>
						<td><?php echo $row[0]->compra_control_tienda ?></td>
					</tr>
					<tr>
						<th class="active text-right">Fecha de Compra:</th>
						<td><?php echo date('d-m-Y',strtotime($row[0]->compra_fecha)); ?></td>
						<th class="active text-right">Fecha de Registro:</th>
						<td><?php echo date('d-m-Y',strtotime($row[0]->compra_fecha_registro)); ?></td>
					</tr>
					<tr>
						<th class="active text-right">ID Proveedor:</th>
						<td><?php echo $row[0]->clien_tipcli.'-'.$row[0]->clien_numiden ?></td>
						<th class="active text-right">Nombre:</th>
						<td><?php echo $row[0]->clien_apelli1.' '.$row[0]->clien_apelli2.', '.$row[0]->clien_nombre1.' '.$row[0]->clien_nombre2; ?></td>
					</tr>
					<tr>
						<th class="active text-right">Sub-Total:</th>
						<td><?php echo $row[0]->compra_sub_totalexe ?></td>
						<th class="active text-right">Impuesto:</th>
						<td><?php echo $row[0]->compra_sub_totaliva; ?></td>
					</tr>
					<tr>
						<th class="active text-right"></th>
						<td></td>
						<th class="active text-right">Total:</th>
						<td><?php echo $row[0]->compra_total_general; ?></td>
					</tr>
				</table>
		</div>