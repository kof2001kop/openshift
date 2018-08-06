<?php

	$url = 'https://www.youtube.com/feeds/videos.xml?'.$_GET['sort'].'='.$_GET['key'];
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
	
	$content = '';
 	$keyWord = '/(習近平)|(中國)|(李克強)|(大陸)|(內地)|(共產黨)|(中共)|(Miracle)|(Liquid)|(Matu)|(GH)|(Mind)|(MC)|(KUROKY)|(OPENAI)|(OpenAI)/i';
	for ($i = 1; $i < count($retArray); $i++)
	{	
		$posBeg = strpos($retArray[$i], '<title>') + 7;
		$posEnd = strpos($retArray[$i], '</title>');
		$title = substr($retArray[$i], $posBeg, $posEnd - $posBeg);
			
		if (preg_replace($keyWord, '', $title) !== $title)
	    		$content .= '<entry>'.$retArray[$i];
	}
	
	echo $retArray[0].$content.'</feed>';

?>
