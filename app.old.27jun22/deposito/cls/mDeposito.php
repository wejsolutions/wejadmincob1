<?php class mDeposito {

	function __clone() {}
	function __construct() {}

	public function lista() {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM vw_deposito WHERE deposito_borrado=0 ORDER BY deposito_ide DESC";
		} else {
			$sql = "SELECT * FROM vw_deposito WHERE deposito_borrado=0 and deposito_tienda=".$_SESSION['s_usua_tienda']." ORDER BY deposito_ide";
		}
		return Enlace::sql($sql,'',3,'');
	}

	public function poride($ide) {
		$sql = "SELECT * FROM vw_deposito WHERE deposito_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insert() {
		$sql = "SELECT sf_deposito(?,?,?,?,?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array(0,$ban,$ncu,$num,$mon,date('Y-m-d',strtotime($fde)),date('Y-m-d',strtotime($fdv)),$_SESSION['s_usua_tienda'],1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function update() {
		$sql = "SELECT sf_deposito(?,?,?,?,?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,$ban,$ncu,$num,$mon,date('Y-m-d',strtotime($fde)),date('Y-m-d',strtotime($fdv)),$_SESSION['s_usua_tienda'],2,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function delete() {
		$sql = "SELECT sf_deposito(?,?,?,?,?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,0,0,0,0,0000-00-00,0000-00-00,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'res');
	}
} ?>