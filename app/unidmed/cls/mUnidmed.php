<?php class mUnidmed {

	function __clone() {}
	function __construct() {}

	public function lista() {
		$sql = "SELECT * FROM vw_unidmed WHERE unidmed_borrado=0 ORDER BY unidmed_ide DESC";
		return Enlace::sql($sql,'',3,'');
	}

	public function poride($ide) {
		$sql = "SELECT * FROM vw_unidmed WHERE unidmed_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insert() {
		$sql = "SELECT sf_unidmed(?,?,?,?,?) AS res";
		extract($_POST); $datos = array(0,$abv,Funciones::may($des),1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function update() {
		$sql = "SELECT sf_unidmed(?,?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,$abv,Funciones::may($des),2,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function delete() {
		$sql = "SELECT sf_unidmed(?,?,?,?,?) AS res";
		extract($_POST); $datos = array($ide,0,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'res');
	}
} ?>