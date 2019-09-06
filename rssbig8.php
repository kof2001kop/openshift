<?php
        $urls = Array();
        $urls[] = 'https://rsshub.app/telegram/channel/politicJokeZhao';
        $urls[] = 'https://rsshub.app/twitter/user/lihkg_forum';

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

	$ret = $retArr[0];
	
	$posBeg = strrpos($ret, '</item>') + 7;
	$ret = substr($ret, 0, $posBeg);

	$ret1 = $retArr[1];
	
	$posBeg = strpos($ret1, '<item>');
	$ret .= substr($ret1, $posBeg);

	$ret = str_replace('<description><![CDATA[', '<description><![CDATA[<big>', $ret);
	$ret = str_replace(']]></description>', '</big>]]></description>', $ret);
        $ret = str_replace('<title><![CDATA[爆笑祖国 · 厉害了赵的国 - Telegram 频道]]></title>', '<title><![CDATA[其他]]></title>', $ret);
    		
    		
    //$pattern = '#\<(\/)?'.'a'.'.*?\>#i';
    //正则过滤指定标签
    //$ret = preg_replace($pattern, '', $ret);
    //$ret = preg_replace('/<a href=.*?<\/a>/', '', $ret);

      foreach ($urls as $i => $url) {
        curl_multi_remove_handle($mh,$conn[$i]);
        curl_close($conn[$i]);
        }
        curl_multi_close($mh);
    
    
	//echo $_GET['url'];
	echo $ret;
?>
