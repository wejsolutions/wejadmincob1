<?php class mdetaprod {

	function __clone() {}
	function __construct() {}

	public function lista() {
		$sql = "SELECT * FROM tbl_detaprod WHERE detaprod_borrado=0 and detaprod_producto=? ORDER BY detaprod_ide DESC";
		$datos = array($_SESSION['s_deta_produc_ide']);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetaprotemp() {
		$sql = "SELECT * FROM tbl_detaprod_temp WHERE detaprod_borrado=0 and detaprod_faccom=? ORDER BY detaprod_ide DESC";
		$datos = array($_SESSION['s_compra']);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadp() {
		$sql = "SELECT * FROM tbl_detaprod WHERE detaprod_borrado=0 and detaprod_producto=16 ORDER BY detaprod_ide DESC";
		return Enlace::sql($sql,'',3,'');
	}

	public function poride($ide) {
		$sql = "SELECT * FROM tbl_detaprod WHERE detaprod_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insertdfc() {
		$sql = "SELECT sf_detaprod(?,?,?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array(0,Funciones::may($imei),Funciones::may($seri),$produc_ide,$_SESSION['s_compra'],0,1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function insertdfc_temp() {
		$sql = "SELECT sf_detaprod_temp(?,?,?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array(0,Funciones::may($imei),Funciones::may($seri),$produc_ide,$_SESSION['s_compra'],0,1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function insert() {
		$sql = "SELECT sf_detaprod(?,?,?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array(0,Funciones::may($imei),Funciones::may($seri),$produc_ide,0,0,1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function update() {
		$sql = "SELECT sf_detaprod(?,?,?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,Funciones::may($imei),'',$_SESSION['s_deta_produc_ide'],0,0,2,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function delete() {
		$sql = "SELECT sf_detaprod(?,?,?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,0,0,0,0,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'res');
	}

	public function deletetemp() {
		$sql = "SELECT sf_detaprod_temp(?,?,?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,0,0,0,0,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'res');
	}

} ?>