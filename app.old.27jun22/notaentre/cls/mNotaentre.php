<?php class mNotaentre {

	function __clone() {}
	function __construct() {}

	public function listacli() {
		$sql = "SELECT * FROM vw_cliente ORDER BY clien_apelli1 ASC";
		$datos = array(0);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poridecli($ide) {
		$sql = "SELECT * FROM vw_cliente WHERE clien_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listasinide($ide) {
		$sql = "SELECT * FROM vw_cliente WHERE clien_ide<>? ORDER BY clien_apelli1 ASC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listanotaentre() {
		$sql = "SELECT * FROM vw_notaentre WHERE noen_tienda=? ORDER BY noen_ide DESC";
		$datos = array($_SESSION['s_usua_tienda']);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetanotaentre($ide) {
		$sql = "SELECT * FROM vw_notaentre_deta_temp WHERE noendetatemp_notaentre=? ORDER BY noendetatemp_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetanotaentre2($ide) {
		$sql = "SELECT * FROM vw_notaentre_deta_temp2 WHERE noendetatemp_notaentre=? ORDER BY noendetatemp_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetanotaentre3($ide) {
		$sql = "SELECT * FROM vw_notaentre_deta_temp3 WHERE noendetatemp_notaentre=? ORDER BY noendetatemp_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetanotaentre4($ide) {
		$sql = "SELECT * FROM tbl_notaentre_deta_temp WHERE noendetatemp_notaentre=? ORDER BY noendetatemp_ide";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetanotaentre5($ide) {
		$sql = "SELECT * FROM tbl_notaentre_deta WHERE noendeta_notaentre=? ORDER BY noendeta_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function totalnotaentre($ide) {
		$sql = "SELECT Count(vw_notaentre_deta_temp1.noendetatemp_ide) AS Elementos, Sum(vw_notaentre_deta_temp1.Base_Imponible) AS SubTotal, Sum(vw_notaentre_deta_temp1.Impuesto) AS TotalImpuesto, Sum(vw_notaentre_deta_temp1.noendetatemp_monto) AS Total FROM vw_notaentre_deta_temp1 WHERE noendetatemp_notaentre=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poridedetanoen($ide) {
		$sql = "SELECT * FROM vw_notaentre_deta_temp1 WHERE noendetatemp_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insertnoentemp() {
		extract($_POST);
		$sql = "SELECT sf_notaentretemp(?,?,?,?,?) AS res";
		$datos = array(
			0, // Identificador
			1,//$_SESSION['s_usua_tienda'],
			7,//$_SESSION['s_cliente_noen'], //$clien_ide
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function inserttemp() {
		extract($_POST);
		$sql = "SELECT sf_notaentredetatemp(?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			0, // Identificador
			$_SESSION['s_notaentre'],
			$idep,
			$idepdeta,
			$cant,
			$precio,
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function updatetemp() {
		extract($_POST);
		$sql = "SELECT sf_notaentredetatemp(?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			$ide, // Identificador
			0,
			0,
			0,
			$cant,
			$precio,
			2, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function deletetemp() {
		extract($_POST);
		$sql = "SELECT sf_notaentredetatemp(?,?,?,?,?,?,?,?) AS res";
		$datos = array($ide,0,0,0,0,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function deletetempnoen($ide) {
		extract($_POST);
		$sql = "SELECT sf_notaentredetatemp(?,?,?,?,?,?,?,?) AS res";
		$datos = array(0,$_SESSION['s_notaentre'],0,0,0,0,5,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function poridenoen($ide) {
		$sql = "SELECT * FROM vw_notaentre WHERE noen_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insertnoen() {
		extract($_POST);
		$sql0 = "SELECT sf_notaentre(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res0";
		$datos0 = array(
			0, // Identificador
			$_SESSION['s_usua_tienda'],
			$_SESSION['s_cliente_noen'],
			$subtotal,
			$totaliva,
			$total,
			$forpag,
			$efecti,
			$tardeb,
			$tarcre,
			$tarali,
			$cheque,
			$banche,
			$numche,
			$transf,
			$bantra,
			$numtra,
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		$idenotaentre=Enlace::sql($sql0,$datos0,4,'res0');
		$rowdf = $this->listadetanotaentre4($_SESSION['s_notaentre']);
		foreach($rowdf as &$rdf){ 
			$sql1 = "SELECT sf_notaentredeta(?,?,?,?,?,?,?,?,?) AS res1";
			$datos1 = array(0,$idenotaentre,$rdf->noendetatemp_produc,$rdf->noendetatemp_producdeta,$rdf->noendetatemp_cant,$rdf->noendetatemp_precio,$rdf->noendetatemp_monto,1,$_SESSION['s_clien_ide']);
			Enlace::sql($sql1,$datos1,4,'res1');
		}
		$this->deletetempnoen($_SESSION['s_notaentre']);
		return $idenotaentre;
	}

	public function anularnoen() {
		extract($_POST);
		$sql0 = "SELECT sf_notaentre(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res0";
		$datos0 = array($ide,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,$_SESSION['s_clien_ide']);

		$rowdf = $this->listadetanotaentre5($ide);
		foreach($rowdf as &$rdf){ 
			$sql1 = "SELECT sf_detaprod(?,?,?,?,?,?,?,?) AS res";
			extract($_POST); $datos1 = array($rdf->noendeta_producdeta,0,0,$rdf->noendeta_produc,$ide,$rdf->noendeta_cant,6,$_SESSION['s_clien_ide']);
			Enlace::sql($sql1,$datos1,4,'res');
		}

		return Enlace::sql($sql0,$datos0,4,'res0');
	}

	public function insertdeta() {
		extract($_POST);
		$sql = "SELECT sf_notaentredeta(?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			0, // Identificador
			$_SESSION['s_notaentre'],
			$idep,
			$idepdeta,
			$cant,
			$precio,
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function insertcli() {
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

	public function updatecli() {
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

	public function deletecli() {
		extract($_POST);
		$sql = "SELECT sf_cliente(?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array($ide,0,0,0,0,0,0,'0000-00-00',0,0,0,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}


} ?>