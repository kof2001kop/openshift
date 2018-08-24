<?php
	$url = 'https://www.paozha.com/soft/2771.html';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);
	$posBeg = strpos($ret, 'chapter-div');
	$posBeg = strpos($ret, 'href="', $posBeg) + 6;
	$posEnd = strpos($ret, '"', $posBeg);
	$url = substr($ret, $posBeg, $posEnd - $posBeg);
	$url = 'https://www.paozha.com'.$url;

   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);
	$posBeg = strpos($ret, 'art-info');
	$posBeg = strpos($ret, '20', $posBeg);
	$posEnd = strpos($ret, ' ', $posBeg);
	$date = trim(substr($ret, $posBeg, $posEnd - $posBeg));
	$date = str_replace('/', '-', $date);
	$date .= 'T00:00:01+00:00';

	$posBeg = strpos($ret, '作者：');
	$posEnd = strpos($ret, '</span>', $posBeg);
	$author = substr($ret, $posBeg, $posEnd - $posBeg);
	$author = str_replace('作者：', '', $author);

	$posBeg = strpos($ret, 'container');
	$posBeg = strpos($ret, '<h2>', $posBeg) + 4;
	$posEnd = strpos($ret, '</h2>', $posBeg);
	$title = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, 'container');
	$posBeg = strpos($ret, '<img', $posBeg);
	$posEnd = strpos($ret, '<div class=', $posBeg);
	$content = substr($ret, $posBeg, $posEnd - $posBeg);
	$content = '<p>'.$content;

	$head = '<?xml version="1.0" encoding="UTF-8"?>
		<?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2enclosuresfull.xsl"?>
		<?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
		<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
		<channel>
		<title>漫畫</title>
		<description>paozha</description>
		<link>'.$url.'</link>
		<generator>RSS for Node</generator>
		<lastBuildDate>'.$date.'</lastBuildDate>
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="https://www.paozha.com" />
		<feedburner:info xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" uri="apple-daily" />
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
		<itunes:explicit>no</itunes:explicit>
		<itunes:subtitle>'.$author.'</itunes:subtitle>';
	
	$contentNew = '<item>
			<title>'.$title.'</title>
			<description><![CDATA['.$content.']]></description>
			<link>'.$url.'</link>
			<guid isPermaLink="true">'.$url.'</guid>
			<pubDate>'.$date.'</pubDate>
			</item>
			<language>en-us</language>
			<media:rating>nonadult</media:rating>
			</channel>
			</rss>
			';
		
	echo $head.$contentNew;
?>
