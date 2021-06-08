<?php

	$url = 'https://kpr-translte.us-south.cf.appdomain.cloud/test.php'
	$data = array('translate' => 'how old are you?');
$data = http_build_query($data);
 
$opts = array (
'http' => array (
'method' => 'POST',
'header'=> 'Content-type: application/x-www-form-urlencodedrn' .
'Content-Length: ' . strlen($data) . 'rn',
'content' => $data
)
);
 
$context = stream_context_create($opts);
$html = file_get_contents($url, false, $context);
 
echo $html;
?>
