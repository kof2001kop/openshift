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
	$url = 'https://www.parsevideo.com/youku/#',substr($contentNew, $posBeg, $posEnd - $posBeg);

/*	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);*/

$header = array('Host'=>'www.parsevideo.com',
	       'User-Agent'=>'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:61.0) Gecko/20100101 Firefox/61.0',
	       'Accept'=>'text/javascript, application/javascript, application/ecmascript, application/x-ecmascript, */*; q=0.01',
	       'Accept-Language'=>'en-GB,en;q=0.5',
		'Accept-Encoding'=>'gzip, deflate, br',
		'Content-Type'=>'application/x-www-form-urlencoded; charset=UTF-8',
		'X-Requested-With'=>'XMLHttpRequest',
		'Content-Length'=>'93',
		'Cookie'=>'PHPSESSID=b95e8d912b7cfdd7f6082dbbfdbfb21a; __atuvc=2%7C34; _ga=GA1.2.1553851784.1535196834; _gid=GA1.2.675305563.1535196834; __atuvs=5b814fe913155eb0000; _gat=1',
		'Connection'=>'keep-alive',
		'Pragma'=>'no-cache',
		'Cache-Control'=>'no-cache'
	       );  


	$ch = curl_init('https://www.parsevideo.com/api.php?callback=jQuery112404553552822525099_1535204029430&url=https://www.bilibili.com/video/av30175740&hash=f62bb240eec1ac36738b9e2ccb31400d');
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);

	echo 'abc'.$ret;

?>
