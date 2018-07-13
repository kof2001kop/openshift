<?
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
        $end = strpos($ret3, '"');
        $ret3 = substr($ret3, 0, $end);
  
  	echo $ret3;
?>
