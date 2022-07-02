<?php require '../../../cfg/base.php'; 
$row = $mproducto->poride($produc_ide);
$row_fich = $mpermfich->poride(2);
$_SESSION['s_deta_produc_ide'] = $row[0]->produc_ide;
?>
<div class="col-sm-12 widget-container-span ui-sortable" id="ficha-<?php echo $row_fich[0]->fich_ide ?>-link">
	<div class="widget-box revival">
		<div class="widget-header widget-hea1der-small header-color-dark">
			<h6 class="bolder"><i class="fa fa-<?php echo $row_fich[0]->fich_icono; ?>"></i> <?php echo $row_fich[0]->fich_descrip; ?></h6>
			<div class="widget-toolbar">
				<a href="#" data-action="reload" onclick="load('<?php echo $row_fich[0]->fich_url ?>','fich_ide=<?php echo $row_fich[0]->fich_ide ?>&produc_ide=<?php echo $produc_ide ?>','#ficha-<?php echo $row_fich[0]->fich_ide ?>');">
					<i class="icon-refresh"></i>
				</a>
				<a href="#" data-action="collapse">
					<i class="icon-chevron-up"></i>
				</a>						
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main">
				<div class="col-sm-2">
					<span class="profile-picture">
						<img id="avatar" class="editable img-responsive editable-click editable-empty" alt="" src="<?php echo $cproducto->picture($produc_ide).'?'.rand(1,1000) ?>" onclick="modal('vst-producto-foto.cargar','produc_ide=<?php echo $row[0]->produc_ide ?>')">
					</span>
				</div>
				<div class="col-sm-10">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th class="active text-right" width="25%">ID:</th>
								<td width="25%"><?php echo $row[0]->produc_ide ?></td>
								<th class="active text-right" width="25%">Descripción del Producto o Servicio:</th>
								<td width="25%"><?php echo $row[0]->produc_descrip ?></td>
							</tr>
							<tr>
								<th class="active text-right">Existencia:</th>
								<td><?php echo $row[0]->produc_existen ?></td>
								<th class="active text-right">Costo:</th>
								<td><?php echo $row[0]->produc_costo ?></td>
							</tr>
							<tr>
								<th class="active text-right">Precio 1:</th>
								<td><?php echo $row[0]->produc_precio1 ?></td>
								<th class="active text-right">Precio 2:</th>
								<td><?php echo $row[0]->produc_precio2 ?></td>
							</tr>
							<tr>
								<th class="active text-right">Precio 3:</th>
								<td><?php echo $row[0]->produc_precio3 ?></td>
								<th class="active text-right">Precio 4:</th>
								<td><?php echo $row[0]->produc_precio4 ?></td>
							</tr>
							<tr>
								<th class="active text-right">Color:</th>
								<td><?php echo $row[0]->produc_color ?></td>
								<th class="active text-right">Talla:</th>
								<td><?php echo $row[0]->produc_talla ?></td>
							</tr>
							<tr>
								<th class="active text-right">Unid. Medida:</th>
								<td><?php echo $row[0]->produc_unidmed ?></td>
								<th class="active text-right">Medida:</th>
								<td><?php echo $row[0]->produc_medida ?></td>
							</tr>
							<tr>
								<th class="active text-right">Marca:</th>
								<td><?php echo $row[0]->produc_marca ?></td>
								<th class="active text-right">Modelo:</th>
								<td><?php echo $row[0]->produc_modelo ?></td>
							</tr>
							<tr>
								<th class="active text-right">Impuesto:</th>
								<td><?php echo $row[0]->produc_impuesto ?></td>
								<th class="active text-right">Servicio:</th>
								<td><?php if ($row[0]->produc_servicio==0) echo 'No'; else echo 'Si'; ?></td>
							</tr>
							<tr>
								<th class="active text-right">Observacion:</th>
								<td colspan="3"><?php echo $row[0]->produc_observa ?></td>
							</tr>
						</table>
					</div>
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-primary" onclick="load('vst-producto-update','produc_ide=<?php echo $row[0]->produc_ide ?>','.perfil')"><i class="fa fa-edit"></i> Editar Datos</button>
						<!--<button type="button" class="btn btn-purple" onclick="load('vst-producto-','produc_ide=<?php echo $row[0]->produc_ide ?>','.perfil')"><i class="fa fa-info"></i> Ver Detalles</button>-->
						<button type="button" class="btn btn-danger" onclick="modal('vst-producto-delete','produc_ide=<?php echo $row[0]->produc_ide ?>')"><i class="fa fa-trash"></i> Borrar</button>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="space-10"></div>
				<div class="insertar"></div>
				<div class="clearfix"></div>
				<div class="space-6"></div>
				<div class="lista"></div>
			<script>
				load('vst-detaprod-insert','','.insertar');
				load('vst-detaprod-lista','','.lista');
			</script>
			</div>
		</div>
	</div>
</div>
