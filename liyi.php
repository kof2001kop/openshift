<?php
	$url = 'https://hk.news.appledaily.com/author/authorpaging/93/0/0';
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);

	$posBeg = strpos($ret, 'Authoritem') + 10;
	$posBeg = strpos($ret, 'href=', $posBeg) + 6;
	$posEnd = strpos($ret, '">', $posBeg);
	$url = substr($ret, $posBeg, $posEnd - $posBeg);


   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);

	$posBeg = strpos($ret, 'og:title" content=\'') + 19;
	$posEnd = strpos($ret, '\'', $posBeg);
	$title = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, '<p>');
	$posEnd = strpos($ret, '</p>', $posBeg) + 4;
	$content = substr($ret, $posBeg, $posEnd - $posBeg);

	$head = '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2enclosuresfull.xsl"?><?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
<channel><title><![CDATA[知乎日报]]></title><description><![CDATA[知乎日报]]></description>
<link>https://news-at.zhihu.com/api/4/stories/latest?client=0</link>
<generator>RSS for Node</generator>
<lastBuildDate>Thu, 09 Aug 2018 19:16:24 GMT</lastBuildDate>
<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="http://feeds.feedburner.com/zhihu-daily" />
<feedburner:info xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" uri="zhihu-daily" />
<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
<itunes:explicit>no</itunes:explicit><itunes:subtitle>李怡</itunes:subtitle>';

	$content1 = '<item><title><![CDATA[在美国坐火车，主要目的不是出行……而是看风景]]></title><description><![CDATA[<div><div><div>
<h2>美国的火车是什么样的？</h2><div><div>

<p><img src="http://pic1.zhimg.com/70/v2-d1d777fd34f3bc83e360bf8b12140950_b.jpg" alt=""></p>
]]></description>
<link>https://daily.zhihu.com/story/9692666</link>
<guid isPermaLink="true">https://daily.zhihu.com/story/9692666</guid>
<pubDate>Thu, 09 Aug 2018 10:05:45 GMT</pubDate>
<language>en-us</language><media:rating>nonadult</media:rating></channel></rss>
';

	echo $title.PHP_EOL.$content;
?>
