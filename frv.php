<?php
        $url = 'https://free-ss.site/v/443.json';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	$ret = curl_exec($ch);
	curl_close($ch);


        $url = 'https://free-ss.site/v/80.json';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	$ret2 = curl_exec($ch);
	curl_close($ch);

        $url = 'https://free-ss.site/v/tmp.json';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	$ret3 = curl_exec($ch);
	curl_close($ch);


        $v = '"v": "2",';

        $host = '"host": "",';

        $type = '"type": "none",';

        $posBeg = strpos($ret, 'security": "') + 12;
	$posEnd = strpos($ret, '"', $posBeg);
	$tls = '"tls": "'.substr($ret, $posBeg, $posEnd - $posBeg).'"';
	
        $posBeg = strpos($ret, 'path": "') + 8;
	$posEnd = strpos($ret, '"', $posBeg);
	$path = '"path": "'.substr($ret, $posBeg, $posEnd - $posBeg).'",';
	
        $posBeg = strpos($ret, 'network": "') + 11;
	$posEnd = strpos($ret, '"', $posBeg);
	$net = '"net": "'.substr($ret, $posBeg, $posEnd - $posBeg).'",';
	
        $posBeg = strpos($ret, 'id": "') + 6;
	$posEnd = strpos($ret, '"', $posBeg);
	$id = '"id": "'.substr($ret, $posBeg, $posEnd - $posBeg).'",';
	
        $posBeg = strpos($ret, 'address":');
        $posBeg = strpos($ret, 'port": ', $posBeg) + 7;
	$posEnd = strpos($ret, ',', $posBeg);
        $portM = substr($ret, $posBeg, $posEnd - $posBeg);
	$port = '"port": "'.$portM.'",';
	
        $posBeg = strpos($ret, 'address": "') + 11;
	$posEnd = strpos($ret, '"', $posBeg);
	$addM = substr($ret, $posBeg, $posEnd - $posBeg);
        $add = '"add": "'.$addM.'",';
	
        $ps = '"ps": "'.$addM.':'.$portM.'",';

        $posBeg = strpos($ret, 'alterId": ') + 10;
	$posEnd = strpos($ret, ',', $posBeg);
	$aid = '"aid": "'.substr($ret, $posBeg, $posEnd - $posBeg).'",';
	
        $uri = '{'.$v.$ps.$add.$port.$id.$aid.$net.$type.$host.$path.$tls.'}';
        $encodeURI = 'vmess://'.base64_encode($uri);
        
        
        $ret = $ret2;

        $v = '"v": "2",';

        $host = '"host": "",';

        $type = '"type": "none",';

        $posBeg = strpos($ret, 'security": "') + 12;
	$posEnd = strpos($ret, '"', $posBeg);
	$tls = '"tls": "'.substr($ret, $posBeg, $posEnd - $posBeg).'"';
	
        $posBeg = strpos($ret, 'path": "') + 8;
	$posEnd = strpos($ret, '"', $posBeg);
	$path = '"path": "'.substr($ret, $posBeg, $posEnd - $posBeg).'",';
	
        $posBeg = strpos($ret, 'network": "') + 11;
	$posEnd = strpos($ret, '"', $posBeg);
	$net = '"net": "'.substr($ret, $posBeg, $posEnd - $posBeg).'",';
	
        $posBeg = strpos($ret, 'id": "') + 6;
	$posEnd = strpos($ret, '"', $posBeg);
	$id = '"id": "'.substr($ret, $posBeg, $posEnd - $posBeg).'",';
	
        $posBeg = strpos($ret, 'address":');
        $posBeg = strpos($ret, 'port": ', $posBeg) + 7;
	$posEnd = strpos($ret, ',', $posBeg);
        $portM = substr($ret, $posBeg, $posEnd - $posBeg);
	$port = '"port": "'.$portM.'",';
	
        $posBeg = strpos($ret, 'address": "') + 11;
	$posEnd = strpos($ret, '"', $posBeg);
	$addM = substr($ret, $posBeg, $posEnd - $posBeg);
        $add = '"add": "'.$addM.'",';
	
        $ps = '"ps": "'.$addM.':'.$portM.'",';

        $posBeg = strpos($ret, 'alterId": ') + 10;
	$posEnd = strpos($ret, ',', $posBeg);
	$aid = '"aid": "'.substr($ret, $posBeg, $posEnd - $posBeg).'",';
	


        $uri = '{'.$v.$ps.$add.$port.$id.$aid.$net.$type.$host.$path.$tls.'}';
        $encodeURI2 = 'vmess://'.base64_encode($uri);
        
        $rss = base64_encode($encodeURI.PHP_EOL.$encodeURI2);
        echo $rss;
?>
