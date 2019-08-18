<?php
        $url = 'https://pincong.rocks/feed';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	$ret = curl_exec($ch);
	curl_close($ch);

	$urls = Array();
	$title = Array();
	$date = Array();
	$author = Array();
	$content = Array();

        $lineSum = 10;

        $i = 0;
        while ($i < $lineSum)
	{
        $posBeg = strpos($ret, '<item>');
        $posBeg = strpos($ret, '<title>') + 7;
	$posEnd = strpos($ret, '</title>', $posBeg);
	$title[] = substr($ret, $posBeg, $posEnd - $posBeg);
	
	$posBeg = strpos($ret, '<link>', $posEnd) + 6;
	$posEnd = strpos($ret, '</link>', $posBeg);
	$urls[] = 'https://pincong.rocks'.substr($ret, $posBeg, $posEnd - $posBeg);
	
        $posBeg = strpos($ret, '<pubDate>', $posEnd) + 9;
	$posEnd = strpos($ret, '</pubDate>', $posBeg);
	$date[] = substr($ret, $posBeg, $posEnd - $posBeg);
	

	$ret = substr($ret, $posEnd);
	$i++;
	}
	
foreach ($urls as $i => $url) 
        {
echo $title[$i].'<br/>';
echo $urls[$i].'<br/>';
echo $date[$i].'<br/>';
}
?>
