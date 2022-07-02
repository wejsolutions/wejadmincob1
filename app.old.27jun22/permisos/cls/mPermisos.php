<?php class mPermisos {

	function __clone() {}
	function __construct() {}

	public function lista() {
		$sql = "SELECT * FROM vw_submodul";
		return Enlace::sql($sql,'',3,'');
	}

	public function permiso($sumo,$tius) {
		$sql = "SELECT * FROM vw_permisos WHERE perm_sumo=? AND perm_tius=?";
		$datos = array($sumo,$tius);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function update() {
		$sql = "CALL sp_permisos(?,?,?,?)";
		extract($_POST); $datos = array($sumo,$tius,$valor,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'');
	}

} ?>