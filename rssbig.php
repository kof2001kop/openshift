<?php
   	$ch = curl_init($_GET['url']);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);

	$ret = str_replace('<description>', '<description><big><big>', $ret);
	$ret = str_replace('</description>', '</big></big></description>', $ret);
		
	//echo $_GET['url'];
	echo $ret;
?>
