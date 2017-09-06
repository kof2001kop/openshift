<?php

	$ch = curl_init("https://kylehe.me/vifeng/podcast/audio/qqsrx.xml");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);     

	$ret = curl_exec($ch);
	curl_close($ch);

	$ret = str_replace('<link>http://v.ifeng.com/</link>', "", $ret);
	$ret = str_replace('<enclosure url="', "<link>", $ret);
	$ret = str_replace('type=', "</link><enclosure type=", $ret);
	
	echo $ret;
?>
