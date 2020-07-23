<?php
//send to telegram
//$chat_id = $_POST["chatid"];
//$chat_id = "439239139";
$chat_id = "350633638";
$bot_url    = "https://api.telegram.org/bot321382634:AAGX7z4vKSDnpxvmgmBKQ4yiO0gSVUYOu8M/";
$url        = $bot_url . "sendPhoto?chat_id=" . $chat_id ;

$post_fields = [
	'chat_id'   => $chat_id,
    'document'     => new CURLFile(realpath("Resume District.jpg"))
];

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:multipart/form-data"
));
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$output = curl_exec($ch);

return;
?>