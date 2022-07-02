<?php class mCompra {

	function __clone() {}
	function __construct() {}

	public function listacli() {
		$sql = "SELECT * FROM vw_cliente ORDER BY clien_apelli1 ASC";
		$datos = array(0);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function contardeta($idepro) {
		$sql = "SELECT count(detaprod_producto) AS total, detaprod_producto FROM tbl_detaprod WHERE detaprod_producto = ? GROUP BY tbl_detaprod.detaprod_producto";
		$datos = array($idepro);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poridecli($ide) {
		$sql = "SELECT * FROM vw_cliente WHERE clien_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poridecompra($ide) {
		$sql = "SELECT * FROM vw_compra_lista WHERE compra_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function poridedetafac($ide) {
		$sql = "SELECT * FROM vw_compra_deta_2_temp WHERE compradeta_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listasinide($ide) {
		$sql = "SELECT * FROM vw_cliente WHERE clien_ide<>? ORDER BY clien_apelli1 ASC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listacompraverifica() {
		$sql = "SELECT * FROM vw_compra_lista ORDER BY compra_ide DESC";
		//$datos = array();
		return Enlace::sql($sql,'',3,'');
	}

	public function listacompraverificadeta($ide) {
		$sql = "SELECT * FROM vw_compra_verificacion_deta WHERE detaprod_faccom = ?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listafactura() {
		$sql = "SELECT * FROM vw_factura WHERE fact_tienda=? ORDER BY fact_ide DESC";
		$datos = array($_SESSION['s_usua_tienda']);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetacompra2($ide) {
		$sql = "SELECT * FROM vw_compra_deta_2 WHERE compradeta_compra=? ORDER BY compradeta_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetacompra3($ide) {
		$sql = "SELECT * FROM vw_compra_deta_3 WHERE compradeta_compra=? ORDER BY compradeta_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetacompra4($ide) {
		$sql = "SELECT * FROM tbl_compra_deta_temp WHERE compradeta_compra=? ORDER BY compradeta_ide";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetafactura5($ide) {
		$sql = "SELECT * FROM tbl_factura_deta WHERE factdeta_factura=? ORDER BY factdeta_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function totalcompra($ide) {
		$sql = "SELECT Count(vw_compra_deta_1.compradeta_ide) AS Elementos, Sum(vw_compra_deta_1.Base_Imponible) AS SubTotal, Sum(vw_compra_deta_1.Impuesto) AS TotalImpuesto, Sum(vw_compra_deta_1.compradeta_monto) AS Total FROM vw_compra_deta_1 WHERE compradeta_compra=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetacompra2_temp($ide) {
		$sql = "SELECT * FROM vw_compra_deta_2_temp WHERE compradeta_compra=? ORDER BY compradeta_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetacompra3_temp($ide) {
		$sql = "SELECT * FROM vw_compra_deta_3_temp WHERE compradeta_compra=? ORDER BY compradeta_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetafactura5_temp($ide) {
		$sql = "SELECT * FROM tbl_factura_deta_temp WHERE factdeta_factura=? ORDER BY factdeta_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function totalcompra_temp($ide) {
		$sql = "SELECT Count(vw_compra_deta_1_temp.compradeta_ide) AS Elementos, Sum(vw_compra_deta_1_temp.Base_Imponible) AS SubTotal, Sum(vw_compra_deta_1_temp.Impuesto) AS TotalImpuesto, Sum(vw_compra_deta_1_temp.compradeta_monto) AS Total FROM vw_compra_deta_1_temp WHERE compradeta_compra=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listadetaproduccompra($ide) {
		$sql = "SELECT * FROM tbl_detaprod_temp WHERE detaprod_borrado=0 and detaprod_faccom=? ORDER BY detaprod_ide DESC";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insertcompra() {
		extract($_POST);
		$sql0 = "SELECT sf_compra(?,?,?,?,?,?,?,?,?,?,?) AS res0";
		$datos0 = array(
			0, // Identificador
			$_SESSION['s_usua_tienda'],
			$_SESSION['s_cliente_fact'],
			0, //$factcomp,
			0, //$noencomp,
			date('Y-m-d',strtotime(0000-00-00)), //$fechcomp,
			0, //$subtotal,
			0, //$totaliva,
			0, //$total,
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql0,$datos0,4,'res0');
	}

	public function insertcompra_temp() {
		extract($_POST);
		$sql0 = "SELECT sf_compra_temp(?,?,?,?,?,?,?,?,?,?,?) AS res0";
		$datos0 = array(
			0, // Identificador
			$_SESSION['s_usua_tienda'],
			$_SESSION['s_cliente_fact'],
			0, //$factcomp,
			0, //$noencomp,
			date('Y-m-d',strtotime(0000-00-00)), //$fechcomp,
			0, //$subtotal,
			0, //$totaliva,
			0, //$total,
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql0,$datos0,4,'res0');
	}

	public function insertcompradefinitiva() {
		extract($_POST);
		$sql0 = "SELECT sf_compra(?,?,?,?,?,?,?,?,?,?,?) AS res0";
		$datos0 = array(
			$_SESSION['s_compra'], // Identificador
			$_SESSION['s_usua_tienda'],
			$_SESSION['s_cliente_fact'],
			$factcomp,
			$noencomp,
			date('Y-m-d',strtotime($fechcomp)),
			$subtotal,
			$totaliva,
			$total,
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		$idefacturacompra=Enlace::sql($sql0,$datos0,4,'res0');
		$rowdfc = $this->listadetacompra4($_SESSION['s_compra']);
		foreach($rowdfc as &$rdfc){ 
			$sql1 = "SELECT sf_compradeta(?,?,?,?,?,?,?,?,?) AS res1";
			$datos1 = array(0,$idefacturacompra,$rdfc->compradeta_produc,$rdfc->compradeta_producdeta,$rdfc->compradeta_cant,$rdfc->compradeta_costo,$rdfc->compradeta_monto,1,$_SESSION['s_clien_ide']);
			Enlace::sql($sql1,$datos1,4,'res1');
		}
		$rowdfcpd = $this->listadetaproduccompra($_SESSION['s_compra']);
		foreach($rowdfcpd as &$rdfcpd){ 
			$sql2 = "SELECT sf_detaprod(?,?,?,?,?,?,?,?) AS res";
			$datos2 = array(0,$rdfcpd->detaprod_imei,$rdfcpd->detaprod_serial,$rdfcpd->detaprod_producto,$idefacturacompra,0,1,$_SESSION['s_clien_ide']);
			Enlace::sql($sql2,$datos2,4,'res');
		}

		$this->deletetempfactcompra($_SESSION['s_compra']);
		$this->deletetempprodfactcompra($_SESSION['s_compra']);
		return $idefacturacompra;
	}

	public function insertcompradeta() {
		extract($_POST);
		$_SESSION['s_cant']=$cant;
		$_SESSION['s_idepro']=$idep;
		$sql = "SELECT sf_compradeta(?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			0, // Identificador
			$_SESSION['s_compra'],
			$idep,
			0,
			$cant,
			$costo,
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function insertcompradeta_temp() {
		extract($_POST);
		$_SESSION['s_cant']=$cant;
		$_SESSION['s_idepro']=$idep;
		$sql = "SELECT sf_compradeta_temp(?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			0, // Identificador
			$_SESSION['s_compra'],
			$idep,
			0,
			$cant,
			$costo,
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function poridefact($ide) {
		$sql = "SELECT * FROM vw_factura WHERE fact_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insertfact() {
		extract($_POST);
		$sql0 = "SELECT sf_factura(?,?,?,?,?,?,?,?) AS res0";
		$datos0 = array(
			0, // Identificador
			$_SESSION['s_usua_tienda'],
			$_SESSION['s_cliente_fact'],
			$subtotal,
			$totaliva,
			$total,
			1, //  operación
			$_SESSION['s_clien_ide'] #Usuario que realiza operación
		);
		$idefactura=Enlace::sql($sql0,$datos0,4,'res0');
		$rowdf = $this->listadetafactura4($_SESSION['s_compra']);
		foreach($rowdf as &$rdf){ 
			$sql1 = "SELECT sf_facturadeta(?,?,?,?,?,?,?,?,?) AS res1";
			$datos1 = array(0,$idefactura,$rdf->factdetatemp_produc,$rdf->factdetatemp_producdeta,$rdf->factdetatemp_cant,$rdf->factdetatemp_precio,$rdf->factdetatemp_monto,1,$_SESSION['s_clien_ide']);
			Enlace::sql($sql1,$datos1,4,'res1');
		}
		$this->deletetempfact($_SESSION['s_compra']);
		return $idefactura;
	}

	public function anularfact($ide) {
		extract($_POST);
		$sql0 = "SELECT sf_factura(?,?,?,?,?,?,?,?) AS res0";
		$datos0 = array($ide,0,0,0,0,0,3,$_SESSION['s_clien_ide']);

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
		$sql = "SELECT sf_facturadeta(?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(
			0, // Identificador
			$_SESSION['s_compra'],
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

	public function deletetempfactcompra($ide) {
		extract($_POST);
		$sql = "SELECT sf_compradeta_temp(?,?,?,?,?,?,?,?) AS res";
		$datos = array(0,$_SESSION['s_compra'],0,0,0,0,5,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function deletetemp() {
		extract($_POST);
		$sql = "SELECT sf_compradeta_temp(?,?,?,?,?,?,?,?) AS res";
		$datos = array($ide,$_SESSION['s_compra'],0,0,0,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function deletetempprodfactcompra($ide) {
		extract($_POST);
		$sql = "SELECT sf_detaprod_temp(?,?,?,?,?,?,?,?) AS res";
		$datos = array(0,0,0,0,$_SESSION['s_compra'],0,5,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

} ?>