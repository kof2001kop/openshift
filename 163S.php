<?php
require('Rss.php');
header('content-type:text/html; charset=utf-8');
$rss = new Rss\Rss('163 Tie', 'http://news.163.com', '163 Tie', 'zh', '120', $_SERVER['REQUEST_TIME']);
for ($i = 0, $j = 0; $i < 1; $i++, $j += 16)
{
    //http://comment.api.163.com/api/v1/products/a2869674571f77b5a0867c3d71db5856/recommendList/single?offset=0&limit=30&ibc=newspc&callback=jQuery110201860289060432352_1465656856668
	$urls[$i] = "http://comment.api.163.com/api/v1/products/a2869674571f77b5a0867c3d71db5856/recommendList/single?offset=$j&limit=16&ibc=newspc";
	$ch[$i] = curl_init("http://comment.api.163.com/api/v1/products/a2869674571f77b5a0867c3d71db5856/recommendList/single?offset=$j&limit=16&ibc=newspc");
	curl_setopt($ch[$i], CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch[$i], CURLOPT_HEADER, 0); 
	curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch[$i], CURLOPT_CONNECTTIMEOUT, 5);     
	$ret[$i] = curl_exec($ch[$i]);
	$ret[$i] = json_decode($ret[$i], true);
	curl_close($ch[$i]);    
}
$titleArr = array();
$contentArr = array();

for ($loop = 0; $loop < 1; $loop++)
{   
    	$ic = 0;
	foreach ($ret[$loop] as $val)
    	{	//.$ret[$loop][$ic]["comments"][0][1]["user"]["nickname"]
		$titleArr[] = $ret[$loop][$ic]["thread"]["title"];
		$contentArr[] = '『'.$ret[$loop][$ic]["comments"][0][1]["vote"].'』 '.$ret[$loop][$ic]["comments"][0][1]["content"];
		$ic++;
	}
}
$length = count($titleArr); 
for ($i = 0; $i < $length; $i++)
{ 
  	$iplus = $i + 1;
  	echo "No.".$iplus."<br>".$titleArr[$i]."<br>".$contentArr[$i]."<br><br>";
} 
///////////////////////////////////

for ($i = 0, $j = 0; $i < 1; $i++, $j += 3)
{
	$ch1[$i] = curl_init("http://comment.api.163.com/api/v1/products/a2869674571f77b5a0867c3d71db5856/recommendList/build?offset=$j&limit=3&showLevelThreshold=100&headLimit=100&tailLimit=100&ibc=newspc&callback"
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
$contentArr1 = array();
for ($loop = 0; $loop < 1; $loop++)
{
	for ($j = 0; $j < count($ret1[$loop]); $j++)
	{
		$sum = count($ret1[$loop][$j]["comments"][0]);
		$ic = 0;
		$save = '';
        
        	$titleArr[] = $ret1[$loop][$j]["thread"]["title"];
		$floor = 1;
		foreach ($ret1[$loop][$j]["comments"][0] as $val)
		{
    		$save .= ($ic + 1 == $sum ? ('「'.(string)$val["vote"].'」 ') : "$floor. ").$val["content"].'<br>';
    		$ic++;
		$floor++;
		}
		
		$contentArr1[] = $save;		
	}
}
$length = count($titleArr); 
for ($i = 0; $i < $length; $i++)
{ 
	$iplus2 = $iplus + $i + 1;
  	echo "No.".$iplus2."<br>".$titleArr[$i]."<br>".$contentArr1[$i]."<br><br>";
} 

$talk = array("今天的吐槽就到这了，晚安~", "吐槽完毕，谢谢观看！", "溜了溜了~");
$select = rand(0, 2);
echo $talk[$select];

?>
