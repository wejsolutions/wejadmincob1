<?php class mContrato {

	function __clone() {}
	function __construct() {}

	public function lista() {
		$sql = "SELECT * FROM vw_contrato WHERE contrato_borrado=0 ORDER BY contrato_ide DESC";
		return Enlace::sql($sql,'',3,'');
	}

	public function listaporcliente($clien_ide) {
		$sql = "SELECT * FROM tbl_contrato WHERE contrato_clien_ide =? ORDER BY contrato_ide DESC";
		$datos = array($clien_ide);
		return Enlace::sql($sql,$datos,3,'');
	}
	
	public function poride($ide) {
		$sql = "SELECT * FROM vw_contrato WHERE contrato_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insert() {
    	$sql = "SELECT sf_contrato(?,?,?,?,?,?,?,?,?) AS res";
		extract($_POST);
		$datos = array(0,$cod,$clien_ide,$fec,$mto,$cuo,$sdo,1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
		}

	public function update() {
		$sql = "SELECT sf_contrato(?,?,?,?) AS res";
		//extract($_POST); $datos = array($ide,Funciones::may($des),2,$_SESSION['s_clien_ide']);
		//`ide` int, `cte_id` int,`fec` date,`mto` double, `ope` INT, `usu` INT
		extract($_POST); $datos = array(0,6,$fec,$mto,2,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function delete() {
		$sql = "SELECT sf_contrato(?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'res');
	}
} ?>