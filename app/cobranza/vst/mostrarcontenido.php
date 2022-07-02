<?php require '../../../cfg/base.php';
	$fn = new Funciones();
	extract($_POST); 
	$encabezado="Contenido del Archivo NOML015 de fecha: $fec y número de Control: $con";
	echo $fn->modalWidth('80%');
	echo $fn->modalHeader($encabezado);
	$rowtc = $mcobranza->totalregcob($con);
	$rowtnc = $mcobranza->totalregnocob($con);
?>
<div class="modal-body">
	<div class="col-sm-4">
		<div class="col-sm-8 bolder">Bolívares Cobrados:</div>
		<div class="col-sm-4 bolder" align="right"><?php echo number_format($rowtc[0]->sumregcob - $rowtnc[0]->sumregcob,2,",",".") ?></div>
	</div>
	
	<div class="col-sm-4 red">
		<div class="col-sm-8 bolder">Bolívares NO Cobrados:</div>
		<div class="col-sm-4 bolder" align="right"><?php echo number_format($rowtnc[0]->sumregcob,2,",",".") ?></div>
	</div>
	<div class="col-sm-4">
		<div class="col-sm-8 bolder">Fecha Nómina:</div>
		<div class="col-sm-4 bolder" align="right"><?php echo $fen ?></div>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
		<div class="col-sm-8 bolder">Fracciones Cobradas:</div>
		<div class="col-sm-4 bolder" align="right"><?php echo number_format($arc,0,",",".") ?></div>
	</div>
	<div class="col-sm-4 red">
		<div class="col-sm-8 bolder">Fracciones Fallidas:</div>
		<div class="col-sm-4 bolder" align="right"><?php echo number_format($arf,0,",",".") ?></div>
	</div>
	<div class="col-sm-4">
		<div class="col-sm-8 bolder">Fracciones Totales:</div>
		<div class="col-sm-4 bolder" align="right"><?php echo number_format($tor,0,",",".") ?></div>
	</div>
	<div class="clearfix"></div>
	<div class="table-responsive">
		<table class="table10 table-hover table-bordered" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Cuenta</th>
					<th>Monto</th>
					<th>Nombre</th>
					<th>Cédula</th>
					<th>Observación</th>
				</tr>
			</thead>
			<tbody>
				<?php $row = $mcobranza->porconregcob($con); 
				foreach($row as $r): 
					$color="";
					if (strlen($r->regcob_observacion)>0) { $color="red"; } ?>
					<tr>
						<td width="6%" align="center"><font color="<?php echo $color; ?>"><?php echo $r->regcob_ide ?></font></td>
						<td width="17%"><font color="<?php echo $color; ?>"><?php echo $r->regcob_cuenta ?></font></td>
						<td width="12%" align="right"><font color="<?php echo $color; ?>"><?php echo $r->regcob_monto ?></font></td>
						<td width="27%"><font color="<?php echo $color; ?>"><?php echo $r->regcob_nombre ?></font></td>
						<td width="8%" align="right"><font color="<?php echo $color; ?>"><?php echo $r->regcob_cedula ?></font></td>
						<td width="30%"><font color="<?php echo $color; ?>"><?php echo $r->regcob_observacion ?></font></td>
					</tr>
				<?php endforeach; ?>
			<tbody>
		</table>
	</div>
</div>
<?php echo $fn->modalFooter(2); ?>
<script>
	$(function(){
		$('.table10').dataTable();
	})
</script>