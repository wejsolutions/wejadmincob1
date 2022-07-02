<?php 
class mReportes {

	protected $dbh,$con,$msj;

	function __clone() {

	} #clone

	function __construct() {
		$this->dbh = new Conexion();
		$this->con = $this->dbh->pgsql();
		$this->msj = array();
		if(isset($_POST)) {
			foreach($_POST as $indice=>$valor) {
				if(!is_array($valor)) {
					$this->$indice = strtoupper($valor);
				}
			}
		}
	} #construct

	function traerCliente($consulta) {
		$sql = "SELECT * FROM selectclientecedula WHERE pers_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$consulta);
		return ($res->execute()==1) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
	}

	function totalfact($consulta2) {
		$sql = "SELECT * from tbl_factura WHERE fact_ide=?and fact_anulada=0;";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$consulta2);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function buscarCuadrerepor($f_inic,$f_fin,$caja) {
		$valcaja=($caja=='T') ? '%' : $caja;
		$sql="SELECT pacien_nomraz, fact_ide,fact_anulada,formpagos_nombre,bancos_nombre,sum(pago_mon) as total,pago_hor, pago_caja 
		      FROM selectcuadrecaja 
              WHERE date(pago_hor) 
              BETWEEN ? and ? and pago_caja like ? and fact_ide is not null
              group by  fact_ide,pacien_nomraz,fact_anulada,formpagos_nombre,bancos_nombre,pago_hor,pago_caja
              ORDER BY fact_ide,pago_caja,pacien_nomraz ASC";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$f_inic);
		$res->bindParam(2,$f_fin);
		$res->bindParam(3,$valcaja);
		$res->execute();
		return ($res->execute()==1) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
	}

	function TotalCuadrereportippag($f_inic,$f_fin,$caja) {
		$valcaja=($caja=='T') ? '%' : $caja;
		$sql="SELECT ptoventa_descrip,formpagos_nombre,sum(pago_mon) as total, 
              (sum(pago_mon)-(ptoventa_portd * sum(pago_mon))/100) as total_porcentd,
              (sum(pago_mon)-(ptoventa_portc * sum(pago_mon))/100) as total_porcentc,pago_caja
               FROM selectcuadrecaja 
               WHERE date(pago_hor) between ? and ? and pago_caja like ? and fact_ide is not null and fact_anulada=0 
               GROUP BY ptoventa_descrip,formpagos_nombre,ptoventa_portd,ptoventa_portc,pago_caja
               ORDER BY ptoventa_descrip,pago_caja,formpagos_nombre ASC";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$f_inic);
		$res->bindParam(2,$f_fin);
		$res->bindParam(3,$valcaja);
		$res->execute();
		return ($res->execute()==1) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
	}

	function TotalCuadrerepor($f_inic,$f_fin,$caja) {
		$valcaja=($caja=='T') ? '%' : $caja;
		$sql="SELECT SUM(pago_mon) as total 
              FROM selectcuadrecaja 
              WHERE date(pago_hor) between ? and ? and pago_caja like ? 
              and fact_anulada=0 and fact_ide is not null";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$f_inic);
		$res->bindParam(2,$f_fin);
		$res->bindParam(3,$valcaja);
		$res->execute();
		$totalcuad = $res->fetchAll(PDO::FETCH_OBJ);
		return $totalcuad[0]->total;
	}
} #class
?>