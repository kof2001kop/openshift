<?php
	$url = 'https://hkug.arukascloud.io/topics/2?type=daily';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	$ret = curl_exec($ch);
	curl_close($ch);

	$url = Array();
	$title = Array();
	$date = Array();
	$author = Array();
	$content = Array();

	$i = 0;
	while ($i < 3)
	{
	$posBeg = strpos($ret, '<h4');
	$posBeg = strpos($ret, 'href="', $posBeg) + 6;
	$posEnd = strpos($ret, '"', $posBeg);
	$url[] = 'https://hkug.arukascloud.io'.substr($ret, $posBeg, $posEnd - $posBeg);
	
	$posBeg = strpos($ret, '>', $posEnd) + 1;
	$posEnd = strpos($ret, '</a>', $posBeg);
	$title[] = substr($ret, $posBeg, $posEnd - $posBeg);
	
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

	$posBeg = strpos($ret, 'anticon anticon-clock-circle-o c0126"></i>') + 42;
	$posEnd = strpos($ret, '<', $posBeg);
	$date[$k] = substr($ret, $posBeg, $posEnd - $posBeg);


	$posBeg = strpos($ret, 'c0123 ">') + 8;
	$posBeg = strpos($ret, '>', $posBeg) + 1;
	$posEnd = strpos($ret, '<', $posBeg);
	$author[$k] = substr($ret, $posBeg, $posEnd - $posBeg);

    $ret = str_replace(' 月前</span>', '</span>', $ret);  
    $ret = str_replace(' 天前</span>', '</span>', $ret);   
    $ret = str_replace(' 小時前</span>', '</span>', $ret);
    $ret = str_replace(' 分鐘前</span>', '</span>', $ret);
    $ret = str_replace('幾秒前</span>', '</span>', $ret);
    
    $timing = 1;
    while ($timing < 60)
    {
    $ret = str_replace('<i class="anticon anticon-clock-circle-o c0126"></i>'.$timing, '<i class="anticon anticon-clock-circle-o c0126"></i> ', $ret);
    $timing++;
    }
    
    $line = 1;
    while ($line < 26)
    {
    $ret = str_replace('<i class="anticon anticon-tag-o c0126"></i>'.$line.'</span>', '<i class="anticon anticon-tag-o c0126"></i> </span>', $ret);
    $line++;
    }
    
    $content[$k] = $ret;
	$k++;
	}

	$head = '<?xml version="1.0" encoding="UTF-8"?>
		<?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2enclosuresfull.xsl"?>
		<?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
		<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
		<channel>
		<title>連登</title>
		<description>LIHKG</description>
		<link>https://lihkg.com</link>
		<generator>RSS for Node</generator>
		<lastBuildDate>'.$date[0].'</lastBuildDate>
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="https://news.readmoo.com" />
		<feedburner:info xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" uri="apple-daily" />
		<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
		<itunes:explicit>no</itunes:explicit>
		<itunes:subtitle>'.$author[0].'</itunes:subtitle>';
	
	$contentNew = '';
	$j = 0;
	while ($j < $i)	
	{
	$contentNew .= '<item>
			<title>'.$title[$j].'</title>
			<description><![CDATA['.$content[$j].']]></description>
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
