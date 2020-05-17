<?php
	//发送地址
	$url = "https://cccat.io/";

	//请求头内容
	$headers = array(
    "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
    "Accept-Encoding:gzip, deflate, br",
    "Accept-Language:zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2",
    "Connection:keep-alive",
    "Host:cccat.io",
    "Upgrade-Insecure-Requests:1",
    "User-Agent:Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:76.0) Gecko/20100101 Firefox/76.0"
	);

	//使用curl发送
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($oCurl, CURLOPT_NOBODY, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($oCurl, CURLOPT_POST, false);
	$result = curl_exec($ch);
	curl_close($ch);
	
	echo $result;

?>
