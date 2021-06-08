<?php

	$url = 'https://kpr-translte.us-south.cf.appdomain.cloud/test.php'
	$data = array('translate' => 'how old are you?');

	// use key 'http' even if you send the request to https://...
	$options = array(
    	'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    	)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { /* Handle error */ }

	echo $result;
?>
