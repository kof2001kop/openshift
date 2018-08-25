<?php
	$url = base64_decode($_GET['url']);
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

	/*$posBeg = strpos($ret, '<a href="/author');
	$posBeg = strpos($ret, '>', $posBeg) + 1;
	$posEnd = strpos($ret, '</a>', $posBeg);*/
	$posBeg = strpos($ret, 'og:title" content=\'') + 19;
	$posBeg = strpos($ret, '（', $posBeg);
	$posEnd = strpos($ret, '）', $posBeg);
	$author = substr($ret, $posBeg, $posEnd - $posBeg);
	$author = str_replace('（', '', $author);

	$posBeg = strpos($ret, 'og:title" content=\'') + 19;
	$posEnd = strpos($ret, '\'', $posBeg);
	$title = substr($ret, $posBeg, $posEnd - $posBeg);
	$posBeg = strpos($title, '（');
	$title = substr($title, 0, $posBeg);

	$posBeg = strpos($ret, '<p>');
	$posEnd = strpos($ret, '</p>', $posBeg) + 4;
	$content = substr($ret, $posBeg, $posEnd - $posBeg);
	$content = str_replace('<br />', '<br/>', $content);
	$posBeg = strpos($content, '<br/><br/>');
	$content = substr($content, 0, $posBeg);
	$content = str_replace('<br/><br/>', '<br/>', $content);
	$content = str_replace('<br/>', '<br/><br/>', $content);
	$content = str_replace('http://www.facebook.com/mrleeyee', '', $content);
	
	$contentNew = '<html>
			<head>
			<title>'.$title.'</title>
			<meta property="og:image" content='.$pic.'" />
			</head>
			<body><p>'.$content.'</p></body>
			</html>
			';
		
	echo $contentNew;
?>
