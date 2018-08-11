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

	$posBeg = strpos($ret, 'SelectHdate">') + 13;
	$posEnd = strpos($ret, '</div>', $posBeg);
	$date = substr($ret, $posBeg, $posEnd - $posBeg);
	$date = str_replace('年', '-', $date);
	$date = str_replace('月', '-', $date);
	$date = str_replace('日', 'T00:00:01+00:00', $date);

	$posBeg = strpos($ret, 'photo intro_photo');
	$posBeg = strpos($ret, 'src="', $posBeg) + 5;
	$posEnd = strpos($ret, '"', $posBeg);
	$pic = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, 'description" content=\'') + 22;
	$posEnd = strpos($ret, '\' />', $posBeg);
	$description = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, 'og:title" content=\'') + 19;
	$posEnd = strpos($ret, '\'', $posBeg);
	$title = substr($ret, $posBeg, $posEnd - $posBeg);

	$posBeg = strpos($ret, '<p>');
	$posEnd = strpos($ret, '</p>', $posBeg) + 4;
	$content = substr($ret, $posBeg, $posEnd - $posBeg);

	
	$head = '<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns:yt="http://www.youtube.com/xml/schemas/2015" xmlns:media="http://search.yahoo.com/mrss/" xmlns="http://www.w3.org/2005/Atom">
 <title>李怡-蘋果專欄</title>
 <link rel="alternate" href="https://hk.appledaily.com/author/index/93"/>
 <author>
  <name>李怡-蘋果專欄</name>
  <uri>https://hk.appledaily.com/author/index/93</uri>
 </author>
 <published>2018-08-10T00:00:01+00:00</published>';

	$contentNew = '<entry><title>'.$title.'</title>';
  	$contentNew .= '<link rel="alternate" href="'.$url.'"/>';
	$contentNew .= '<author><name>李怡</name></author>';
	$contentNew .= '<published>'.$date.'</published>';
	$contentNew .= '<updated>'.$date.'</updated>';
	$contentNew .= '<media:group><media:thumbnail url="'.$pic.'/>';
	$contentNew .= '<media:description>'.$description.'</media:description></media:group></entry></feed>';
		
	echo $head.$contentNew;
?>
