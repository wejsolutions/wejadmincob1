<?php require '../../../cfg/base.php'; ?>
<?php extract($_POST); ?>
<?php $row = $mreportes->librocompra($f_ini,$f_fin,$dealer) ?>
<?php $rowt = $mtienda->poride($dealer) ?>
<?php header('Content-type: application/vnd.ms-excel');
$nom_tie=str_replace(' ','',$rowt[0]->empresa_nombre);
$nombrearchivo=$nom_tie."_".date('d-m-Y',strtotime($f_ini))."_".date('d-m-Y',strtotime($f_fin));
header("Content-Disposition: attachment; filename=Libro_de_Compras_".$nombrearchivo.".xls");
header("Pragma: no-cache");
header("Expires: 0");?>
<?php if(count($row)>0): ?>
	<div class="">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th colspan="9"><h1><?php echo "Libro de Compras ".$rowt[0]->empresa_nombre; ?></h1></th>
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
					<th>Proveedor</th>
					<th>RIF</th>
					<th>Base Imponible</th>
					<th>Alicuota</th>
					<th>IVA BsF.</th>
					<th>Total</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo date('d-m-Y',strtotime($r->compra_fecha)) ?></td>
						<td><?php echo $r->compra_ide_tienda ?></td>
						<td><?php echo $r->clien_nombre1." ".$r->clien_nombre2." ".$r->clien_apelli1." ".$r->clien_apelli2 ?></td>
						<td align="center"><?php echo $r->clien_tipcli."-".$r->clien_numiden ?></td>
						<td align="right"><?php echo number_format($r->compra_sub_totalexe, 2, ',', '.') ?></td>
						<td align="center">12%</td>
						<td align="right"><?php echo number_format($r->compra_sub_totaliva, 2, ',', '.') ?></td>
						<td align="right"><?php echo number_format($r->compra_total_general, 2, ',', '.') ?></td>
						<td align="center"><?php if ($r->compra_anulada==0) { echo '<font color="#008000"> Activa </font>'; } else { echo '<font color="#FF00FF"> Anulada </font>'; } ?></td>
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