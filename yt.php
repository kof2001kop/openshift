<?php
	$url = 'https://www.youtube.com/feeds/videos.xml?'.$_GET['value'];

   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);

	$ret = str_replace('<yt:playlistId>', '<!--', $ret);
	$ret = str_replace('</yt:playlistId>', '-->', $ret);

	echo $ret;
?>
