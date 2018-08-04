<?php

	$url = 'https://www.youtube.com/feeds/videos.xml?playlist_id='.$_GET['key'];
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);
	
	$posEnd = strpos($ret, '<published>') + 11;
	while (strpos($ret, '<published>', $posEnd))
	{
		$posBeg = strpos($ret, '<published>', $posEnd) + 11;
		$posEnd = strpos($ret, '</published>', $posBeg);
		$pushDate = substr($ret, $posBeg, $posEnd - $posBeg);
	
		$posBeg = strpos($ret, '<updated>', $posEnd) + 9;
		$posEnd = strpos($ret, '</updated>', $posBeg);
		$ret = substr_replace($ret, $pushDate, $posBeg, $posEnd - $posBeg);
		$posEnd = $posEnd + 10;
	}
	
	$ret = str_ireplace('</feed>', '', $ret);
	$retArray = explode('<entry>', $ret);
	
	for ($i = 1; $i < count($retArray); $i++)
	{
    		echo $retArray[$i];
	}
	
	/*echo $head;*/

?>
