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

	/*********************************************
	/*19 jun 22
	Devuelve Contrato de un cliente por clien_ide*/
	public function porclien_ide($clien_ide) {
		$sql = "SELECT * FROM vw_contrato WHERE contrato_clien_ide=? ORDER BY contrato_ide ASC";
		$datos = array($clien_ide);
		return Enlace::sql($sql,$datos,3,'');
	}


	public function insert() {
    	$sql = "SELECT sf_contrato(?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		extract($_POST);
		$datos = array(0,$consec,$cod,$clien_ide,$cuenta_ide,$fec,$fec_ini_cob,$mto,$fre,$dias,$cuo,$sdo,1,$_SESSION['s_clien_ide']);
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



	/**************Para Cuotas ******************/

	public function listaCuotas($contrato_ide) {
		$sql = "SELECT * FROM tbl_cuota WHERE cuota_cnt_ide =? ORDER BY cuota_ide ";
		$datos = array($contrato_ide);
		return Enlace::sql($sql,$datos,3,'');
	}
	public function cuota_poride($ide) {
		$sql = "SELECT * FROM tbl_cuota WHERE cuota_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}
	public function cuotaupdate() {
		$sql = "SELECT sf_cuotaupdate(?,?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,$mto,$can, 2,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

} ?>