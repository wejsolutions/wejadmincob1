<?php class mUsuarios {
	
	function __clone() {}
	function __construct() {}

	/**
	 * Inicio de Sesión de Usuarios
	 * @return [array] [registros]
	 */
	public function login() {
		$sql = "SELECT * FROM vw_usuarios WHERE usua_login=? AND usua_clave=?	AND usua_estado=1";
		extract($_POST); $datos = array($usuario,$clave);
		return Enlace::sql($sql,$datos,3,'');
	}

	/**
	 * Trae la lista de módulos a los que el usuario tiene acceso
	 * @return [array] [registros]
	 */
	public function modulos($tius_ide) {
		$sql = "SELECT * FROM vw_permisos WHERE perm_tius=? AND perm_estado=? GROUP BY modu_ide";
		$datos = array($tius_ide,1);
		return Enlace::sql($sql,$datos,3,'');
	}
	/**
	 * Lista de submódulos filtradas por módulo
	 * @param  [int] $tius_ide [ide tipo de usuario]
	 * @param  [int] $modu_ide [ide módulo]
	 * @return [array]           [registros]
	 */
	public function submodulos($tius_ide,$modu_ide) {
		$sql = "SELECT * FROM vw_permisos WHERE perm_tius=? AND perm_estado=? AND modu_ide=?";
		$datos = array($tius_ide,1,$modu_ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	/**
	 * [contenido description]
	 * @param  [int] $sumo_ide [ide submódulo]
	 * @param  [int] $tius_ide [ide tipo de usuario]
	 * @return [array] [registros]
	 */
	public function contenido($sumo_ide,$tius_ide) {
		$sql = "SELECT * FROM vw_permisos WHERE perm_tius=? AND perm_estado=? AND sumo_ide=?";
		$datos = array($tius_ide,1,$sumo_ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function lista() {
		$sql = "SELECT * FROM vw_usuarios WHERE usua_clien IS NOT null AND usua_visible=1 ORDER BY clien_apelli1 ASC";
		$datos = array(0);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listaTius($tius,$tius2) {
		$sql = "SELECT * FROM vw_usuarios WHERE tius_ide=? or tius_ide=?";
		$datos = array($tius,$tius2);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poride($ide) {
		$sql = "SELECT * FROM vw_usuarios WHERE clien_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insert() {
		extract($_POST);
		$sql = "SELECT sf_usuarios(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(0,$tipcli,$ced,Funciones::may($nom1),Funciones::may($nom2),Funciones::may($ape1),Funciones::may($ape2),date('Y-m-d',strtotime($fnac)),Funciones::may($dir),$mov,Funciones::may($corre),Funciones::may($login),$clave,$tipo,$tie,1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function update() {
		extract($_POST);
		$sql = "SELECT sf_usuarios(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array($clien_ide,$tipcli,$ced,Funciones::may($nom1),Funciones::may($nom2),Funciones::may($ape1),Funciones::may($ape2),date('Y-m-d',strtotime($fnac)),Funciones::may($dir),$mov,Funciones::may($corre),Funciones::may($login),$clave,$tipo,$tie,2,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function delete() {
		extract($_POST);
		$sql = "SELECT sf_usuarios(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array($ide,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

} ?>