<?php

function curlPost($url, $data = NULL) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15); //timeout in seconds
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_ENCODING, 'identity');

    
    if (!empty($data)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }


    $response = curl_exec($ch);
    if (curl_error($ch)) {
        trigger_error('Curl Error:' . curl_error($ch));
    }

    curl_close($ch);
    echo $response;
    return $response;
}


$url = 'https://kpr-translte.us-south.cf.appdomain.cloud/test.php'
$data = array('translate' => 'how old are you?');
$response=curlPost($url, ['translate' => 'how old are you?']);
?>
