<?php
	$url = 'https://us01.xn--e6qy70csvg.ml/';
	$ch = curl_init($url);
	      
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
        $ret = curl_exec($ch);
	curl_close($ch);

	$beg = strpos($ret, 'vmess://');
        $ret = substr($ret, $beg);
        $end = strpos($ret, '</h5>');
        $ret = substr($ret, 0, $end);
	$ret = $ret.PHP_EOL;
	
	$url = 'https://us01-cdn.xn--e6qy70csvg.ml/';
	$ch = curl_init($url);
	      
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
        $ret2 = curl_exec($ch);
	curl_close($ch);

	$beg = strpos($ret2, 'vmess://');
        $ret2 = substr($ret2, $beg);
        $end = strpos($ret2, '</h5>');
        $ret2 = substr($ret2, 0, $end);
	$ret = $ret.$ret2;

	$url = 'https://free.gyteng.com/';
	$ch = curl_init($url);
	      
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        $ret3 = curl_exec($ch);
	curl_close($ch);

	$beg = strpos($ret3, 'ss://');
        $ret3 = substr($ret3, $beg);
       /* $end = strpos($ret3, '">');
        $ret3 = substr($ret3, 0, $end);
	$ret = $ret.$ret2;*/

        $ret = base64_encode($ret);

        echo $ret.'<br/>'.$ret3;
?>
