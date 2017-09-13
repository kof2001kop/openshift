 -<?php

require('Rss.php');
header('content-type:text/html; charset=utf-8');

$rss = new Rss\Rss('163 Tie', 'http://news.163.com', '163 Tie', 'zh', '120', $_SERVER['REQUEST_TIME']);

for ($i = 0, $j = 0; $i < 1; $i++, $j += 5)
{
    //$urls1[$i] = "http://comment.api.163.com/api/v1/products/a2869674571f77b5a0867c3d71db5856/recommendList/build?offset=$j&limit=10&showLevelThreshold=100&headLimit=100&tailLimit=100&ibc=newspc&callback";

	$ch1[$i] = curl_init("http://comment.api.163.com/api/v1/products/a2869674571f77b5a0867c3d71db5856/recommendList/build?offset=$j&limit=5&showLevelThreshold=100&headLimit=100&tailLimit=100&ibc=newspc&callback"
);
	curl_setopt($ch1[$i], CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch1[$i], CURLOPT_HEADER, 0); 
	curl_setopt($ch1[$i], CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch1[$i], CURLOPT_CONNECTTIMEOUT, 5);     

	$ret1[$i] = curl_exec($ch1[$i]);
    $ret1[$i] = json_decode($ret1[$i], true);
	curl_close($ch1[$i]);    
}

$titleArr = array();
$contentArr = array();
$pubTime = array();

for ($loop = 0; $loop < 1; $loop++)
{
	for ($j = 0; $j < count($ret1[$loop]); $j++)
	{
		$sum = count($ret1[$loop][$j]["comments"][0]);
		$ic = 0;
		$save = '';
        
        $titleArr[] = $ret1[$loop][$j]["thread"]["title"];

		foreach ($ret1[$loop][$j]["comments"][0] as $val)
		{
    		$save .= ($ic + 1 == $sum ? ('「'.(string)$val["vote"].'」 ') : '').$val["content"].'&';
    		$ic++;
		}
		
		$contentArr[] = rtrim($save, "&");
		$pubTime[] = strtotime($ret1[$loop][$j]["comments"][0][1]["createTime"]);

	//	$rss->addItem($pubTime, $titles, "http://news.163.com/$pubTime", $save, 'Rank News', 'Cyril', $pubTime, $pubTime, '');
	}
}


$length = count($titleArr); 
for ($i = 0; $i < $length; $i++)
{ 
	//分段
	$sumLen = mb_strlen($contentArr[$i], 'utf8') + mb_strlen($titleArr[$i], 'utf8');
	$titleLen = mb_strlen($titleArr[$i], 'utf8');

	if ($sumLen < 139)  // 1
	{
		$contentPar = str_replace("&", "<br>", $contentArr[$i]);
		$rss->addItem($pubTime[$i], $titleArr[$i], "http://news.163.com/$pubTime[$i]", $contentPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');
	}
	else
	{
		if ($sumLen < 278)  // 2
		{
		$firPar = mb_substr($contentArr[$i], 0, 139 - $titleLen, "utf-8");
		$secPar = mb_substr($contentArr[$i], 139 - $titleLen, $sumLen - (139 - $titleLen), "utf-8");

		$firPar = str_replace("&", "<br>", $firPar);
		$secPar = str_replace("&", "<br>", $secPar);
		
		$rss->addItem($pubTime[$i], $titleArr[$i], "http://news.163.com/$pubTime[$i]", $firPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 1, "", "http://news.163.com/$pubTime[$i]", $secPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');
		}
		else
		{

		if ($sumLen < 417)  // 3
		{
		$firPar = mb_substr($contentArr[$i], 0, 139 - $titleLen, "utf-8");
		$secPar = mb_substr($contentArr[$i], 139 - $titleLen, 139, "utf-8");
		$triPar = mb_substr($contentArr[$i], 278 - $titleLen, $sumLen - 278 + $titleLen, "utf-8");

		$firPar = str_replace("&", "<br>", $firPar);
		$secPar = str_replace("&", "<br>", $secPar);
		$triPar = str_replace("&", "<br>", $triPar);

		$rss->addItem($pubTime[$i], $titleArr[$i], "http://news.163.com/$pubTime[$i]", $firPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 1, "", "http://news.163.com/$pubTime[$i]", $secPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 2, "", "http://news.163.com/$pubTime[$i]", $triPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');
		}
		else
		{
		
		if ($sumLen < 556)  //  4
		{
		$firPar = mb_substr($contentArr[$i], 0, 139 - $titleLen, "utf-8");
		$secPar = mb_substr($contentArr[$i], 139 - $titleLen, 139, "utf-8");
		$triPar = mb_substr($contentArr[$i], 278 - $titleLen, 139, "utf-8");
		$forPar = mb_substr($contentArr[$i], 417 - $titleLen, $sumLen - 417 + $titleLen, "utf-8");

		$firPar = str_replace("&", "<br>", $firPar);
		$secPar = str_replace("&", "<br>", $secPar);
		$triPar = str_replace("&", "<br>", $triPar);
		$forPar = str_replace("&", "<br>", $forPar);

		$rss->addItem($pubTime[$i], $titleArr[$i], "http://news.163.com/$pubTime[$i]", $firPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 1, "", "http://news.163.com/$pubTime[$i]", $secPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 2, "", "http://news.163.com/$pubTime[$i]", $triPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 3, "", "http://news.163.com/$pubTime[$i]", $forPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');
		}
		else 
		{

		if ($sumLen < 695)  //  5
		{
		$firPar = mb_substr($contentArr[$i], 0, 139 - $titleLen, "utf-8");
		$secPar = mb_substr($contentArr[$i], 139 - $titleLen, 139, "utf-8");
		$triPar = mb_substr($contentArr[$i], 278 - $titleLen, 139, "utf-8");
		$forPar = mb_substr($contentArr[$i], 417 - $titleLen, 139, "utf-8");
		$fifPar = mb_substr($contentArr[$i], 556 - $titleLen, $sumLen - 556 + $titleLen, "utf-8");

		$firPar = str_replace("&", "<br>", $firPar);
		$secPar = str_replace("&", "<br>", $secPar);
		$triPar = str_replace("&", "<br>", $triPar);
		$forPar = str_replace("&", "<br>", $forPar);
		$fifPar = str_replace("&", "<br>", $fifPar);

		$rss->addItem($pubTime[$i], $titleArr[$i], "http://news.163.com/$pubTime[$i]", $firPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 1, "", "http://news.163.com/$pubTime[$i]", $secPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 2, "", "http://news.163.com/$pubTime[$i]", $triPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 3, "", "http://news.163.com/$pubTime[$i]", $forPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 4, "", "http://news.163.com/$pubTime[$i]", $fifPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');
		}
		else   //  6
		{
		$firPar = mb_substr($contentArr[$i], 0, 139 - $titleLen, "utf-8");
		$secPar = mb_substr($contentArr[$i], 139 - $titleLen, 139, "utf-8");
		$triPar = mb_substr($contentArr[$i], 278 - $titleLen, 139, "utf-8");
		$forPar = mb_substr($contentArr[$i], 417 - $titleLen, 139, "utf-8");
		$fifPar = mb_substr($contentArr[$i], 556 - $titleLen, 139, "utf-8");
		$sixPar = mb_substr($contentArr[$i], 695 - $titleLen, $sumLen - 695 + $titleLen, "utf-8");

		$firPar = str_replace("&", "<br>", $firPar);
		$secPar = str_replace("&", "<br>", $secPar);
		$triPar = str_replace("&", "<br>", $triPar);
		$forPar = str_replace("&", "<br>", $forPar);
		$fifPar = str_replace("&", "<br>", $fifPar);
		$sixPar = str_replace("&", "<br>", $sixPar);

		$rss->addItem($pubTime[$i], $titleArr[$i], "http://news.163.com/$pubTime[$i]", $firPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 1, "", "http://news.163.com/$pubTime[$i]", $secPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 2, "", "http://news.163.com/$pubTime[$i]", $triPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 3, "", "http://news.163.com/$pubTime[$i]", $forPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 4, "", "http://news.163.com/$pubTime[$i]", $fifPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');

		$rss->addItem($pubTime[$i] + 5, "", "http://news.163.com/$pubTime[$i]", $sixPar, 'Rank News', 'Cyril', $pubTime[$i], $pubTime[$i], '');
		}

		}

		}

		}

	}
} 

echo $rss;

?>