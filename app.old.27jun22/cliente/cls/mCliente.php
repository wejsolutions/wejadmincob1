<?php class mCliente {

	function __clone() {}
	function __construct() {}

	public function lista() {
		$sql = "SELECT * FROM vw_cliente ORDER BY clien_apelli1 ASC";
		$datos = array(0);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listasinide($ide) {
		$sql = "SELECT * FROM vw_cliente WHERE clien_ide<>? ORDER BY clien_apelli1 ASC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poride($ide) {
		$sql = "SELECT * FROM vw_cliente WHERE clien_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insert() {
		extract($_POST);
		$sql = "SELECT sf_cliente(?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			0, // Identificador
			$tipcli,
			$ced,
			Funciones::may($nom1),
			Funciones::may($nom2),
			Funciones::may($ape1),
			Funciones::may($ape2),
			date('Y-m-d',strtotime($fnac)),
			Funciones::may($dir),
			$mov,
			Funciones::may($corre),
			$coes,
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function insertRapido() {
		extract($_POST);
		$nom2  = null;
		$ape2  = null;
		$fnac  = null;
		$dir   = null;
		$mov   = null;
		$corre = null;


		$sql = "SELECT sf_cliente(?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			0,
			$tipcli,
			$ced,
			Funciones::may($nom1),
			Funciones::may($nom2),
			Funciones::may($ape1),
			Funciones::may($ape2),
			date('Y-m-d',strtotime($fnac)),
			Funciones::may($dir),
			$mov,
			Funciones::may($corre),
			$coes,
			4,
			$_SESSION['s_clien_ide']
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function update() {
		extract($_POST);
		$sql = "SELECT sf_cliente(?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			$clien_ide,
			$tipcli,
			$ced,
			Funciones::may($nom1),
			Funciones::may($nom2),
			Funciones::may($ape1),
			Funciones::may($ape2),
			date('Y-m-d',strtotime($fnac)),
			Funciones::may($dir),
			$mov,
			Funciones::may($corre),
			$coes,
			2,
			$_SESSION['s_clien_ide']
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function delete() {
		extract($_POST);
		$sql = "SELECT sf_cliente(?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array($ide,0,0,0,0,0,0,'0000-00-00',0,0,0,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function reactivarlo() {
		extract($_POST);
		$sql = "SELECT sf_cliente(?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		print_r($ide);
		$datos = array($ide,0,0,0,0,0,0,'0000-00-00',0,0,0,0,8,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}



} ?>