<?php
    // Update the path below to your autoload.php,
    // see https://getcomposer.org/doc/01-basic-usage.md
    require __DIR__ . '/vendor/autoload.php';
    use Twilio\Rest\Client;
    $sid    = "ACb1db216d0745b985252cad96efa929bb";
    $token  = "";
   
    $twilio = new Client($sid, $token);

    $numbers = [
      '+51961610362',
      '+51955537957', 
      '+51955547121'
    ]; 

    foreach ($numbers as $number) {
     // recorrer y esperar a que se envie el codigo 
     $message = $twilio->messages
      ->create( $number, // to
        array(
          "from" => "+14406168287",
          "body" => "EL TICKET: 2-5728-67510-4 se ha pagado correctamente. ¡Gracias por tu confianza!**Credipyme**" 
        )
      );

      print($message->sid);
    }; 

    
?>
