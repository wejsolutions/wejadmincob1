<?php class Funciones {

	function __clone() {}
	function __construct() {}

	function modalWidth($ancho) {
		$modal = "<style>" 
			."@media screen and (min-width: 768px) {"
			.".modal-dialog {"
			."width: ".$ancho.";"
			."}"
			."}"
			."</style>";
		return $modal;
	}

	function modalHeader($titulo) {
		$html = '<div class="modal-header">
			<button class="bootbox-close-button close" type="button" data-dismiss="modal">×</button>
			<h4 class="modal-title modal-">'.$titulo.'</h4>
			</div>';
		return $html;
	}

	function modalFooter($tipo) {
		if($tipo==1) {
			$html = '<div class="modal-footer">
				<button class="btn btn-default" type="button" data-bb-handler="cancel" data-dismiss="modal">Cerrar</button>
				<button class="btn btn-primary" type="submit">Aceptar</button>
				</div>';
		} else {
			$html = '<div class="modal-footer">
				<button class="btn btn-default" type="button" data-dismiss="modal" data-bb-handler="cancel">Cerrar</button>
				</div>';
		}
		return $html;
	}

	function select($val1,$val2) {
		return (!strcmp($val1,$val2)) ? 'selected' : null;
	}

	function check($val1,$val2) {
		return (!strcmp($val1,$val2)) ? 'checked' : null;
	}

	static function vacio($campo,$des) {
		return (empty($campo)) ? $des : 1;
	}
	static function may($var) {
		return strtoupper($var);
	}

	static function vstr($foo) {
		return (isset($_POST[$foo])) ? $_POST['foo'] : null;
	}

	static function vint($foo) {
		return (isset($_POST[$foo])) ? $_POST[$foo] : 0;
	}
	static function vsession($foo) {
		return (isset($_SESSION[$foo])) ? $_SESSION[$foo] : null;
	}

} ?>