<?php

function AltiriaSMS($sDestination, $sMessage, $sSenderId, $debug) {
    $url = 'https://www.altiria.net:8443/apirest/ws/sendSms';
    $credentials = ['login' => 'ingfralch@gmail.com', 'passwd' => 'Siempree08*1'];
    $jsonData = ['credentials' => $credentials, 'destination' => explode(',', $sDestination), 'message' => ['msg' => substr($sMessage, 0, 160), 'senderId' => $sSenderId]];
    $ch = curl_init($url);
    curl_setopt_array($ch, [CURLOPT_POST => 1, CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 60, CURLOPT_RETURNTRANSFER => 1, CURLOPT_POSTFIELDS => json_encode($jsonData), CURLOPT_HTTPHEADER => ['Content-Type: application/json;charset=UTF-8']]);
    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($debug && $statusCode != 200) {
        echo 'ERROR GENERAL: ' . $statusCode . $response;
    }

    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch));
    }

    return $response;
}

try {
    echo "The function AltiriaSMS returns: " . AltiriaSMS('51961610362,51955547121', 'EL TICKET: 2-5728-67510-4 se ha pagado correctamente. ¡Gracias por tu confianza!**Credipyme**', '', true);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>
