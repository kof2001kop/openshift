<?php
	$url = 'https://hkug.arukascloud.io/topics/2?type=daily';
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

        $lineSum = 2;
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

	$posBeg = strpos($ret, '>', $posEnd) + 1;
	$posEnd = strpos($ret, '</a>', $posBeg);
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

        // 處理結果
        for ($i = 0; $i < ($pageSum + 1) * $lineSum; )
        {
            $ret = $retArr[$i];
            $ret2 = $retArr[$i + 1];
            $ret3 = $retArr[$i + 2];
           
            if (strpos($ret2, '<div class="ant-list-empty-text">') === FALSE)
            {

                $posBeg = strpos($ret, '</div></div></div><div class="c0122">');
	        $ret = substr($ret, 0, $posBeg);
	
                $posBeg = strpos($ret2, '<div class="c0119">');
	        $ret2 = substr($ret2, $posBeg);
	
                $ret .= $ret2;

                if (strpos($ret3, '<div class="ant-list-empty-text">') === FALSE)
                {
                $posBeg = strpos($ret, '</div></div></div><div class="c0122">');
	        $ret = substr($ret, 0, $posBeg);
		
                $posBeg = strpos($ret3, '<div class="c0119">');
	        $ret3 = substr($ret3, $posBeg);
	
	        $ret .= $ret3;
                }
            }

          /*  $posBeg = strpos($ret, 'anticon anticon-clock-circle-o c0126"></i>') + 42;
	    $posEnd = strpos($ret, '<', $posBeg);
	    $date[] = substr($ret, $posBeg, $posEnd - $posBeg);
         */
	    $posBeg = strpos($ret, 'c0123 ">') + 8;
	    $posBeg = strpos($ret, '>', $posBeg) + 1;
	    $posEnd = strpos($ret, '<', $posBeg);
	    $author[] = substr($ret, $posBeg, $posEnd - $posBeg);

            $ret = str_replace([' 月前<', ' 天前<', ' 小時前<', ' 分鐘前<', '幾秒前<'], '<', $ret);  
     
            $ret = str_replace(['<div class="c0124">', '<div class="c0125">'], '<div style="color:#6495ED">', $ret);
          
            $ret = str_replace('<blockquote>', '<blockquote style="margin: 0 0 1rem;
            border-left: .1rem solid rgba(100, 100, 100, 0.45);
            padding-left: .7rem;
            padding-bottom: .3rem;color: #808080">', $ret);
            $ret = str_replace('<span style="padding-left:8px;padding-right:8px"><i class="anticon anticon-like-o c0126"></i>', '<span style="padding-right:8px;color:#FFB6C1"><i class="anticon anticon-like-o c0126"></i>', $ret);
            $ret = str_replace('<span style="padding-left:8px;padding-right:8px"><i class="anticon anticon-dislike-o c0126"></i>', '<span style="padding-left:8px;padding-right:8px;padding-bottom:8px;color:#90EE90"><i class="anticon anticon-dislike-o c0126"></i>', $ret);
      
            $ret = str_replace(['HKUG ©2018 Created by HKGOS', '<span>第 3 頁</span>'], '', $ret);
      
            $ret = str_replace('<div class="c0115">', '<div class="c0115"><big><big>', $ret);
            $ret = str_replace('</div><div class="ant-row"', '</big></big></div><div class="ant-row"', $ret);
      
            $timingArr = Array();
            $timing = 59;
            while ($timing > 0)
            {
                $timingArr[] = '<i class="anticon anticon-clock-circle-o c0126"></i>'.$timing;
                $timing--;
            }
            $ret = str_replace($timingArr, '<i class="anticon anticon-clock-circle-o c0126"></i> ', $ret);
                

            $line = 1;
            while ($line < 76)
            {
                $ret = str_replace('<i class="anticon anticon-tag-o c0126"></i>'.$line.'</span>', '<i class="anticon anticon-tag-o c0126"></i> </span>', $ret);
                $line++;
            }
    
            $content[] = $ret;

            $i += 3;
        }


        foreach ($urls as $i => $url) {
        curl_multi_remove_handle($mh,$conn[$i]);
        curl_close($conn[$i]);
        }

        curl_multi_close($mh);

	$head = '<?xml version="1.0" encoding="UTF-8"?>
		<?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2enclosuresfull.xsl"?>
		<?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
		<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
		<channel>
		<title>連登</title>
		<description>LIHKG</description>
		<link>https://lihkg.com</link>
		<generator>RSS for Node</generator>
		<lastBuildDate>'.'no'.'</lastBuildDate>
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="https://news.readmoo.com" />
		<feedburner:info xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" uri="apple-daily" />
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
		<itunes:explicit>no</itunes:explicit>
		<itunes:subtitle>'.$author[0].'</itunes:subtitle>';
	
	$contentNew = '';
	$j = 0;
        $linkCur = 0;
	while ($j < $lineSum)	
	{
	$contentNew .= '<item>
			<title>'.$title[$j].'</title>
			<description><![CDATA['.$content[$j].']]></description>
			<link>'.$urls[$linkCur].'</link>
			<guid isPermaLink="true">'.$urls[$linkCur].'</guid>
			<pubDate>'.$urls[$linkCur].'</pubDate>
			</item>';
		
            $j++;
            $linkCur += 3;
	}

	$contentNew .= '<language>en-us</language>
			<media:rating>nonadult</media:rating>
			</channel>
			</rss>
			';
		
	echo $head.$contentNew;
?>
