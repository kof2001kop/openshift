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
	$posBeg = strpos($ret, "<div class='topic'");
	$posBeg = strpos($ret, 'href="', $posBeg) + 6;
	$posEnd = strpos($ret, '"', $posBeg);
	$urls[$nowUrl] = 'https://m.hkgolden.com'.substr($ret, $posBeg + 1, $posEnd - $posBeg - 1);
	
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

        $posBeg = strpos($ret, 'topic-title">', $posEnd) + 13;
	$posEnd = strpos($ret, '</', $posBeg);
	$title[] = substr($ret, $posBeg, $posEnd - $posBeg);
	
	$ret = substr($ret, $posEnd);
	$i++;
	}

        //1、初始化一个批处理handle
        $mh = curl_multi_init();

        foreach ($urls as $i => $url) 
        {
        $conn[$i] = curl_init($url);
        curl_setopt($conn[$i], CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");	
        curl_setopt($conn[$i], CURLOPT_HEADER, 0);   
        curl_setopt($conn[$i], CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER, true);
        curl_multi_add_handle($mh, $conn[$i]);
        }

        //3、并发执行，直到全部结束。
        do 
        {
        curl_multi_exec($mh, $active);
        } 
        while ($active);

        //4、获取结果
        $retArr = Array();
        foreach ($urls as $i => $url)  
        {
            $retArr[$i] = curl_multi_getcontent($conn[$i]);
        }

 
?>
