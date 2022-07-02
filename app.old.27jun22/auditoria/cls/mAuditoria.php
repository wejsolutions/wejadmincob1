<?php class mAuditoria {

	function __clone() {}
	function __construct() {}

	public function lista() {
		$sql = "SELECT * FROM vw_auditoria ORDER BY audi_ide DESC";
		return Enlace::sql($sql,'',3,'');
	}

} ?>