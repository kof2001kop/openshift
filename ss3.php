<?php
   	$url = 'https://free.gyteng.com/';
	$ch = curl_init($url);
	      
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        $ret = curl_exec($ch);
	curl_close($ch);

	$beg = strpos($ret, 'ss://');
        $ret = substr($ret, $beg);
        $end = strpos($ret, '"');
        $ret = substr($ret, 0, $end);

        $ret = base64_encode($ret);
  
  	echo $ret;
?>
