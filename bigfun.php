<?php
	$url = 'https://rsshub.app/bilibili/user/video/26023642';
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
	$contentNew = str_replace('<guid>https://www.bilibili.com/video/', '<guid>https://kpr-rss.herokuapp.com/bigfunvideo.php?id=', $contentNew);
	$contentNew = str_replace('referrerpolicy="no-referrer"', '', $contentNew);

	$posBeg = strpos($contentNew, '<description><![CDATA[') + 22;
	$posEnd = strpos($contentNew, '<img', $posBeg);
	$description = substr($contentNew, $posBeg, $posEnd - $posBeg);

	$contentNew = str_replace($description, '', $contentNew);
	$contentNew = str_replace(']]></description>', '<p>'.$description.'</p>]]></description>', $contentNew);

	echo $contentNew;

?>
