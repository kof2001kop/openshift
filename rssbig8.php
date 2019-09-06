<?php
       //1、初始化一个批处理handle
        $mh = curl_multi_init();

        foreach ($urls as $i => $url) 
        {
        $conn[$i] = curl_init($url);
        curl_setopt($conn[$i], CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");	
        curl_setopt($conn[$i], CURLOPT_HEADER, 0);   
        curl_setopt($conn[$i], CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER, true);
        curl_multi_add_handle($mh, $conn[$i]);
        }

        //3、并发执行，直到全部结束。
        do 
        {
        curl_multi_exec($mh, $active);
        } 
        while ($active);

        //4、获取结果
        $retArr = Array();
        foreach ($urls as $i => $url)  
        {
            $retArr[$i] = curl_multi_getcontent($conn[$i]);
        }


   	$ch = curl_init('https://rsshub.app/telegram/channel/politicJokeZhao');
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	$ret = curl_exec($ch);
	
	$posBeg = strrpos($ret, '</item>') + 7;
	$ret = substr($ret, 0, $posBeg);
	
	$ch = curl_init('https://rsshub.app/twitter/user/lihkg_forum');
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	$ret1 = curl_exec($ch);
	
	$posBeg = strpos($ret1, '<item>');
	$ret .= substr($ret1, $posBeg);
	
	curl_close($ch);

	$ret = str_replace('<description><![CDATA[', '<description><![CDATA[<big>', $ret);
	$ret = str_replace(']]></description>', '</big>]]></description>', $ret);
    $ret = str_replace('<title><![CDATA[爆笑祖国 · 厉害了赵的国 - Telegram 频道]]></title>', '<title><![CDATA[其他]]></title>', $ret);
    		
    		
    //$pattern = '#\<(\/)?'.'a'.'.*?\>#i';
    //正则过滤指定标签
    //$ret = preg_replace($pattern, '', $ret);
    //$ret = preg_replace('/<a href=.*?<\/a>/', '', $ret);
    
    
	//echo $_GET['url'];
	echo $ret;
?>
