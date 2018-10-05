<?php
	$url = 'https://api.sosreader.com/api/articles?userid=5a41f683eceaedd6be917198&num=1&status=2';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);

	$retJSON = json_decode($ret, true);
	$pic = $retJSON["articles"][0]["thumbnailUrl"];
	$title = $retJSON["articles"][0]["title"];
	$date = $retJSON["articles"][0]["createdAt"];
	$url = "https://sosreader.com/n/chenglap/".$retJSON["articles"][0]["_id"];
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);
	$posBeg = strpos($ret, 'articleBody":"') + 14;
	$posEnd = strpos($ret, '","keywords"', $posBeg);
	$content = substr($ret, $posBeg, $posEnd - $posBeg);
	$content = str_replace('\nE', '\n', $content);
	$content = str_replace('\n\n', '\n', $content);
	$content = str_replace('\n\n', '\n', $content);
	$content = str_replace('\n', '<br/><br/>', $content);

	$head = '<?xml version="1.0" encoding="UTF-8"?>
		<?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2enclosuresfull.xsl"?>
		<?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
		<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
		<channel>
		<title>鄭立</title>
		<description>這些都只是常識</description>
		<link>'.$url.'</link>
		<generator>RSS for Node</generator>
		<lastBuildDate>'.$date.'</lastBuildDate>
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="https://sosreader.com/n/user/@chenglap?page=1" />
		<feedburner:info xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" uri="apple-daily" />
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
		<itunes:explicit>no</itunes:explicit>
		<itunes:subtitle>鄭立</itunes:subtitle>';
	
	$contentNew = '<item>
			<title>'.$title.'</title>
			<description><![CDATA['.'<img src="'.$pic.'">'.$content.']]></description>
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
