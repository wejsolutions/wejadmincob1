<?php
//ini_set('display_errors', '0');
//error_reporting(0);
include('../../cfg/conexion_chat.php'); //conexión a la base de datos
session_start();

if ($_GET['action'] == "chatheartbeat") { chatHeartbeat(); } 
if ($_GET['action'] == "sendchat") { sendChat(); } 
if ($_GET['action'] == "closechat") { closeChat(); } 
if ($_GET['action'] == "startchatsession") { startChatSession(); } 

if (!isset($_SESSION['chatHistory'])) {
	$_SESSION['chatHistory'] = array();	
}

if (!isset($_SESSION['openChatBoxes'])) {
	$_SESSION['openChatBoxes'] = array();	
}

function chatHeartbeat() {	
	//Conexion y sql
     $res=new conectar;
     $sql = "SELECT * FROM tbl_chat WHERE (chat_para = '".$_SESSION['s_usua_login']."' AND chat_recd = '0') order by chat_id ASC";
     $query=$res->sentencia($sql);
     //echo $query;


	$items = '';

	$chatBoxes = array();

	while ($chat = mysql_fetch_array($query)) {

		if (!isset($_SESSION['openChatBoxes'][$chat['chat_de']]) && isset($_SESSION['chatHistory'][$chat['chat_de']])) {
			$items = $_SESSION['chatHistory'][$chat['chat_de']];
		}

		$chat['chat_mens'] = sanitize($chat['chat_mens']);
		//$users=explode(" ",$_SESSION['nombre']);

		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['chat_de']}",
			"m": "{$chat['chat_mens']}"
	   },
EOD;

	if (!isset($_SESSION['chatHistory'][$chat['chat_de']])) {
		$_SESSION['chatHistory'][$chat['chat_de']] = '';
	}

	$_SESSION['chatHistory'][$chat['chat_de']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['chat_de']}",
			"m": "{$chat['chat_mens']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['chat_de']]);
		$_SESSION['openChatBoxes'][$chat['chat_de']] = $chat['chat_envi'];
	}

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Enviado a $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

	//Conexion y sql
     $res=new conectar;
     $sql = "UPDATE tbl_chat SET chat_recd = 1 WHERE chat_para = '".$_SESSION['s_usua_login']."' and chat_recd = 0";
     $query=$res->sentencia($sql);
     //$conex->cerrar();

	 /*if (!$query) {
           echo "Query: Un error ha occurido el sql no ejecuto.\n";
           //echo $sql."\n";
           exit(0);
     }else{
         echo "1"; 	
     }*/

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}

function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

function startChatSession() {

	$items = '';
	 if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}

  header('Content-type: application/json');
     //$users=explode(" ",$_SESSION['nombre']);
?>
 {
		"username": "<?php echo $_SESSION['s_usua_login']; //$_SESSION['medico'];?>",
		"items": [
			<?php echo $items;?>
        ]
 }

 <?php	exit(0);
}

function sendChat() {
	$from = $_SESSION['s_usua_login']; //$_SESSION['medico'];
	$to = $_POST['to'];
	$message = $_POST['message'];

	$_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());
    //echo $_SESSION['openChatBoxes'][$_POST['to']];

	$messagesan = sanitize($message);
	//echo $messagesan;
	
	if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
		$_SESSION['chatHistory'][$_POST['to']] = '';
	}
    //echo $_SESSION['chatHistory'][$_POST['to']];

	$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
					   {
			"s": "1",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;


unset($_SESSION['tsChatBoxes'][$_POST['to']]);

//Conexion y sql
   $res=new conectar;
   $sql="INSERT INTO tbl_chat (chat_de,chat_para,chat_mens,chat_envi) VALUES('".$from."','".$to."','".$message."',NOW())";
   $query=$res->sentencia($sql);
   //$conex->cerrar();

	 if (!$query) {
           echo "Query: Un error ha occurido el sql no ejecuto.\n";
           echo $sql."\n";
           exit(0);
     }else{
         echo "1"; 	
     }
	exit(0);
}

function closeChat() {

	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
	exit(0);
}

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
 }