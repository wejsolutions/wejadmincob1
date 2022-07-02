<?php class mFacturacion {

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

	public function listafactura() {
		$sql = "SELECT * FROM vw_factura WHERE fact_tienda=? and fact_pago_electronico=0 ORDER BY fact_ide DESC";
		$datos = array($_SESSION['s_usua_tienda']);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetafactura($ide) {
		$sql = "SELECT * FROM vw_factura_deta_temp WHERE factdetatemp_factura=? ORDER BY factdetatemp_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetafactura2($ide) {
		$sql = "SELECT * FROM vw_factura_deta_temp2 WHERE factdetatemp_factura=? ORDER BY factdetatemp_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetafactura3($ide) {
		$sql = "SELECT * FROM vw_factura_deta_temp3 WHERE factdetatemp_factura=? ORDER BY factdetatemp_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetafactura4($ide) {
		$sql = "SELECT * FROM tbl_factura_deta_temp WHERE factdetatemp_factura=? ORDER BY factdetatemp_ide";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetafactura5($ide) {
		$sql = "SELECT * FROM tbl_factura_deta WHERE factdeta_factura=? ORDER BY factdeta_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function totalfactura($ide) {
		$sql = "SELECT Count(vw_factura_deta_temp1.factdetatemp_ide) AS Elementos, Sum(vw_factura_deta_temp1.Base_Imponible) AS SubTotal, Sum(vw_factura_deta_temp1.Impuesto) AS TotalImpuesto, Sum(vw_factura_deta_temp1.factdetatemp_monto) AS Total FROM vw_factura_deta_temp1 WHERE factdetatemp_factura=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poridedetafac($ide) {
		$sql = "SELECT * FROM vw_factura_deta_temp1 WHERE factdetatemp_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poridedetafacimp($ide) {
		$sql = "SELECT * FROM vw_factura_deta2 WHERE factdeta_factura=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poridedetafacimp1($ide) {
		$sql = "SELECT * FROM vw_factura_deta3 WHERE factdeta_factura=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insertfacttemp() {
		extract($_POST);
		$sql = "SELECT sf_facturatemp(?,?,?,?,?) AS res";
		$datos = array(
			0, // Identificador
			$_SESSION['s_usua_tienda'],
			$_SESSION['s_cliente_fact'],
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function inserttemp() {
		extract($_POST);
		$base=$precio/(1+($piva/100));
		$sql = "SELECT sf_facturadetatemp(?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			0, // Identificador
			$_SESSION['s_factura'],
			$idep,
			$idepdeta,
			$cant,
			$base,
			$piva,
			$precio-$base,
			$precio,
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function updatetemp() {
		extract($_POST);
		$base=$precio/(1+($piva/100));
		$sql = "SELECT sf_facturadetatemp(?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			$ide, // Identificador
			0,
			0,
			0,
			$cant,
			$base,
			$piva,
			$precio-$base,
			$precio,
			2, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function deletetemp() {
		extract($_POST);
		$sql = "SELECT sf_facturadetatemp(?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array($ide,0,0,0,0,0,0,0,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function deletetempfact($ide) {
		extract($_POST);
		$sql = "SELECT sf_facturadetatemp(?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(0,$_SESSION['s_factura'],0,0,0,0,0,0,0,5,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function poridefact($ide) {
		$sql = "SELECT * FROM vw_factura WHERE fact_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insertfact() {
		extract($_POST);
		$sql0 = "SELECT sf_factura(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res0";
		$datos0 = array(
			0, // Identificador
			$_SESSION['s_usua_tienda'],
			$_SESSION['s_cliente_fact'],
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
			0,
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		$idefactura=Enlace::sql($sql0,$datos0,4,'res0');
		$rowdf = $this->listadetafactura4($_SESSION['s_factura']);
		foreach($rowdf as &$rdf){ 
			$sql1 = "SELECT sf_facturadeta(?,?,?,?,?,?,?,?,?,?,?,?) AS res1";
			$datos1 = array(0,$idefactura,$rdf->factdetatemp_produc,$rdf->factdetatemp_producdeta,$rdf->factdetatemp_cant,$rdf->factdetatemp_base,$rdf->factdetatemp_piva,$rdf->factdetatemp_iva,$rdf->factdetatemp_precio,$rdf->factdetatemp_monto,1,$_SESSION['s_clien_ide']);
			Enlace::sql($sql1,$datos1,4,'res1');
		}
		$this->deletetempfact($_SESSION['s_factura']);
		return $idefactura;
	}

	public function anularfact() {
		extract($_POST);
		$sql0 = "SELECT sf_factura(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res0";
		$datos0 = array($ide,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,$_SESSION['s_clien_ide']);

		$rowdf = $this->listadetafactura5($ide);
		foreach($rowdf as &$rdf){ 
			$sql1 = "SELECT sf_detaprod(?,?,?,?,?,?,?,?) AS res";
			extract($_POST); $datos1 = array($rdf->factdeta_producdeta,0,0,$rdf->factdeta_produc,$ide,$rdf->factdeta_cant,5,$_SESSION['s_clien_ide']);
			Enlace::sql($sql1,$datos1,4,'res');
		}

		return Enlace::sql($sql0,$datos0,4,'res0');
	}

	public function insertdeta() {
		extract($_POST);
		$base=$precio/(1+($piva/100));
		$monto=$precio*$cant;
		$sql = "SELECT sf_facturadeta(?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			0, // Identificador
			$_SESSION['s_factura'],
			$idep,
			$idepdeta,
			$cant,
			$base,
			$piva,
			$precio-$base,
			$precio,
			$monto,
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