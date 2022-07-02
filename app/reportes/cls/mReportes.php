<?php class mReportes {

	function __clone() {}
	function __construct() {}

	public function detalibroventa($factura) {
		$sql = "SELECT * FROM vw_deta_libro_venta WHERE factura=".$factura;
		return Enlace::sql($sql,'',3,'');
	}

	public function cuadrecaja($f_ini,$f_fin,$dealer) {
		extract($_POST);
		if ($_SESSION['s_usua_tienda']==4) {
			if ($dealer==4){
				$sql = "SELECT * FROM vw_cuadre_caja WHERE date(fecha) between '".$f_ini."' and '".$f_fin."' ORDER BY ide";
			}else{
				$sql = "SELECT * FROM vw_cuadre_caja WHERE (date(fecha) between '".$f_ini."' and '".$f_fin."') and tienda=".$dealer." ORDER BY ide";
			}
		} else {
			$sql = "SELECT * FROM vw_cuadre_caja WHERE (date(fecha) between '".$f_ini."' and '".$f_fin."') and tienda=".$_SESSION['s_usua_tienda']." ORDER BY ide";
		}
		return Enlace::sql($sql,'',3,'');
	}

	public function totalcuadrecaja($f_ini,$f_fin,$dealer) {
		if ($_SESSION['s_usua_tienda']==4) {
			if ($dealer==4){
				$sql = "SELECT Sum(vw_cuadre_caja.efectivo) AS Tefectivo, Sum(vw_cuadre_caja.debito) AS Tdebito, Sum(vw_cuadre_caja.credito) AS Tcredito, Sum(vw_cuadre_caja.alimentacion) AS Talimentacion, Sum(vw_cuadre_caja.cheque) AS Tcheque, Sum(vw_cuadre_caja.transferencia) AS Ttransferencia, Sum(vw_cuadre_caja.total) AS Ttotal FROM vw_cuadre_caja WHERE (date(vw_cuadre_caja.fecha) between '".$f_ini."' and '".$f_fin."')";
			}else{
				$sql = "SELECT Sum(vw_cuadre_caja.efectivo) AS Tefectivo, Sum(vw_cuadre_caja.debito) AS Tdebito, Sum(vw_cuadre_caja.credito) AS Tcredito, Sum(vw_cuadre_caja.alimentacion) AS Talimentacion, Sum(vw_cuadre_caja.cheque) AS Tcheque, Sum(vw_cuadre_caja.transferencia) AS Ttransferencia, Sum(vw_cuadre_caja.total) AS Ttotal FROM vw_cuadre_caja WHERE (date(vw_cuadre_caja.fecha) between '".$f_ini."' and '".$f_fin."') and vw_cuadre_caja.tienda=".$dealer;
			}
		} else {
			$sql = "SELECT Sum(vw_cuadre_caja.efectivo) AS Tefectivo, Sum(vw_cuadre_caja.debito) AS Tdebito, Sum(vw_cuadre_caja.credito) AS Tcredito, Sum(vw_cuadre_caja.alimentacion) AS Talimentacion, Sum(vw_cuadre_caja.cheque) AS Tcheque, Sum(vw_cuadre_caja.transferencia) AS Ttransferencia, Sum(vw_cuadre_caja.total) AS Ttotal FROM vw_cuadre_caja WHERE (date(vw_cuadre_caja.fecha) between '".$f_ini."' and '".$f_fin."') and vw_cuadre_caja.tienda=".$_SESSION['s_usua_tienda'];
		}
		return Enlace::sql($sql,'',3,'');
	}

	public function totalcuadrecajaanulada($f_ini,$f_fin,$dealer) {
		if ($_SESSION['s_usua_tienda']==4) {
			if ($dealer==4){
				$sql = "SELECT Sum(vw_cuadre_caja.efectivo) AS Tefectivo, Sum(vw_cuadre_caja.debito) AS Tdebito, Sum(vw_cuadre_caja.credito) AS Tcredito, Sum(vw_cuadre_caja.alimentacion) AS Talimentacion, Sum(vw_cuadre_caja.cheque) AS Tcheque, Sum(vw_cuadre_caja.transferencia) AS Ttransferencia, Sum(vw_cuadre_caja.total) AS Ttotal FROM vw_cuadre_caja WHERE (date(vw_cuadre_caja.fecha) between '".$f_ini."' and '".$f_fin."') and vw_cuadre_caja.anulada=1";
			}else{
				$sql = "SELECT Sum(vw_cuadre_caja.efectivo) AS Tefectivo, Sum(vw_cuadre_caja.debito) AS Tdebito, Sum(vw_cuadre_caja.credito) AS Tcredito, Sum(vw_cuadre_caja.alimentacion) AS Talimentacion, Sum(vw_cuadre_caja.cheque) AS Tcheque, Sum(vw_cuadre_caja.transferencia) AS Ttransferencia, Sum(vw_cuadre_caja.total) AS Ttotal FROM vw_cuadre_caja WHERE (date(vw_cuadre_caja.fecha) between '".$f_ini."' and '".$f_fin."') and vw_cuadre_caja.anulada=1 and vw_cuadre_caja.tienda=".$dealer;
			}
		} else {
			$sql = "SELECT Sum(vw_cuadre_caja.efectivo) AS Tefectivo, Sum(vw_cuadre_caja.debito) AS Tdebito, Sum(vw_cuadre_caja.credito) AS Tcredito, Sum(vw_cuadre_caja.alimentacion) AS Talimentacion, Sum(vw_cuadre_caja.cheque) AS Tcheque, Sum(vw_cuadre_caja.transferencia) AS Ttransferencia, Sum(vw_cuadre_caja.total) AS Ttotal FROM vw_cuadre_caja WHERE (date(vw_cuadre_caja.fecha) between '".$f_ini."' and '".$f_fin."') and vw_cuadre_caja.anulada=1 and vw_cuadre_caja.tienda=".$_SESSION['s_usua_tienda'];
		}
		return Enlace::sql($sql,'',3,'');
	}

	public function totalcuadrecajareal($f_ini,$f_fin,$dealer) {
		if ($_SESSION['s_usua_tienda']==4) {
			if ($dealer==4){
				$sql = "SELECT Sum(vw_cuadre_caja.efectivo) AS Tefectivo, Sum(vw_cuadre_caja.debito) AS Tdebito, Sum(vw_cuadre_caja.credito) AS Tcredito, Sum(vw_cuadre_caja.alimentacion) AS Talimentacion, Sum(vw_cuadre_caja.cheque) AS Tcheque, Sum(vw_cuadre_caja.transferencia) AS Ttransferencia, Sum(vw_cuadre_caja.total) AS Ttotal FROM vw_cuadre_caja WHERE (date(vw_cuadre_caja.fecha) between '".$f_ini."' and '".$f_fin."') and vw_cuadre_caja.anulada=0";
			}else{
				$sql = "SELECT Sum(vw_cuadre_caja.efectivo) AS Tefectivo, Sum(vw_cuadre_caja.debito) AS Tdebito, Sum(vw_cuadre_caja.credito) AS Tcredito, Sum(vw_cuadre_caja.alimentacion) AS Talimentacion, Sum(vw_cuadre_caja.cheque) AS Tcheque, Sum(vw_cuadre_caja.transferencia) AS Ttransferencia, Sum(vw_cuadre_caja.total) AS Ttotal FROM vw_cuadre_caja WHERE (date(vw_cuadre_caja.fecha) between '".$f_ini."' and '".$f_fin."') and vw_cuadre_caja.anulada=0 and vw_cuadre_caja.tienda=".$dealer;
			}
		} else {
			$sql = "SELECT Sum(vw_cuadre_caja.efectivo) AS Tefectivo, Sum(vw_cuadre_caja.debito) AS Tdebito, Sum(vw_cuadre_caja.credito) AS Tcredito, Sum(vw_cuadre_caja.alimentacion) AS Talimentacion, Sum(vw_cuadre_caja.cheque) AS Tcheque, Sum(vw_cuadre_caja.transferencia) AS Ttransferencia, Sum(vw_cuadre_caja.total) AS Ttotal FROM vw_cuadre_caja WHERE (date(vw_cuadre_caja.fecha) between '".$f_ini."' and '".$f_fin."') and vw_cuadre_caja.anulada=0 and vw_cuadre_caja.tienda=".$_SESSION['s_usua_tienda'];
		}
		return Enlace::sql($sql,'',3,'');
	}

	public function librocompra($f_ini,$f_fin,$dealer) {
		extract($_POST);
		if ($_SESSION['s_usua_tienda']==4) {
			if ($dealer==4){
				$sql = "SELECT * FROM vw_compra_lista WHERE date(compra_fecha) between '".$f_ini."' and '".$f_fin."' ORDER BY compra_ide";
			}else{
				$sql = "SELECT * FROM vw_compra_lista WHERE (date(compra_fecha) between '".$f_ini."' and '".$f_fin."') and compra_tienda=".$dealer." ORDER BY compra_ide";
			}
		} else {
			$sql = "SELECT * FROM vw_compra_lista WHERE (date(compra_fecha) between '".$f_ini."' and '".$f_fin."') and compra_tienda=".$_SESSION['s_usua_tienda']." ORDER BY compra_ide";
		}
		return Enlace::sql($sql,'',3,'');
	}

	public function listacuentasporcobrar() {
		$sql = "SELECT * FROM vw_factura WHERE fact_forpag=1 AND fact_pago_deuda=0 ORDER BY fact_fecha ASC";
		$datos = array(0);
		return Enlace::sql($sql,$datos,3,'');
	}

} ?>