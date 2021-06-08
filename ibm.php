<?php

	$url = 'https://kpr-translte.us-south.cf.appdomain.cloud/test.php'
	$data = array('translate' => urlencode('how old are you?'));
	$response = wp_remote_post($url, $data);
	echo $response;
?>
