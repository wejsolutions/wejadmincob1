<?php class mClientecuenta {

	function __clone() {}
	function __construct() {}

	public function lista() {
		$sql = "SELECT * FROM tbl_cliente_cuenta  ORDER BY ctecue_ide DESC";
		return Enlace::sql($sql,'',3,'');
	}

	public function cuentas_poride($ide) { 
		$sql = "SELECT * FROM vw_clientecuenta WHERE ctecue_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function cuentas_por_clien_ide($clien_ide) { 
		$sql = "SELECT * FROM vw_clientecuenta WHERE ctecue_clien_ide=? AND ctecue_borrado=0";
		$datos = array($clien_ide);
		return Enlace::sql($sql,$datos,3,'');
	}


	public function update_cuenta() {
		$sql = "SELECT sf_clientecuenta(?,?,?,?,?,?) AS res";
		extract($_POST);$datos = array($ide,0,0,$cta,2,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function insert() {
		$sql = "SELECT sf_clientecuenta(?,?,?,?,?,?) AS res";
		extract($_POST);
		$datos = array(0,$clien_ide,$banco_ide,$cta,1,$_SESSION['s_clien_ide']);
		//$datos = array(0,9,1,'Prueba',1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function delete_cuenta() {
		$sql = "SELECT sf_clientecuenta(?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,0,0,'',3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'res');
	}

} ?>