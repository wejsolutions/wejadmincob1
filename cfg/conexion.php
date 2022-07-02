<?php class Enlace {

	function __clone() {}
	function __construct() {}
	/**
	 * Conecta a la base de datos
	 * @return [type] [description]
	 */
	static function conectar() {
	/*Usuario: wejsolut_wejadmincob

	Base de datos: wejsolut_wejadmincob1*/


		$driver    = 'mysql';
		$host      = 'localhost';
		$basedatos = 'bdadmincob';
		/*wejsolut_bdadmincob1*/
		$usuario   = 'root';
		/* wejsolut_wejadmincob	*/
		$clave     = '1234';
		try {
			$con = new PDO($driver.':host='.$host.';dbname='.$basedatos,$usuario,$clave,array(PDO::ATTR_PERSISTENT=>true));
			return $con;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	/**
	 * [sql Ejecuta la consulta a la base de datos]
	 * @param  string $sql     Consulta realizada a la base de datos
	 * @param  array $datos   datos que se envían para filtrar la consulta
	 * @param  int $resp    Indica el tipo de respuesta que deseamos obtener como resultado de la consulta
	 * @param  string $valresp Varibale que contiene la respuesta de la base de datos
	 * @return function          Devuelve el resultado de acuerdo al indice pasado
	 */
	static function sql($sql,$datos,$resp,$valresp) {
		$res = self::conectar()->prepare($sql);
		if (is_array($datos) and count($datos)>0) {
			foreach($datos as $ind=>&$val) {
				$num = $ind+1;
				$res->bindParam($num,$val);
			}
		}
		$result = array(1=>'success', 2=>'count', 3=>'rows', 4=>'resp');
		$funcion = $result[$resp];
		return self::$funcion($res,$valresp);
	}
	/**
	 * Ejecución que devuelve como resultado 1 en caso de éxito
	 * @param  array $res     Resultado en limpio de la consulta
	 * @param  string $valresp variable que almacena la respuesta
	 * @return int/array          Variable con la respuesta
	 */
	static function success($res,$valresp) {
		if ($res->execute()==true) {
			$rt = 1;
		} else {
			$rt = print_r($res->errorInfo());
		}
		return $rt;
	}
	/**
	 * Ejecución que devuelve como resultado el total de registros en caso de éxito
	 * @param  array $res     Resultado en limpio de la consulta
	 * @param  string $valresp variable que almacena la respuesta
	 * @return int/array          Variable con la respuesta
	 */
	static function count($res,$valresp) {
		if ($res->execute()==true) {
			$rt = rowCount();
		} else {
			$rt = print_r($res->errorInfo());
		}
		return $rt;
	}
	/**
	 * Ejecución que devuelve como resultado los registros encontrados en caso de éxito
	 * @param  array $res     Resultado en limpio de la consulta
	 * @param  string $valresp variable que almacena la respuesta
	 * @return int/array          Variable con la respuesta
	 */
	public static function rows($res,$valresp) {
		if ($res->execute()==true) {
			$rt = $res->fetchAll(PDO::FETCH_OBJ);
		} else {
			$rt = print_r($res->errorInfo());
		}
		return $rt;
	}
	/**
	 * Ejecución que devuelve como resultado una respuesta de validación en caso de éxito
	 * @param  array $res     Resultado en limpio de la consulta
	 * @param  string $valresp variable que almacena la respuesta
	 * @return int/array          Variable con la respuesta
	 */
	static function resp($res,$valresp) {
		if ($res->execute()==true) {
			$row = $res->fetchAll(PDO::FETCH_OBJ);
			$rt = $row[0]->$valresp;
		} else {
			$rt = print_r($res->errorInfo());
		}
		return $rt;
	}
} ?>