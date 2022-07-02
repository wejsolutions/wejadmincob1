<?php require '../../../cfg/base.php'; 
$row_fich = $mpermfich->poride($fich_ide);
?>
<div class="clearfix"></div>
<div class="col-sm-6 informes-operation"></div>
<div class="col-sm-6 historico-informes"></div>
<div class="clearfix"></div>

<script type="text/javascript">
	load('vst-informes-insert','fich_ide=<?php echo $fich_ide ?>&paci_ide=<?php echo $paci_ide ?>','.informes-operation');
	load('vst-informes-historico','fich_ide=<?php echo $fich_ide ?>&paci_ide=<?php echo $paci_ide ?>','.historico-informes');
</script>