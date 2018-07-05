<?php
	$url = 'https://lazymanl.github.io/2018/01/20/%E7%A7%91%E5%AD%A6%E4%B8%8A%E7%BD%91%E3%80%81%E9%95%BF%E6%9C%9F%E6%9B%B4%E6%96%B0/';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

	$ret = curl_exec($ch);
	curl_close($ch);

        $beg = strpos($ret, '<code>ssr://');
        $ret = substr($ret, $beg);
        //$end = strpos($ret, '\"');
        //$ret = substr($ret, 0, $end);

	echo $ret;
?>
