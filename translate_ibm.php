<?php
function gtranslate($text,$to='zh-CN')
{
	$entext = urlencode($text);
	$url = 'https://translate.google.cn/translate_a/single?client=gtx&dt=t&ie=UTF-8&oe=UTF-8&sl=auto&tl='.$to.'&q='.$entext;
	set_time_limit(0);
	$ch = curl_init();
 
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
 
	curl_setopt($ch, CURLOPT_HEADER, false);
 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 
	curl_setopt($ch, CURLOPT_MAXREDIRS,20);
 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 40);
 
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
 
	$result = json_decode($result, true);
	
	if(!empty($result)){
		foreach($result[0] as $k){
			$v[] = $k[0];
		}
		return implode(" ", $v);
	}
	return false;
}

#echo base64_decode($_GET['translate']);
echo gtranslate(base64_decode($_GET['translate']));

?>
