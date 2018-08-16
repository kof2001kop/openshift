<?php
	$url = 'http://polymerhk.com';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);
	$posBeg = strpos($ret, '最新文章');
	$posBeg = strpos($ret, '<h2 class="title">', $posBeg);
	$posBeg = strpos($ret, 'href="', $posBeg) + 6;
	$posEnd = strpos($ret, '"', $posBeg);
	$url = substr($ret, $posBeg, $posEnd - $posBeg);
   /*	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);
	$posBeg = strpos($ret, '<article') + 8;
	$posEnd = strpos($ret, '</article>', $posBeg);
	$ret = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, 'datetime="') + 10;
	$posBeg = strpos($ret, '>', $posBeg) + 1;
	$posEnd = strpos($ret, '</time>', $posBeg);
	$date = substr($ret, $posBeg, $posEnd - $posBeg);
	$date .= 'T00:00:01+00:00';

	$posBeg = strpos($ret, '<img');
	$posBeg = strpos($ret, 'src="', $posBeg) + 5;
	$posEnd = strpos($ret, '"', $posBeg);
	$pic = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, 'author vcard">') + 14;
	$posBeg = strpos($ret, '>', $posBeg) + 1;
	$posEnd = strpos($ret, '</a>', $posBeg);
	$author = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, 'entry-title">') + 13;
	$posEnd = strpos($ret, '</h1>', $posBeg);
	$title = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, '<div class="entry-content">');
	$posEnd = strpos($ret, '<div id="wpdevar_comment_1', $posBeg) + 1;
	$content = substr($ret, $posBeg, $posEnd - $posBeg);
	$content .= '/div>';

	$head = '<?xml version="1.0" encoding="UTF-8"?>
		<?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2enclosuresfull.xsl"?>
		<?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
		<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
		<channel>
		<title>哲學</title>
		<description>好青年荼毒室</description>
		<link>'.$url.'</link>
		<generator>RSS for Node</generator>
		<lastBuildDate>.$date.</lastBuildDate>
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="https://corrupttheyouth.net" />
		<feedburner:info xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" uri="apple-daily" />
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
		<itunes:explicit>no</itunes:explicit>
		<itunes:subtitle>'.$author.'</itunes:subtitle>';
	
	$contentNew = '<item>
			<title><![CDATA['.$title.']]></title>
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
		
	echo $head.$contentNew;*/
	echo $url;
?>
