<?php class mImpuesto {

	function __clone() {}
	function __construct() {}

	public function lista() {
		$sql = "SELECT * FROM vw_impuesto WHERE impuesto_borrado=0 ORDER BY impuesto_ide DESC";
		return Enlace::sql($sql,'',3,'');
	}

	public function poride($ide) {
		$sql = "SELECT * FROM vw_impuesto WHERE impuesto_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insert() {
		$sql = "SELECT sf_impuesto(?,?,?,?) AS res";
		extract($_POST); $datos = array(0,$des,1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function update() {
		$sql = "SELECT sf_impuesto(?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,$des,2,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function delete() {
		$sql = "SELECT sf_impuesto(?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'res');
	}
} ?>