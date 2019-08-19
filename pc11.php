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

        $lineSum = 6;
        $posBeg = strrpos($ret, '</channel>');
        for ($i = 0; $i < $lineSum; $i++)
        {
           $posBeg = strrpos($ret, '<item>', $posBeg);
        }
        $ret = substr($ret, $posBeg);
        

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

        foreach ($retArr as $i => $ret)  
        {
            $ret = preg_replace('#<ul(.*?)</ul>#is', '', $ret);
            $ret = preg_replace('#<h3>(.*?)</h3>#is', '', $ret);
            $ret = preg_replace('#<title>(.*?)</title>#is', '', $ret);
            $ret = preg_replace('#<p (.*?)</p>#is', '', $ret);
            $ret = preg_replace('#<div class="aw-footer">(.*?)</div>#is', '', $ret);
            $ret = preg_replace('#<h1>(.*?)</h1>#is', '', $ret);
            $ret = preg_replace('#<span class="text-color-999 pull-right">(.*?)</span>#is', '', $ret);
            $ret = preg_replace('#- <span class="text-color-999">(.*?)</span>#is', '', $ret);
            $ret = preg_replace('#<span class="text-color-999">(.*?)</span>#is', '', $ret);
            $ret = preg_replace('#<div class="user-detail">(.*?)</div>#is', '', $ret);
            
            
            $ret = str_replace('<a class="aw-user-name"', '<kpr class="aw-user-name"', $ret);
            $ret = preg_replace('#<a (.*?)</a>#is', '', $ret);
            $ret = str_replace('<kpr', '<a', $ret);
            $ret = str_replace('已邀请:', '', $ret);
            $ret = str_replace('<a ', '<br/><span style="color:#6495ED" ', $ret);
            $ret = str_replace('</a>', '</span>', $ret);
            $ret = str_replace('<div class="content markitup-box">', '<div style="font-size:23px; line-height:28px">', $ret);
            $ret = str_replace('<div class="markitup-box">', '<div style="font-size:23px; line-height:28px">', $ret);
               
            $content[] = $ret;
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
		<title>品葱</title>
		<description>PINCONG</description>
		<link>https://pincong.rocks</link>
		<generator>RSS for Node</generator>
		<lastBuildDate>'.'no'.'</lastBuildDate>
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="https://news.readmoo.com" />
		<feedburner:info xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" uri="apple-daily" />
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
		<itunes:explicit>no</itunes:explicit>
		<itunes:subtitle>'.'no'.'</itunes:subtitle>';
	
	$contentNew = '';
	$j = 0;
	while ($j < $lineSum)	
	{
	$contentNew .= '<item>
			<title>'.$title[$j].'</title>
			<description><![CDATA['.$content[$j].']]></description>
			<link>'.$urls[$j].'</link>
			<guid isPermaLink="true">'.$urls[$j].'</guid>
			<pubDate>'.$date[$j].'</pubDate>
			</item>';
		
            $j++;
	}

	$contentNew .= '<language>en-us</language>
			<media:rating>nonadult</media:rating>
			</channel>
			</rss>
			';
		
	echo $head.$contentNew;

?>
