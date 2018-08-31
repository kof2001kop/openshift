<?php
	$url = 'https://hk.thenewslens.com/category/health';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);
	$url = Array();
	$pic = Array();
	$title = Array();
	$date = Array();
	$author = Array();
	$content = Array();
	
	$i = 0;
	while ($i < 3)
	{
	$posBeg = strpos($ret, 'img-box">');
	$posBeg = strpos($ret, 'href="', $posBeg) + 6;
	$posEnd = strpos($ret, '"', $posBeg);
	$url[] = substr($ret, $posBeg, $posEnd - $posBeg);
		
	$posBeg = strpos($ret, 'img-box">');
	$posBeg = strpos($ret, 'title="', $posBeg) + 7;
	$posEnd = strpos($ret, '"', $posBeg);
	$title[] = substr($ret, $posBeg, $posEnd - $posBeg);
		
	$posBeg = strpos($ret, 'img-box">');
	$posBeg = strpos($ret, '<span class="time">', $posBeg) + 19;
	$posEnd = strpos($ret, '|', $posBeg);
	$date[] = str_replace('/', '-', trim(substr($ret, $posBeg, $posEnd - $posBeg)).'T00:00:01+00:00');
		
	$ret = substr($ret, strpos($ret, 'img-box">') + 9);
	$i++;
	}
	$k = 0;
	while ($k < $i)
	{
   	$ch = curl_init($url[$k]);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);
	
	$posBeg = strpos($ret, 'og:image" content="') + 19;
	$posEnd = strpos($ret, '"', $posBeg);
	$pic[] = substr($ret, $posBeg, $posEnd - $posBeg);	
		
	while (strpos($ret, '<p'))
	{
	$posBeg = strpos($ret, '<p');
	$posEnd = strpos($ret, '</p>', $posBeg) + 4;
	$content[$k] .= substr($ret, $posBeg, $posEnd - $posBeg);
	$ret = substr($ret, $posEnd);
	}
		
	$k++;
	}

	$head = '<?xml version="1.0" encoding="UTF-8"?>
		<?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2enclosuresfull.xsl"?>
		<?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
		<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
		<channel>
		<title>關鍵評論</title>
		<description>thenewslens</description>
		<link>https://hk.thenewslens.com/category/health</link>
		<generator>RSS for Node</generator>
		<lastBuildDate>'.$date[0].'</lastBuildDate>
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="https://hk.thenewslens.com/category/health" />
		<feedburner:info xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" uri="apple-daily" />
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
		<itunes:explicit>no</itunes:explicit>
		<itunes:subtitle>no</itunes:subtitle>';
	
	$contentNew = '';
	$j = 0;
	while ($j < $i)	
	{
	$contentNew .= '<item>
			<title>'.$title[$j].'</title>
			<description><![CDATA['.'<img src="'.$pic[$j].'">'.$content[$j].']]></description>
			<link>'.$url[$j].'</link>
			<guid isPermaLink="true">'.$url[$j].'</guid>
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
