 <?php 

 class mChat {

	protected $dbh,$con,$msj;

	function __clone() {
     }

  /**
	 * Inicializa las variables de conexión y las variables enviadas vía POST
	 */
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
 
function guardaChat() {
		
        $sql='INSERT INTO tbl_chat (chat_id,chat_dest,chat_para,chat_mens,chat_envi) 
        values(nextval(tbl_chat_id_seq::regclass),?,?,?,NOW())';
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->from);
		$res->bindParam(2,$this->to);
		$res->bindParam(3,$this->message);
        return $res->execute();
         
     }


 }// Fin de Clase
 
?>