<?php


function AltiriaSMS($sDestination, $sMessage, $sSenderId, $debug){
	if($debug)        
	echo 'Enter AltiriaSMS <br/>';

	$baseUrl = 'https://www.altiria.net:8443/apirest/ws';
	 
	$ch = curl_init($baseUrl.'/sendSms');

	$credentials = array(
	    'login'    => 'ingfralch@gmail.com',
	    'passwd'   => 'Siempree08*1' 
	);
	
	

        $destinations = explode(',', $sDestination);

        $jsonMessage = array(
	    'msg' => substr($sMessage,0,160),
	    'senderId' => $sSenderId 
	);

	$jsonData = array(
	    'credentials' => $credentials, 
	    'destination' => $destinations,
	    'message'     => $jsonMessage
	);
	 
	$jsonDataEncoded = json_encode($jsonData);
	 
	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	 
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
	 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=UTF-8'));

	$response = curl_exec($ch);

	$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if($debug) {   
		if($statusCode != 200){ 
			echo 'ERROR GENERAL: '.$statusCode;
			echo $response;
		}else{
			echo 'Codigo de estado HTTP: '.$statusCode.'<br/>';
			$json_parsed = json_decode($response);
			$status = $json_parsed->status;
			echo 'C�digo de estado Altiria: '.$status.'<br/>';
			if ($status != '000')
				echo 'Error: '.$response.'<br/>';
			else{
				echo 'Cuerpo de la respuesta: <br/>';
				echo 'destails[0][destination]: '.$json_parsed->details[0]->destination.'<br/>';
				echo 'destails[0][status]: '.$json_parsed->details[0]->status.'<br/>';
				echo 'destails[1][destination]: '.$json_parsed->details[1]->destination.'<br/>';
				echo 'destails[1][status]: '.$json_parsed->details[1]->status.'<br/>';
			}
		}
	}

	if(curl_errno($ch))
	    throw new Exception(curl_error($ch));

	return $response;
}

try{
    echo "The function AltiriaSMS returns: ".AltiriaSMS('51961610362,51955547121','EL TICKET: 2-5728-67510-4 se ha pagado correctamente. ¡Gracias por tu confianza!**Credipyme**', '', true);    
}catch(Exception $e){
   echo 'Error: '.$e->getMessage();
}

?>
