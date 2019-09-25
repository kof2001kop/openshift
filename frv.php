<?php
        $url = 'https://free-ss.site/v/443.json';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	$ret = curl_exec($ch);
	curl_close($ch);


        $url = 'https://free-ss.site/v/80.json';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	$ret2 = curl_exec($ch);
	curl_close($ch);


        $id = '"id":';



        $posBeg = strpos($ret, 'id": "') + 6;
	$posEnd = strpos($ret, '"', $posBeg);
	$port = '"id": "'.substr($ret, $posBeg, $posEnd - $posBeg).'",';
	

        $posBeg = strpos($ret, 'port": ') + 7;
	$posEnd = strpos($ret, '"', $posBeg);
	$port = '"port": "'.substr($ret, $posBeg, $posEnd - $posBeg).'",';
	

        $posBeg = strpos($ret, 'address": "') + 11;
	$posEnd = strpos($ret, '"', $posBeg);
	$add = '"add": "'.substr($ret, $posBeg, $posEnd - $posBeg).'",';
	

        $posBeg = strpos($ret, 'alterId": ') + 10;
	$posEnd = strpos($ret, ',', $posBeg);
	$aid = '"aid": "'.substr($ret, $posBeg, $posEnd - $posBeg).'",';
	
?>
