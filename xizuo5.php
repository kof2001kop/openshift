<?php
	$url = 'https://www.webtoons.com/zh-hant/comedy/fengren/list?title_no='.$_GET['num'].'&page=1';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);

	$posBeg = strpos($ret, '_listUl');
	$posBeg = strpos($ret, 'subj">', $posBeg) + 6;
	$posBeg = strpos($ret, '<span>', $posBeg) + 6;
	$posEnd = strpos($ret, '</span>', $posBeg);
	$title = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, '_listUl');
	$posBeg = strpos($ret, 'date">', $posBeg) + 6;
	$posEnd = strpos($ret, '<', $posBeg);
	$date = trim(substr($ret, $posBeg, $posEnd - $posBeg));
	$date = str_replace('/', '-', $date);
	$date .= 'T00:00:01+00:00';

	$posBeg = strpos($ret, 'authors_name">') + 14;
	$posEnd = strpos($ret, '<', $posBeg);
	$author = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, 'detail_header type_white');
	$posBeg = strpos($ret, 'subj">', $posBeg) + 6;
	$posEnd = strpos($ret, '<', $posBeg);
	$category = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, '_listUl');
	$posBeg = strpos($ret, 'href="', $posBeg) + 6;
	$posEnd = strpos($ret, '"', $posBeg);
	$url = substr($ret, $posBeg, $posEnd - $posBeg);
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);

	$posBeg = strpos($ret, '<div class="viewer_img _img_viewer_area');
	$posEnd = strpos($ret, '</div>', $posBeg) + 6;
	$content = substr($ret, $posBeg, $posEnd - $posBeg);
	$posBeg = 0;
	$contentNew = '';
	$i = 0;
	while (strpos($content, 'data-url="'))
	{
		$posBeg = strpos($content, 'data-url="', $posBeg) + 10;
		$posEnd = strpos($content, '"', $posBeg);
		file_put_contents(strval($i).'.jpg', fopen(substr($content, $posBeg, $posEnd - $posBeg), 'r'));
		$contentNew .= '<img src="http://openshift-163.a3c1.starter-us-west-1.openshiftapps.com/'.strval($i).'.jpg">';
		$i++;
		$content = substr($content, $posEnd);
	}

	$head = '<?xml version="1.0" encoding="UTF-8"?>
		<?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2enclosuresfull.xsl"?>
		<?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
		<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
		<channel>
		<title>'.$category.'</title>
		<description>漫畫</description>
		<link>'.$url.'</link>
		<generator>RSS for Node</generator>
		<lastBuildDate>.$date.</lastBuildDate>
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="https://www.webtoons.com/zh-hant/comedy/fengren/list?title_no=692&page=1" />
		<feedburner:info xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" uri="apple-daily" />
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
		<itunes:explicit>no</itunes:explicit>
		<itunes:subtitle>'.$author.'</itunes:subtitle>';
	
	$contentNew = '<item>
			<title><![CDATA['.$title.']]></title>
			<description><![CDATA['.$contentNew.']]></description>
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
