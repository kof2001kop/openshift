<?php

	$url = 'https://kpr-translte.us-south.cf.appdomain.cloud/test.php'

	//The data you want to send via POST
	$fields = ['translate'=>'how old are you?'];

	$r = new HttpRequest('https://kpr-translte.us-south.cf.appdomain.cloud/test.php', HttpRequest::METH_POST);
    	$r->addPostFields(array('translate'=>'how old are you?'));

    	try {
        	echo $r->send()->getBody();
    	} catch (HttpException $ex) {
       		echo $ex;
    	}
?>
