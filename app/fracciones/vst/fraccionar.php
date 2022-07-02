<?php require '../../../cfg/base.php'; ?>

<?php extract($_POST); ?>
<?php 

$row = $mfracciones->getCuotasPorCobrar($f_ini,$_POST['f_fin']); 

$contador=0;
foreach($row as $r): 
    $contador++;
	$mtoporfraccion=0;
	$ide_de_la_cuota = $r->cuota_ide;

	$row_contrato= $mfracciones->getCedulaContrato($r->cuota_cnt_ide);
	$ced="";
	foreach($row_contrato as $c): 
		//echo "<br>mostrando cedula:";
		$ced=$c->Cedula;
		//var_dump($ced);
	endforeach; 

	$cuenta_contrato="";
	$row_cuenta=$mfracciones->getCuentaContrato($r->cuota_cnt_ide);
	foreach($row_cuenta as $c): 
		$cta=$c->cuenta;
	endforeach; 


	
	$row_fracc=$mfracciones->porcuota_ide($ide_de_la_cuota);
	$cantidad=count($row_fracc);
	//var_dump($cantidad);
    if(count($row_fracc)>0): 
		echo "<br>La cuota ".$ide_de_la_cuota. " ya tiene fracciones<br> ";    	
    else:
    	
		$cantidad_de_fracciones=$r->cuota_cant_fracc;

			if ($r->cuota_cant_fracc>0){
				$mtoporfraccion=($r->cuota_monto/$r->cuota_cant_fracc);  
	    		/*$cta="01750001540000124681";	*/
	    
			}
			for ($i=1; $i<=$cantidad_de_fracciones;$i++ ){
	    		$res = $mfracciones->insertFraccion($r->cuota_ide,$cta,$ced,$mtoporfraccion,0);		

			}     	
    endif;

endforeach; 
?>
<?php $row_fracc = $mfracciones->lista(); 

?>
<div width="90%">
<label for="" class="label control-label col-sm-12 bolder"  >Fracciones</label>	
</div>
<?php if(count($row_fracc)>0): ?>
<div>
	<div class="table-responsive">
		<table class="tableF2 table-hover table-bordered" width="100%">
			<thead>
				<tr>
					<th align="center"  width="10%">Cuota</th>
					<th align="center"  width="20%">Cuenta</th>
					<th align="center"  width="20%">Cedula</th>
					<th align="center"  width="20%">Monto</th>
					<th align="center"  width="10%">Estatus Fracción</th>				
					<th align="center"  width="10%">Opcion</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row_fracc as $p): ?>
					<tr> 
					
						<td align="right" ><?php echo $p->cuota ?></td>
						<td align="right" ><?php echo $p->cuenta ?></td>
						<td align="right" ><?php echo $p->cedula ?></td>
						<td align="right" ><?php echo $p->monto ?></td>
						<td align="right" ><?php echo $p->estatus ?></td>					

						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Fraccionar" onclick="modal('vst-fracciones-fraccionar','ide=<?php echo $r->banco_ide ?>')">
									<i class="fa fa-edit"></i>
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
</div>
<script>
	$(function(){
		$('.tableF2').dataTable();
	})
</script>