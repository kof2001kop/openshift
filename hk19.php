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

        $lineSum = 3;
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

        // 處理結果
        for ($i = 0; $i < ($pageSum + 1) * $lineSum; )
        {
            $ret = $retArr[$i];
            $ret2 = $retArr[$i + 1];
            $ret3 = $retArr[$i + 2];
           
            $ret = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $ret);
            $ret = preg_replace('#<ul>(.*?)</ul>#is', '', $ret);


          /*  if (strpos($ret2, '<div class="post"') === TRUE)
            {

                $posBeg = strpos($ret, 'form name="aspnetForm" ');
	        $ret = substr($ret, 0, $posBeg);
	
                $posBeg = strpos($ret2, '<div class="post"');
	        $ret2 = substr($ret2, $posBeg);
	
                $ret .= $ret2;

                if (strpos($ret3, '<div class="post"') === TRUE)
                {
                $posBeg = strpos($ret, 'form name="aspnetForm" ');
	        $ret = substr($ret, 0, $posBeg);
		
                $posBeg = strpos($ret3, '<div class="post"');
	        $ret3 = substr($ret3, $posBeg);
	
	        $ret .= $ret3;
                }
            }
*/
            $posBeg = strpos($ret, '<div class="topLink">');
            if ($posBeg !== FALSE)
	    {
            $posEnd = strpos($ret, '<div class="clear"></div>
</div>', $posBeg) + 32; 
            $ret = substr($ret, 0, $posBeg).substr($ret, $posEnd);
	    }

            $ret = preg_replace('#<div class="post-col">(.*?)</div>#is', '', $ret);
            $ret = preg_replace('#<span class="topic-time">(.*?)</span>#is', '', $ret);
            
            $ret = str_replace('<br />', '<br/>', $ret); 
            $ret = str_replace(['</blockquote> <br/>', '</blockquote><br/>'], '</blockquote>', $ret); 
            
            $ret = str_replace('<img class="Image" src="', '<img class="Image" alt="', $ret);
	    $ret = str_replace('onclick="javascript: ViewImage(this, ', 'src=', $ret);
	    $ret = str_replace(')" show', ' show', $ret);
	    $ret = str_replace('<span class="topic-name">', '<span class="topic-name"><br/>', $ret);
	    $ret = str_replace(['class="name_male"', 'class="name_female"'], 'style="color:#6495ED"', $ret);
		    
            $posBeg = strpos($ret, '<form name="aspnetForm" ');
	    $ret = substr($ret, 0, $posBeg).'</body></html>';
	

	    $posBeg = strpos($ret, 'male">') + 6;
	    $posEnd = strpos($ret, '<', $posBeg);
	    $author[] = substr($ret, $posBeg, $posEnd - $posBeg);

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
		<title>高登</title>
		<description>HKGOLDEN</description>
		<link>https://hkgolden.com</link>
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
        $guidH = str_replace(['https://m.hkgolden.com/view.aspx?message=', '&type=CA'], '', $urls[$linkCur]);
	$contentNew .= '<item>
			<title>'.$title[$j].'</title>
			<description><![CDATA['.$content[$j].']]></description>
			<link>'.$urls[$linkCur].'</link>
			<guid isPermaLink="true">'.$guidH.'</guid>
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
