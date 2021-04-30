<?php
        $url = 'https://humanum.arts.cuhk.edu.hk/Lexis/lexi-can/search.php?q=%A5%B4';
   	$ch = curl_init($url);
	      //$_GET["q"]
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	$ret = curl_exec($ch);
	curl_close($ch);
?>
