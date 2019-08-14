<?php
   	$ch = curl_init('https://rsshub.app/telegram/channel/politicJokeZhao');
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	$ret = curl_exec($ch);
	
	$posBeg = strrpos($ret, '</item>') + 7;
	$ret = substr($ret, 0, $posBeg);
	
	$ch = curl_init('https://rsshub.app/instagram/user/hkgoldenforum');
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	$ret1 = curl_exec($ch);
	
	$posBeg = strpos($ret1, '<item>');
	$ret .= substr($ret1, $posBeg);
	
	curl_close($ch);

	$ret = str_replace('<description><![CDATA[', '<description><![CDATA[<big>', $ret);
	$ret = str_replace(']]></description>', '</big>]]></description>', $ret);
    		
    //$pattern = '#\<(\/)?'.'a'.'.*?\>#i';
    //正则过滤指定标签
    //$ret = preg_replace($pattern, '', $ret);
    $ret = preg_replace('/<a href=.*?<\/a>/', '', $ret);
    
    
	//echo $_GET['url'];
	echo $ret;
?>
