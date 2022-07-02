<?php require '../../../cfg/base.php'; 
$row = $mproducto->poride($produc_ide);
$_SESSION['s_deta_produc_ide'] = $row[0]->produc_ide;
?>
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th class="active text-right" width="10%">Producto:</th>
					<td width="45%">
						<div class="col-sm-9">
							<input type="text" class="form-control" id="buscarproducto" name="produc">
						</div>
						<div class="col-sm-3">
							<button class="btn btn-primary btn-sm"><i class="fa fa-sign-out"></i></button>
							<button type="button" onclick="location.reload()" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i></button>
						</div>
					</td>
					<th class="active text-right" width="10%">Cant.:</th>
					<td width="10%"><input type="number" name="cant" min="0" max="<?php echo $row[0]->produc_existen ?>" class="form-control"></td>
					<th class="active text-right" width="10%">Precio:</th>
					<td width="15%">
						<div class="form-group col-sm-9">
							<select class="form-control chosen" name="precio" id="precio">
								<option value="<?php echo $row[0]->produc_precio1 ?>"><?php echo $row[0]->produc_precio1 ?></option>
								<option value="<?php echo $row[0]->produc_precio2 ?>"><?php echo $row[0]->produc_precio2 ?></option>
								<option value="<?php echo $row[0]->produc_precio3 ?>"><?php echo $row[0]->produc_precio3 ?></option>
								<option value="<?php echo $row[0]->produc_precio4 ?>"><?php echo $row[0]->produc_precio4 ?></option>
							</select>
						</div>
						<div class="form-group col-sm-1">
							<button type="button" class="btn btn-primary btn-sm" onclick="load('vst-producto-update','produc_ide=<?php echo $row[0]->produc_ide ?>','.perfil')"><i class="fa fa-download"></i></button>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="space-6"></div>
	<script>
		load('vst-facturacion10-detafactu','','.detafactu');
	</script>