<?php
    // Update the path below to your autoload.php,
    // see https://getcomposer.org/doc/01-basic-usage.md
    require __DIR__ . '/vendor/autoload.php';
    use Twilio\Rest\Client;

    $sid    = "ACb1db216d0745b985252cad96efa929bb";
    $token  = "4605ca3adca81623348495190b4f3422";
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
      ->create("+51961610362", // to
        array(
          "from" => "+14406168287",
          "body" => "Hola" 
        )
      );

print($message->sid);