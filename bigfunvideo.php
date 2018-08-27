<?php
	$url = 'https://www.parsevideo.com/#https://www.bilibili.com/video/'.$_GET['id'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	$ret = curl_exec($ch);
	curl_close($ch);
	$posBeg = strpos($ret, 'hash = "') + 8;
	$posEnd = strpos($ret, '"', $posBeg);
	$hash = substr($ret, $posBeg, $posEnd - $posBeg);
	

	$ch = curl_init('https://www.parsevideo.com/api.php?callback=jQuery112404553552822525099_'.time().'430&url=https://www.bilibili.com/video/'.$_GET['id'].'&hash='.$hash);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);
	$posBeg = strpos($ret, '[{"url":"') + 9;
	$posEnd = strpos($ret, '"', $posBeg);
	$url = substr($ret, $posBeg, $posEnd - $posBeg);
	$url = str_replace('\\', '', $url);

	header('Location:'.$url);
   	exit;
?>
