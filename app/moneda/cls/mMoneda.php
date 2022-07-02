<?php class mMoneda {

	function __clone() {}
	function __construct() {}

	public function lista() {
		$sql = "SELECT * FROM tbl_moneda WHERE moneda_borrado=0 ORDER BY moneda_ide ASC";
		return Enlace::sql($sql,'',3,'');
	}

	public function poride($ide) {
		$sql = "SELECT * FROM tbl_moneda WHERE moneda_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insert() {
		$sql = "SELECT sf_moneda(?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array(0,Funciones::may($des),Funciones::may($abr),$monope,1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function delete() {
		$sql = "SELECT sf_moneda(?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,0,0,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'res');
	}

	public function listamonedavalor($ide) {
		$sql = "SELECT * FROM vw_moneda_tasa WHERE monval_moneda_ide=? AND monval_borrado=0 ORDER BY monval_ide DESC limit 5 ";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poridemoneda($ide) {
		$sql = "SELECT * FROM vw_moneda_tasa WHERE monval_moneda_ide=? ORDER BY monval_ide DESC limit 1";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insertmonedavalor() {
		$sql = "SELECT sf_moneda_tasa(?,?,?,?,?) AS res";
		extract($_POST); $datos = array(0,$mon,$tas,1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}
} ?>