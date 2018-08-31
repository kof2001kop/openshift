<?php
	$url = 'http://hk.epochtimes.com/category/%E7%A7%91%E6%8A%80/%E7%A7%91%E6%8A%80%E6%96%B0%E8%81%9E';
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
	while ($i < 4)
	{
	$posBeg = strpos($ret, '<article>');
	$posBeg = strpos($ret, 'href="', $posBeg) + 6;
	$posEnd = strpos($ret, '"', $posBeg);
	$url[] = 'http://hk.epochtimes.com'.substr($ret, $posBeg, $posEnd - $posBeg);
		
	$posBeg = strpos($ret, '<article>');
	$posBeg = strpos($ret, 'src="', $posBeg) + 5;
	$posEnd = strpos($ret, '"', $posBeg);
	$pic[] = substr($ret, $posBeg, $posEnd - $posBeg);
		
	$posBeg = strpos($ret, '<article>');
	$posBeg = strpos($ret, 'title">', $posBeg) + 7;
	$posEnd = strpos($ret, '<', $posBeg);
	$title[] = substr($ret, $posBeg, $posEnd - $posBeg);
		
	$posBeg = strpos($ret, '<article>');
	$posBeg = strpos($ret, 'article-date">', $posBeg) + 14;
	$posEnd = strpos($ret, '<', $posBeg);
	$date[] = trim(substr($ret, $posBeg, $posEnd - $posBeg)).'T00:00:01+00:00';
		
	$ret = substr($ret, strpos($ret, '<article>') + 9);
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
	$posBeg = strpos($ret, '<p>');
	$posEnd = strpos($ret, '</section>', $posBeg);
	$content[$k] = substr($ret, $posBeg, $posEnd - $posBeg);
	$content[$k] = str_replace('◇', '', $content[$k]);
	$content[$k] = trim($content[$k]);
	if (strrpos($content[$k], '<p>') >= strlen($content[$k]) - 9)
		$content[$k] = trim(substr($content[$k], 0, strrpos($content[$k], '<p>')));
	$k++;
	}
	$head = '<?xml version="1.0" encoding="UTF-8"?>
		<?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2enclosuresfull.xsl"?>
		<?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
		<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
		<channel>
		<title>大紀元</title>
		<description>epochtimes</description>
		<link>http://hk.epochtimes.com</link>
		<generator>RSS for Node</generator>
		<lastBuildDate>'.$date[0].'</lastBuildDate>
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="http://hk.epochtimes.com" />
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
