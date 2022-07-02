<?php class mPermfich {

	function __clone() {}
	function __construct() {}

	public function lista() {
		$sql = "SELECT * FROM tbl_fichas WHERE fich_borrado=0";
		return Enlace::sql($sql,'',3,'');
	}

	public function permiso($fich,$tius) {
		$sql = "SELECT * FROM vw_fichas  WHERE pefi_fich=? AND pefi_tius=?";
		$datos = array($fich,$tius);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function update() {
		$sql = "CALL sp_fichas(?,?,?,?)";
		extract($_POST); $datos = array($fich,$tius,$valor,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'');
	}

	public function lista_fichas_permitidas($tius) {
		$sql = "SELECT * FROM vw_fichas  WHERE pefi_tius=? AND pefi_estado=1 ORDER BY fich_orden ASC";
		$datos = array($tius);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poride($ide) {
		$sql = "SELECT * FROM vw_fichas  WHERE fich_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

} ?>