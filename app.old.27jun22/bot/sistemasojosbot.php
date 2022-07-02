<?php
 
    $botToken = "571508923:AAEClwZpESSG9H9bdvOCls7VJrl6fl2tQZ8";
    $website = "https://api.telegram.org/bot".$botToken;
    $update = file_get_contents('php://input');
    $update = json_decode($update, TRUE);
    $modo = 0;
     
    $chatId = $update["message"]["chat"]["id"];
    $chatType = $update["message"]["chat"]["type"];
    $userId = $update["message"]['from']['id'];
    $firstname = $update["message"]['from']['username'];
    if ($firstname=="") {
        $modo=1;
        $firstname = $update["message"]['from']['first_name'];
    }

    if ($modo == 0) {
        $firstname = "@".$firstname;
    }
     
    $message = $update["message"]["text"];

    $agg = json_encode($update, JSON_PRETTY_PRINT);

    //Extraemos el Comando
    $arr = explode(' ',trim($message));
    $command = $arr[0];
     
    $message = substr(strstr($message," "), 1);
     
    //No requieren variables del usuario.
    switch ($command) {
        case '/productos':
            sendMessage($chatId, "Ver nuestros productos en <a href='http://www.sistemasojos.com/site/#tablesistem'>http://www.sistemasojos.com</a>");
            break;
        case '/demos':
            sendMessage($chatId, "Nuestra Plataforma DEMO <a href='http://programas.sistemaojos.com/'> http://programas.sistemaojos.com</a>");
            break;
        case '/precios':
            sendMessage($chatId, "Standard - xx US$ mes \nEnterprise - xx US$ mes \nPremium - xx US$ mes");
            break;
        case '/redessociales':
            sendMessage($chatId, "Redes Sociales: \nTwitter <a href='https://twitter.com/sistemas_ojos'> Sistemas_ojos</a> \nFacebook <a href='https://www.facebook.com/SistemasOjosCA/'> SistemasOjosCA</a> \nInstagram <a href='https://instagram.com/sistemas_ojos/'> Sistemas_ojos</a> ");
            break;
        case '/ayuda':
            $response = "Tranquil@, en que te puedo ayudar.";
            sendMessage($chatId, $response);
            break;
     
    }

    function sendMessage($chatId, $response, $keyboard = NULL){
        if (isset($keyboard)) {
            $teclado = '&reply_markup={"keyboard":['.$keyboard.'], "resize_keyboard":true, "one_time_keyboard":true}';
        }
        $url = $GLOBALS[website].'/sendMessage?chat_id='.$chatId.'&parse_mode=HTML&text='.urlencode($response).$teclado;
        file_get_contents($url);
    }
     
 
?>