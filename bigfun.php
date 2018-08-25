<?php
	$url = 'https://api.prprpr.me/bilibili2rss/user/26023642';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);

	$ret = str_replace('</channel>', '', $ret);
	$ret = str_replace('</rss>', '', $ret);
	$retArray = explode('<item>', $ret);

	$content = '';
	$keyWord = '/(说电影)/u';

	for ($i = 1; $i < count($retArray); $i++)
	{			
		if (preg_replace($keyWord, '', $retArray[$i]) !== $retArray[$i])
		{
			$content .= '<item>'.$retArray[$i];
			break;
		}
	}

	$contentNew = $retArray[0].$content.'</channel></rss>';
	$contentNew = str_replace('src="//', 'src="http://', $contentNew);

	$contentNew = str_replace('<title><![CDATA[', '<title>', $contentNew);
	$contentNew = str_replace(']]></title>', '</title>', $contentNew);

	$posBeg = strpos($contentNew, '<guid>', $posEnd) + 6;
	$posEnd = strpos($contentNew, '</guid>', $posBeg);
	$url = substr($contentNew, $posBeg, $posEnd - $posBeg);

	echo $contentNew;
?>
