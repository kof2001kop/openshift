<?php
	
	$ch = curl_init("https://www.youtube.com/feeds/videos.xml");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);    

	$post_data = array ($_GET['sort'] => $_GET['value']);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

	$ret = curl_exec($ch);
	curl_close($ch);

	$ret = str_replace('<media:group>', "", $ret);
	$ret = str_replace('</media:group>', "", $ret);
	$ret = str_replace('media:thumbnail url', "img src", $ret);

	echo $ret;
?>
