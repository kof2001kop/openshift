<?php
        $url = 'https://m.hkgolden.com/topics.aspx?type=HT';
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

        $lineSum = 7;
        $pageSum = 2;//深度，3頁足夠

	$i = 0;
        $nowUrl = $i;
	while ($i < $lineSum)
	{
	$posBeg = strpos($ret, '<h4');
	$posBeg = strpos($ret, 'href="', $posBeg) + 6;
	$posEnd = strpos($ret, '"', $posBeg);
	$urls[$nowUrl] = 'https://hkug.arukascloud.io'.substr($ret, $posBeg, $posEnd - $posBeg);
	
        $currURL = $urls[$nowUrl];
        $nowUrl++;
        $until = $nowUrl + $pageSum;
        $nowPage = 2;
        while ($nowUrl < $until)
        {
        $urls[$nowUrl] = $currURL.'&page='.$nowPage;
        $nowPage++;
	$nowUrl++;
        }

?>