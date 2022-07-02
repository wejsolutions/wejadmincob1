<?php class mProducto {

	function __clone() {}
	function __construct() {}

	public function lista() {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM vw_producto WHERE produc_tienda>? ORDER BY produc_descrip ASC";
			$datos = array(0);
		} else {
			$sql = "SELECT * FROM vw_producto WHERE produc_tienda=? ORDER BY produc_descrip ASC";
			$datos = array($_SESSION['s_usua_tienda']);
		}
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listapro() {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM vw_producto WHERE produc_tienda>? and produc_servicio=0 ORDER BY produc_descrip ASC";
			$datos = array(0);
		} else {
			$sql = "SELECT * FROM vw_producto WHERE produc_tienda=? and produc_servicio=0 ORDER BY produc_descrip ASC";
			$datos = array($_SESSION['s_usua_tienda']);
		}
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listapre() {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM vw_producto WHERE produc_tienda>? ORDER BY produc_descrip ASC";
			$datos = array(0);
		} else {
			$sql = "SELECT * FROM vw_producto WHERE produc_tienda=? ORDER BY produc_descrip ASC";
			$datos = array($_SESSION['s_usua_tienda']);
		}
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listaprostock() {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM vw_producto WHERE produc_tienda>? and produc_servicio=0 and produc_existen <= produc_stock ORDER BY produc_descrip ASC";
			$datos = array(0);
		} else {
			$sql = "SELECT * FROM vw_producto WHERE produc_tienda=? and produc_servicio=0  and produc_existen <= produc_stock ORDER BY produc_descrip ASC";
			$datos = array($_SESSION['s_usua_tienda']);
		}
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listaser() {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM vw_producto WHERE produc_tienda>? and produc_servicio=1 ORDER BY produc_descrip ASC";
			$datos = array(0);
		} else {
			$sql = "SELECT * FROM vw_producto WHERE produc_tienda=? and produc_servicio=1 ORDER BY produc_descrip ASC";
			$datos = array($_SESSION['s_usua_tienda']);
		}
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listapd() {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM vw_producto_deta WHERE (produc_tienda>?) and (produc_existen>0 and (detaprod_borrado=0 or isnull (detaprod_borrado))) ORDER BY produc_descrip ASC";
			$datos = array(0);
		} else {
			$sql = "SELECT * FROM vw_producto_deta WHERE (produc_tienda=?) and (produc_existen>0 and (detaprod_borrado=0 or isnull (detaprod_borrado))) ORDER BY produc_descrip ASC";
			$datos = array($_SESSION['s_usua_tienda']);
		}
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listasinide($ide) {
		$sql = "SELECT * FROM vw_producto WHERE produc_ide<>? ORDER BY produc_descrip ASC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function kardex() {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM vw_kardex WHERE produc_tienda>? ORDER BY produc_descrip ASC";
			$datos = array(0);
		} else {
			$sql = "SELECT * FROM vw_kardex WHERE produc_tienda=? ORDER BY produc_descrip ASC";
			$datos = array($_SESSION['s_usua_tienda']);
		}
		return Enlace::sql($sql,$datos,3,'');
	}

	public function kardexmensualresu($anomes) {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM vw_kardex_mensual_resumen WHERE produc_tienda>? AND anomes=? ORDER BY produc_descrip ASC";
			$datos = array(0,$anomes);
		} else {
			$sql = "SELECT * FROM vw_kardex_mensual_resumen WHERE produc_tienda=? AND anomes=? ORDER BY produc_descrip ASC";
			$datos = array($_SESSION['s_usua_tienda'],$anomes);
		}
		return Enlace::sql($sql,$datos,3,'');
	}

	public function kardexmensual($anomes,$proide,$tipo) {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM vw_kardex_mensual WHERE produc_tienda>? AND anomes=? AND produc_ide=? AND kardex_tipo=? ORDER BY produc_descrip ASC";
			$datos = array(0,$anomes,$proide,$tipo);
		} else {
			$sql = "SELECT * FROM vw_kardex_mensual WHERE produc_tienda=? AND anomes=? AND produc_ide=? AND kardex_tipo=? ORDER BY produc_descrip ASC";
			$datos = array($_SESSION['s_usua_tienda'],$anomes,$proide,$tipo);
		}
		return Enlace::sql($sql,$datos,3,'');
	}

	public function kardexmensualporproducto($anomes,$proide) {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM vw_kardex_mensual WHERE produc_tienda>? AND anomes=? AND produc_ide=? ORDER BY kardex_ide ASC";
			$datos = array(0,$anomes,$proide);
		} else {
			$sql = "SELECT * FROM vw_kardex_mensual WHERE produc_tienda=? AND anomes=? AND produc_ide=? ORDER BY kardex_ide ASC";
			$datos = array($_SESSION['s_usua_tienda'],$anomes,$proide);
		}
		return Enlace::sql($sql,$datos,3,'');
	}

	public function kardexretiro() {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM vw_kardex WHERE produc_tienda>? AND (kardex_tipo=5 OR kardex_tipo=6) AND kardex_borrado=0 ORDER BY produc_descrip ASC";
			$datos = array(0);
		} else {
			$sql = "SELECT * FROM vw_kardex WHERE produc_tienda=? AND (kardex_tipo=5 OR kardex_tipo=6) AND kardex_borrado=0 ORDER BY produc_descrip ASC";
			$datos = array($_SESSION['s_usua_tienda']);
		}
		return Enlace::sql($sql,$datos,3,'');
	}

	public function kardexporide($ide) {
		$sql = "SELECT * FROM vw_kardex WHERE kardex_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function kardexinsertretiro() {
		extract($_POST);
		$sql = "SELECT sf_facturadeta(?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			0, // Identificador
			$obs,
			$pro,
			0,
			$can,
			0,
			0,
			0,
			0,
			0,
			$tip, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function kardexdeleteretiro() {
		extract($_POST);
		$sql = "SELECT sf_facturadeta(?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			$ide, // Identificador
			'',
			$pro,
			0,
			$can,
			0,
			0,
			0,
			0,
			0,
			$tip, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function preciounitarioventa($anomes,$proide) {
		$sql = "SELECT * FROM vw_precio_unitario_venta WHERE anomes=? AND factdeta_produc=? ORDER BY fact_ide_tienda DESC";
		$datos = array($anomes,$proide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function preciounitarioventa1($anomes,$proide) {
		$sql = "SELECT * FROM vw_precio_unitario_venta1 WHERE anomes=? AND kardex_producto=? ";
		$datos = array($anomes,$proide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poride($ide) {
		$sql = "SELECT * FROM vw_producto WHERE produc_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poride1($ide) {
		$sql = "SELECT * FROM tbl_producto WHERE produc_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poride2($ide) {
		$sql = "SELECT * FROM vw_producto_deta WHERE detaprod_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insert() {
		extract($_POST);
		if ($_SESSION['s_usua_tienda']!=4) {$tie=$_SESSION['s_usua_tienda'];}
		$sql = "SELECT sf_producto(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			0, // Identificador
			$cod,
			Funciones::may($des),
			$exi,
			$cos,
			$pre1,
			$pre2,
			0,//$pre3,
			0,//$pre4,
			'N/A',//$col,
			0,//$tal,
			$unm,
			0,//$med,
			$mar,
			1,//$mod,
			$imp,
			$ser,
			0,//$pse,
			null,
			$tie,
			$sto,
			0,//$valdol
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function insertRapido() {
		extract($_POST);
		$nom2  = null;
		$ape2  = null;
		$fnac  = null;
		$dir   = null;
		$mov   = null;
		$corre = null;


		$sql = "SELECT sf_producto(?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			0,
			$tipcli,
			$ced,
			Funciones::may($nom1),
			Funciones::may($nom2),
			Funciones::may($ape1),
			Funciones::may($ape2),
			date('Y-m-d',strtotime($fnac)),
			Funciones::may($dir),
			$mov,
			Funciones::may($corre),
			4,
			$_SESSION['s_clien_ide']
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function update() {
		extract($_POST);
		if ($_SESSION['s_usua_tienda']!=4) {$tie=$_SESSION['s_usua_tienda'];}
		$sql = "SELECT sf_producto(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			$ide, // Identificador
			$cod,
			Funciones::may($des),
			$exi,
			$cos,
			$pre1,
			$pre2,
			0,//$pre3,
			0,//$pre4,
			'N/A',//$col,
			0,//$tal,
			$unm,
			0,//$med,
			$mar,
			1,//$mod,
			$imp,
			$ser,
			0,//$pse,
			null,
			$tie,
			$sto,
			0,//$valdol
			2, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function delete() {
		extract($_POST);
		$sql = "SELECT sf_producto(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array($ide,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}


} ?>