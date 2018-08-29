<?php
	$url = 'https://news.readmoo.com/category/reading-and-life/digest/';
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
	$posBeg = strpos($ret, '<article');
	$posBeg = strpos($ret, '<h2 class="page-title">', $posBeg);
	$posBeg = strpos($ret, 'href="', $posBeg) + 6;
	$posEnd = strpos($ret, '"', $posBeg);
	$url[] = substr($ret, $posBeg, $posEnd - $posBeg);
	$ret = substr($ret, $posEnd);
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

	$posBeg = strpos($ret, 'datetime="') + 10;
	$posEnd = strpos($ret, '"', $posBeg);
	$date[$k] = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, 'og:image" content="') + 19;
	$posEnd = strpos($ret, '"', $posBeg);
	$pic[$k] = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, 'text-align: right;">文');
	$posEnd = strpos($ret, '</', $posBeg);
	$author = substr($ret, $posBeg, $posEnd - $posBeg);
	$author[$k] = str_replace('text-align: right;">文／', '', $author[$k]);
	$author[$k] = str_replace('text-align: right;">文╱', '', $author[$k]);
	$author[$k] = str_replace('text-align: right;">文/', '', $author[$k]);


	$posBeg = strpos($ret, 'og:title" content="') + 19;
	$posEnd = strpos($ret, '"', $posBeg);
	$title[$k] = substr($ret, $posBeg, $posEnd - $posBeg);
	$title[$k] = str_replace('「', '', $title[$k]);
	$title[$k] = str_replace('」', '', $title[$k]);


	$posBeg = strpos($ret, 'text-align: right;">');
	$posBeg = strpos($ret, '</', $posBeg) + 2;
	$posBeg = strpos($ret, '>', $posBeg) + 1;
	$posEnd = strpos($ret, '<div class="book-inside"', $posBeg);
	$content[$k] = trim(substr($ret, $posBeg, $posEnd - $posBeg));
	if (strpos(substr($content[$k], strrpos($content[$k], '<a')), '立即前往試讀►►►'))
	{
		$endStr = substr($content[$k], strrpos($content[$k], '</a>') + 4);
		$content[$k] = trim(substr($content[$k], 0, strrpos($content[$k], '<a')));
		
		$content[$k] .= 'kof2001kopkpr';
		$content[$k] = str_replace('，kof2001kopkpr', '', $content[$k]);
		$content[$k] = str_replace('kof2001kopkpr', '', $content[$k]);

		$content[$k] .= $endStr;
	}
	
	$k++;
	}

	$head = '<?xml version="1.0" encoding="UTF-8"?>
		<?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2enclosuresfull.xsl"?>
		<?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
		<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
		<channel>
		<title>好書秒讀</title>
		<description>ReadMoo</description>
		<link>'.$url.'</link>
		<generator>RSS for Node</generator>
		<lastBuildDate>'.$date.'</lastBuildDate>
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="https://news.readmoo.com" />
		<feedburner:info xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" uri="apple-daily" />
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
		<itunes:explicit>no</itunes:explicit>
		<itunes:subtitle>'.$author.'</itunes:subtitle>';
	
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
