<?php
	$url = 'https://www.youtube.com/feeds/videos.xml?playlist_id=PLPY0_ooDN1dvaxpfASTgujmIg-FeIOYlt';

   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);
	
	$posEnd = strpos($ret, '<published>') + 11;

	$posBeg = strpos($ret, '<published>', $posEnd) + 11;
	$posEnd = strpos($ret, '</published>', $posBeg);
	$pushDate = substr($ret, $posBeg, $posEnd - $posBeg);
	
	$posBeg = strpos($ret, '<updated>', $posEnd) + 9;
	$posEnd = strpos($ret, '</updated>', $posBeg);
	$ret = str_replace($ret, $pushDate, $posBeg, $posEnd - $posBeg);


	//$ret = str_replace('<yt:playlistId>', '<!--', $ret);
	//$ret = str_replace('</yt:playlistId>', '-->', $ret);

	echo $ret;
?>
